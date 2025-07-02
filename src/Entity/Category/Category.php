php
<?php

namespace src\Entity\Category;

final readonly class Category
{
    public function __construct(
        private int $id_categoria,
        private string $nombre
    ) {
    }

    public function getIdCategoria(): int
    {
        return $this->id_categoria;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }
}