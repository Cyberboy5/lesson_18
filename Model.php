<?php



interface Form{
    public static function getAll();
    public static function delete($id);
    public static function create($data);
    public static function get_data($data);
    public static function query($query);
    public static function connect();
}

abstract class Model implements Form{

    public $conn;

    public static function connect() {
        self::$conn = null;

        try {
            self::$conn = new PDO('mysql:host=localhost;dbname=lesson_16_db','root','Cyberboy@5');
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return self::$conn;
    }

    public static function getAll(){

        $con = new PDO("mysql"); 
        try {
            $query = "SELECT * FROM " . static::$table_name;

            $stmt = $con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function delete($id){
        try{
            $query = "DELETE FROM " . static::$table_name . " WHERE id = :id"; 
            
            $stmt = self::connect()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
            
        }catch(PDOException $e){
            return false;
        } 
    }

    public static function create($data) {
        // Create placeholders and column names from the array keys
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
    
        // Prepare the query
        $query = "INSERT INTO " . static::$table_name . " ($columns) VALUES ($placeholders)";
    
        try {
            // Connect to the database
            $conn = self::connect();
            $stmt = $conn->prepare($query);
    
            // Bind parameters dynamically
            foreach ($data as $key => $value) {
                // Check if the key is 'password' and hash it using md5
                if ($key == 'password') {
                    $value = md5($value);
                }
                $stmt->bindValue(":$key", $value);
            }
    
            // Execute the query
            $stmt->execute();
    
            // Return the ID of the inserted row
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            // Handle the error
            return false;
        }
    }

    public static function get_data($data){

        $values = '';   
        foreach($data as $key=>$value){
            if($key =='password'){
                $value = md5(($value));
            }
            $values .= "{$key} = '{$value}' AND ";
        }

        $cleanString = rtrim($values,"AND ");
        // dd($cleanString);
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE (" . $cleanString . ")");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function query($query){
        $conn = self::connect();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}                                        

class User extends Model{
    public static $table_name = 'user';
}

    
?>