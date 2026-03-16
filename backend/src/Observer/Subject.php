<?php

abstract class Subject
{
    public string $state = 'IDLE';
    protected array $observers = [];

    public function setState(string $state): void
    {
        $this->state = $state;
        $this->notifyAllObservers();
    }

    public function attach(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function notifyAllObservers(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->state, $this->name);
        }
    }
}
