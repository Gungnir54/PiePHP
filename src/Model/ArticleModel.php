<?php

namespace Model;

class ArticleModel extends \Core\Entity {

    public function __construct($params) {
        parent::__construct($params);
        self::$relations = ['has many comment'];
    }
}
