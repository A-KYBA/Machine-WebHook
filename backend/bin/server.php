<?php

require_once __DIR__ . '/../src/Observer/Observer.php';
require_once __DIR__ . '/../src/Observer/Subject.php';
require_once __DIR__ . '/../src/Observer/Machine.php';
require_once __DIR__ . '/../src/Observer/Dashboard.php';
require_once __DIR__ . '/../src/WebSocket/WebSocketServer.php';

// Employee → machine assignments (overlapping)
$employees = [
    'Annie' => ['Machine A', 'Machine B', 'Machine C'],
    'Ben'   => ['Machine B', 'Machine C', 'Machine D'],
    'Carl'  => ['Machine C', 'Machine D', 'Machine E'],
];

$server = new WebSocketServer('0.0.0.0', 8080, $employees);

// State machine: valid transitions per state
$transitions = [
    'IDLE'      => ['PRODUCING'],
    'PRODUCING' => ['IDLE', 'STARVED'],
    'STARVED'   => ['IDLE'],
];

$machines = [
    new Machine('Machine A'),
    new Machine('Machine B'),
    new Machine('Machine C'),
    new Machine('Machine D'),
    new Machine('Machine E'),
];

$dashboard = new Dashboard('Dashboard', $server);

foreach ($machines as $machine) {
    $machine->attach($dashboard);
}

echo "WebSocket server running on ws://localhost:8080\n";

// Simulate external machine state updates on independent schedules
$timers = [];
foreach ($machines as $i => $m) {
    $timers[$i] = microtime(true) + mt_rand(150, 800) / 100;
}

while (true) {
    $server->accept($machines);

    $now = microtime(true);
    foreach ($machines as $i => $machine) {
        if ($now >= $timers[$i]) {
            $next = $transitions[$machine->state];
            $machine->setState($next[array_rand($next)]);
            $timers[$i] = $now + mt_rand(150, 800) / 100;
        }
    }

    usleep(100000);
}
