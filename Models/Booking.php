<?php

namespace App\Models;

use App\Models\BaseModel;
use PDO;

class Booking extends BaseModel {
    public $id;
    public $bookingDate;
    public $status;
    public $participants;
 
    public function confirm($bookingId) {
        $query = $this->db->prepare("UPDATE bookings SET status = 'confirmed' WHERE id = :id");
        $query->bindParam(':id', $bookingId);
        return $query->execute();
    }

    public function cancel($bookingId) {
        $query = $this->db->prepare("UPDATE bookings SET status = 'cancelled' WHERE id = :id");
        $query->bindParam(':id', $bookingId);
        return $query->execute();
    }

    public function modifyParticipants($bookingId, $count) {
        $query = $this->db->prepare("UPDATE bookings SET participants = :count WHERE id = :id");
        $query->bindParam(':count', $count);
        $query->bindParam(':id', $bookingId);
        return $query->execute();
    }

    public function getBooking($bookingId) {
        $query = $this->db->prepare("SELECT * FROM bookings WHERE id = :id");
        $query->bindParam(':id', $bookingId);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
