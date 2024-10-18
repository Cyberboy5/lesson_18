<?php

namespace App\Model;

use App\Model\Model;
use PDO;
use PDOException;

class Product extends Model {
    public static $table_name = 'products';
    
    public static function update($id, $data) {
        $setClause = '';
        foreach ($data as $key => $value) {
            $setClause .= "{$key} = :{$key}, ";
        }
        $setClause = rtrim($setClause, ', ');

        $query = "UPDATE " . static::$table_name . " SET $setClause WHERE id = :id";
        // dd($query);
        try {
            $stmt = self::connect()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}

?>