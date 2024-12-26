<?php

declare(strict_types=1);
class Post extends Category
{
    public string $body;

    public function __construct(string $type = "post", int $id, string $title, string $body, int $quantity = 100)
    {
        parent::__construct($type, $id, $title, $quantity);
        $this->body = $body;
    }

    public function display(): string {
        return parent::display() . "\n" . "<p>Body: " . htmlspecialchars($this->body) . "</p>";
    }
}