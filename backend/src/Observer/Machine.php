<?php

class Machine extends Subject
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function setState(string $s): void {}
    public function attach(Observer $o): void {}
    public function notifyAllObservers(): void {}
}
