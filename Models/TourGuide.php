<?php

namespace App\Models;

use App\Models\BaseModel;
use PDO;

class TourGuide extends BaseModel {
    public $id;
    public $name;
    public $language;
    public $bio;



    public function assignToEvent($guideId, $eventId) {
        $query = $this->db->prepare("
            INSERT INTO tourguide (id,id)
            VALUES (id, :id)
        ");
        $query->bindParam('id', $eventId);
        $query->bindParam('id', $guideId);
        return $query->execute();
    }

    public function provideTour($guideId, $userId) {
        $query = $this->db->prepare("
            INSERT INTO tours (guide_id, user_id, tour_date)
            VALUES (:guide_id, :user_id, NOW())
        ");
        $query->bindParam(':guide_id', $guideId);
        $query->bindParam(':user_id', $userId);
        return $query->execute();
    }
}
