<?php 


namespace assignment\Database;


class Database {
    private $conn;
    public function __construct($host, $username, $password, $dbname){
        $this->conn =  mysqli_connect($host, $username, $password, $dbname);
    }
    public function selectAll($table){
        $query = "select * from $table ";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_All($result, MYSQLI_ASSOC);
        return $rows;
    }

    public function selectColumns($table, $columns){
        $query = "select $columns from $table ";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_All($result, MYSQLI_ASSOC);
        return $rows;
    }

    public function delete($table, $cond){
        $query = "delete from $table where $cond";
        $result = mysqli_query($this->conn, $query);
        if($result == 1) return "True";
        else return "False";
    }

    public function update($table, $data, $cond){
        $query = "update $table set $data where $cond";
        $result = mysqli_query($this->conn, $query);
        if($result == 1) return "True";
        else return "False";
    }

    public function __destruct(){
        mysqli_close($this->conn);
    }
}


