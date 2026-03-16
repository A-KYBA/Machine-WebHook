<?php

require_once __DIR__ . '/src/Observer/Observer.php';
require_once __DIR__ . '/src/Observer/Subject.php';
require_once __DIR__ . '/src/Observer/Machine.php';
require_once __DIR__ . '/src/Observer/Employee.php';

$machines = [
    new Machine('Machine A'),
    new Machine('Machine B'),
    new Machine('Machine C'),
];

$employees = [
    new Employee('Annie', 'Technician'),
    new Employee('Ben', 'Production Manager'),
    new Employee('Carl', 'Technician'),
];

foreach ($machines as $machine) {
    foreach ($employees as $employee) {
        $machine->attach($employee);
    }
}

$machines[0]->setState('PRODUCING');
$machines[1]->setState('IDLE');
$machines[2]->setState('STARVED');
