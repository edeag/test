php
<?php

namespace src\Entity\Comment;

class Comment
{
    private int $id_comentario;
    private string $mensaje;
    private int $id_entretenimiento;
    private float $calificacion;
    private int $id_usuario;
    private string $fecha_de_comentario;

    public function __construct(
        int $id_comentario,
        string $mensaje,
        int $id_entretenimiento,
        float $calificacion,
        int $id_usuario,
        string $fecha_de_comentario
    ) {
        $this->id_comentario = $id_comentario;
        $this->mensaje = $mensaje;
        $this->id_entretenimiento = $id_entretenimiento;
        $this->calificacion = $calificacion;
        $this->id_usuario = $id_usuario;
        $this->fecha_de_comentario = $fecha_de_comentario;
    }

    public function getIdComentario(): int
    {
        return $this->id_comentario;
    }

    public function getMensaje(): string
    {
        return $this->mensaje;
    }

    public function getIdEntretenimiento(): int
    {
        return $this->id_entretenimiento;
    }

    public function getCalificacion(): float
    {
        return $this->calificacion;
    }

    public function getIdUsuario(): int
    {
        return $this->id_usuario;
    }

    public function getFechaDeComentario(): string
    {
        return $this->fecha_de_comentario;
    }
}