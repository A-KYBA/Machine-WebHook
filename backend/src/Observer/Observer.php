<?php

abstract class Observer
{
    public string $name = '';

    public abstract function update(string $state, string $from): void;
}
