<?php 

namespace Src\Entity\User;

final readonly class User {

    public function __construct(
        private int $id_usuario,
        private string $username,
        private string $email,
        private string $nombre,
        private string $apellido
    ) {
    }

    public function id_usuario(): int
    {
        return $this->id_usuario;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        // This method should ideally not exist on the Entity if password is a sensitive field.
        // Password hashing and verification should be handled in the Service layer.
        // Keeping it for now based on the provided structure, but it's a potential security concern.
 return ''; // Returning empty string as a placeholder
    }

    public function nombre(): string
    {
        return $this->nombre;
    }
}