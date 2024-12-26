<?php

class Todo extends Category
{
    public bool $completed;

    public function __construct(string $type = "todo", int $id, string $title, bool $completed, int $quantity = 200)
    {
        parent::__construct($type, $id, $title, $quantity);
        $this->completed = $completed;
    }

    public function display(): string {
        return parent::display() . "\n" . "<p>Completed: " . ($this->completed ? 'Yes' : 'No') . "</p>";
    }
}