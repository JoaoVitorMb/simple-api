<?php
namespace App\Models;

class User
{
    public static function select()
    {
        return [
            'id' => 1,
            'type' => 'duvida',
            'message' => 'Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.',
            'is_identified' => false,
            'whistleblower_name' => null,
            'whistleblower_birth' => null,
            'created_at' => '2021-06-30 18:47:23',
            'deleted' => true,
        ];
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

        $sql = 'SELECT * FROM users';
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
        return $data;

        $db = parse_url(getenv("DATABASE_URL"));

        $connPdo = new \PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));

        $sql = 'INSERT INTO users (email, password, username, created_on) VALUES (:em, :pa, :us, NOW())';
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