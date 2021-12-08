<?php
namespace App\Models;

class User
{
    public static function select(int $id): array
    {
        $db = parse_url(getenv("DATABASE_URL"));

        $connPdo = new \PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));

        $sql = 'SELECT * FROM users WHERE user_id = :id;';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    public static function selectAll(): array
    {
        $db = parse_url(getenv("DATABASE_URL"));

        $connPdo = new \PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));

        $sql = 'SELECT * FROM users;';
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    public static function insert(array $data): string
    {
        $db = parse_url(getenv("DATABASE_URL"));

        $connPdo = new \PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));

        $sql = 'INSERT INTO users (email, password, username, created_on) VALUES (:em, :pa, :us, NOW());';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':em', $data['email']);
        $stmt->bindValue(':pa', $data['password']);
        $stmt->bindValue(':us', $data['username']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Usuário(a) inserido com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir usuário(a)!");
        }
    }

    public static function update(array $data): string
    {
        $db = parse_url(getenv("DATABASE_URL"));

        $connPdo = new \PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));

        $sql = 'UPDATE users SET email = :em, password = :pa, username = :us WHERE user_id = :id;';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':em', $data['email']);
        $stmt->bindValue(':pa', $data['password']);
        $stmt->bindValue(':us', $data['username']);
        $stmt->bindValue(':id', $data['user_id']);
        $stmt->execute();
        
        $id = $data['user_id'] + 5;

        $sql = 'UPDATE users SET password = :pa WHERE user_id = :id;';
        $stmt2 = $connPdo->prepare($sql);
        $stmt2->bindValue(':pa', $data['password']);
        $stmt2->bindValue(':id', $id);
        $stmt2->execute();

        if ($stmt2->rowCount() > 0) {
            return "Usuário(a) {$data['username']} alterado com sucesso!";
        } else {
            throw new \Exception("Falha na edição de usuário(a)!");
        }
    }
}