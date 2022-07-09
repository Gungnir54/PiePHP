<?php

namespace Core;

class Entity {

    protected static $relations;

    public function __construct($params) {

        $orm = new \Core\ORM;

        foreach ($this::$relations as $key => $value) {

            $table = strtolower(explode('/', $_SERVER['REQUEST_URI'])[2]);
            $tableJoin = explode(' ', $value)[2];

            if (explode(" ", $value)[1] == "one") {

                $requestParams = "INNER JOIN ".$tableJoin." ON ".$table;
                $params = ["INNER JOIN" => $requestParams, "WHERE" => $table.".id = ".$_COOKIE['user']];
                $params = $orm->find('user', $params);

            } elseif (explode(" ", $value)[1] == "many") {

                $requestParams = "INNER JOIN ".$table."_tags ON ".$table.".id = ".$table."_tags.".$table."_id INNER JOIN ".$tableJoin." ON ".$table."_tags.".$tableJoin."_id = ".$tableJoin.".id";
                $params = ["INNER JOIN" => $requestParams, "WHERE" => $table.".id = ".$_COOKIE['user']];
                $params = $orm->find('user', $params);
            }
        }

        if(is_array($params)){
            foreach ($params as $key => $value) {
                $this->{$key} = $value;
            }
        } else {
            $readInfo = $orm->read('user', $params);
            foreach ($readInfo as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }
}
