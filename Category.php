<?php

declare(strict_types=1);

class Category
{
    public string $type;
    public int $id;
    public string $title;
    public int $quantity;

    public function __construct(string $type, int $id, string $title, int $quantity)
    {
        $this->type = $type;
        $this->id = $id;
        $this->title = $title;
        $this->quantity = $quantity;
    }

    public function display(): string
    {
        return "<h2>" . ucfirst($this->type) . "</h2>\n" .
            "<p>ID: " . htmlspecialchars((string)$this->id) . "</p>\n" .
            "<p>Title: " . htmlspecialchars($this->title) . "</p>";
    }
}