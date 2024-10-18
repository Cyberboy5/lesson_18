<?php

namespace App\Model;

use PDO;
use PDOException;

interface Form {
    public static function getAll();
    public static function delete($id);
    public static function create($data);
    public static function get_data($data);
    public static function query($query);
    public static function connect();
}

abstract class Model implements Form {
    protected static $conn; 

    public static function connect() {
        if (self::$conn === null) {  
            try {
                self::$conn = new PDO('mysql:host=localhost;dbname=lesson_18_db', 'root', 'Cyberboy@5');
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
        }

        return self::$conn;
    }

    public static function getAll() {
        try {
            $query = "SELECT * FROM " . static::$table_name;

            $stmt = self::connect()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function delete($id) {
        try {
            $query = "DELETE FROM " . static::$table_name . " WHERE id = :id";
            $stmt = self::connect()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function create($data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO " . static::$table_name . " ($columns) VALUES ($placeholders)";

        try {
            $stmt = self::connect()->prepare($query);
            foreach ($data as $key => $value) {
                if ($key == 'password') {
                    $value = md5($value);
                }
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();

            return self::$conn->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function get_data($data) {
        // dd($data);
        $values = '';
        foreach ($data as $key => $value) {
            if ($key == 'password') {
                $value = md5($value);
            }
            $values .= "{$key} = '{$value}' AND ";
        }

        $cleanString = rtrim($values, "AND ");
        // dd($cleanString);
        try {
            $stmt = self::connect()->prepare("SELECT * FROM " . static::$table_name . " WHERE " . $cleanString);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function query($query) {
        try {
            $stmt = self::connect()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>