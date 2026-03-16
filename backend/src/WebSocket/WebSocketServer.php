<?php

class WebSocketServer
{
    private $server;
    private array $clients = [];       // socket resources
    private array $clientMachines = []; // client index => allowed machine names
    private array $employees;           // employee name => machine names

    public function __construct(string $host, int $port, array $employees)
    {
        $this->employees = $employees;
        $this->server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option($this->server, SOL_SOCKET, SO_REUSEADDR, 1);
        socket_bind($this->server, $host, $port);
        socket_listen($this->server);
        socket_set_nonblock($this->server);
    }

    public function accept(array $machines = []): void
    {
        $client = @socket_accept($this->server);
        if ($client) {
            $allowed = $this->handshake($client);
            if ($allowed === null) {
                @socket_close($client);
                return;
            }
            $this->clients[] = $client;
            $this->clientMachines[] = $allowed;

            foreach ($machines as $machine) {
                if (in_array($machine->name, $allowed, true)) {
                    $this->send($client, json_encode([
                        'name' => $machine->name,
                        'state' => $machine->state,
                    ]));
                }
            }
        }
    }

    public function send($client, string $message): void
    {
        $frame = $this->encode($message);
        @socket_write($client, $frame, strlen($frame));
    }

    public function broadcastMachine(string $machineName, string $message): void
    {
        $frame = $this->encode($message);
        foreach ($this->clients as $i => $client) {
            if (!in_array($machineName, $this->clientMachines[$i] ?? [], true)) {
                continue;
            }
            $result = @socket_write($client, $frame, strlen($frame));
            if ($result === false) {
                unset($this->clients[$i], $this->clientMachines[$i]);
            }
        }
    }

    private function handshake($client): ?array
    {
        $request = @socket_read($client, 5000);
        if (!$request || !preg_match('#Sec-WebSocket-Key: (.*)\r\n#', $request, $matches)) {
            return null;
        }
        $accept = base64_encode(sha1($matches[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));

        $response = "HTTP/1.1 101 Switching Protocols\r\n"
            . "Upgrade: websocket\r\n"
            . "Connection: Upgrade\r\n"
            . "Sec-WebSocket-Accept: {$accept}\r\n\r\n";

        socket_write($client, $response, strlen($response));

        // Parse ?user= from the GET request line
        preg_match('#GET /\?user=(\S+) HTTP#', $request, $userMatch);
        $user = urldecode($userMatch[1] ?? '');
        return $this->employees[$user] ?? [];
    }

    private function encode(string $message): string
    {
        $length = strlen($message);
        if ($length <= 125) {
            return chr(0x81) . chr($length) . $message;
        } elseif ($length <= 65535) {
            return chr(0x81) . chr(126) . pack('n', $length) . $message;
        }
        return chr(0x81) . chr(127) . pack('J', $length) . $message;
    }
}
