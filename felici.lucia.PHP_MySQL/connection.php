<?php

class connection {
    private static ?PDO $pdo = null;


    public static function connect(): ?PDO
    {
        if (self::$pdo == null) {   //Se pdo non è già assegnato...
            $host = "localhost";
            $user = "user";
            $pass = "password";
            $db = "emilio.russo.PHP-MySQL";
            $chrs = "utf8mb4";

            $attr = "mysql:host=$host;dbname=$db;charset=$chrs";
            $opts =
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

            try {
                self::$pdo = new PDO($attr, $user, $pass, $opts);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        return self::$pdo;
    }
}