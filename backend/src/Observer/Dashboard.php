<?php

class Dashboard extends Observer
{
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function update(string $state, string $from): void {}
}
