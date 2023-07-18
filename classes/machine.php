<?php
require_once 'db.php';

class Machine extends Db {
    public function get_machine_type (){
        $sql = "Select * from machine";
        $stmt = $this -> conn->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>