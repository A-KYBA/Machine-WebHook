<?php

class Employee extends Observer
{
    public string $role;

    public function __construct(string $name, string $role)
    {
        $this->name = $name;
        $this->role = $role;
    }

    public function update(string $state, string $from): void
    {
        echo "{$this->name} ({$this->role}): {$from} is now {$state}\n";
    }
}
