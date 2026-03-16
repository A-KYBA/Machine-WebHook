<?php

class Dashboard extends Observer
{
    private WebSocketServer $server;

    public function __construct(string $name, WebSocketServer $server)
    {
        $this->name = $name;
        $this->server = $server;
    }

    public function update(string $state, string $from): void
    {
        $this->server->broadcastMachine($from, json_encode([
            'name' => $from,
            'state' => $state,
        ]));
    }
}
