<?php

namespace Model;

class CommentModel extends \Core\Entity {

    public function __construct($params) {
        parent::__construct($params);
        self::$relations = ['has one article'];
    }
}
