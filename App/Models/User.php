<?php
namespace App\Models;

class User
{
    public static function select(int $id)
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

    public static function selectAll()
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

    public static function insert($data)
    {
        return 'Usuário(a) inserido com sucesso!';

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
}