php
<?php

namespace srcEntityPlatform;

final class Platform
{
    private int $id_plataforma;
    private string $nombre;

    public function __construct(int $id_plataforma, string $nombre)
    {
        $this->id_plataforma = $id_plataforma;
        $this->nombre = $nombre;
    }

    public function getIdPlataforma(): int
    {
        return $this->id_plataforma;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }
}