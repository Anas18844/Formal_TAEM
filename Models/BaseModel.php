<?php

namespace App\Models;

use AncientEgyptianMuseum\Database\DB;

class BaseModel {
    protected $db;

    public function __construct() {
        $this->db = (new DB())->getConnection();
    }
}
