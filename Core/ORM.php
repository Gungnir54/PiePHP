<?php

namespace Core;

class ORM {

    public function __construct() {
        $this->user = 'root';
        $this->password = '';

        try {
            $this->connection = new \PDO('mysql:host=localhost;dbname=Pie_DB;charset=utf8', $this->user, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            print "Error ".$e->getMessage()."\n";
            die();
        }
    }

    public function create($table, $fields) {

        $fieldsString = "";
        $valueString = "";
        $execArray = [];

        foreach($fields as $key => $value) {
            if($key != array_key_last($fields)) {
                $fieldsString .= "$key, ";
                $valueString .= ":$key, ";
            } else {
                $fieldsString .= "$key";
                $valueString .= ":$key";
            }
            $execArray[":$key"] = $value;
        }

        $create = $this->connection->prepare("INSERT INTO $table({$fieldsString}) VALUES ({$valueString})");
        $create->execute($execArray);

        if($create) {
            $id = $this->connection->lastInsertId();
            return $id;
        } else return false;
    }

    public function read($table, $id = 2) {
        $read = $this->connection->prepare("SELECT * FROM $table WHERE id = $id");
        $read->execute();
        $data = $read->fetch(\PDO::FETCH_ASSOC);
        var_dump($data);
        return $data;
    }

    public function update($table, $id, $fields) {

        $fieldsString = "";

        foreach ($fields as $key => $value) {
            if($key != array_key_last($fields)) {
                $fieldsString .= "$key = '$value', ";
            } else {
                $fieldsString .= "$key = '$value'";
            }
        }

        $update = $this->connection->prepare("UPDATE $table SET $fieldsString WHERE id = $id");
        $update->execute();

        if(!empty($update)) {
            echo "C'est modifié";
            return true;
        } else return false;
    }

    public function delete($table, $id) {
        echo $id;
        $delete = $this->connection->prepare("DELETE FROM $table WHERE id = $id");
        $delete->execute();

        if($delete) {
            return true;
        } else return false;
    }

    public function find($table, $params) {

        $requestParams = "";

        foreach($params as $key => $value) {
            $requestParams .= $key." ".$value." ";
        }

        $connectUser = $this->connection->prepare("SELECT * FROM $table $requestParams");
        $connectUser->execute();
        $data = $connectUser->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }
}
