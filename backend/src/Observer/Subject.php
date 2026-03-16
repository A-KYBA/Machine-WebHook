<?php

abstract class Subject
{
    public string $state = '';

    public abstract function setState(string $s): void;
    public abstract function attach(Observer $o): void;
    public abstract function notifyAllObservers(): void;
}
