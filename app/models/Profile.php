<?php

namespace app\models;

class Profile extends \app\core\Model {

    public $profile_id;
    public $bio;
    public $filename;
    
    // the constructor
    public function __construct() {
        parent::__construct();
    }




}