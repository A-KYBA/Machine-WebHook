<?php

class Machine extends Subject
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
