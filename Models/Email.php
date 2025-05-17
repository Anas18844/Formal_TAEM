<?php

namespace App\Models;

use App\Models\BaseModel;
use PDO;
use Datetime;

class Email extends BaseModel {
    public string $address;
    public  $sentDate;


   public function send(string $subject, string $body): void {
    $this->sentDate = new DateTime();

    $query = $this->db->prepare("
        INSERT INTO emails (address, sent_date, subject, body)
        VALUES (:address, :sent_date, :subject, :body)
    ");

    $formattedDate = $this->sentDate->format('Y-m-d H:i:s');

    $query->bindParam(':address', $this->address);
    $query->bindParam(':sent_date', $formattedDate);
    $query->bindParam(':subject', $subject);
    $query->bindParam(':body', $body);

    $query->execute();

    echo "Email sent to {$this->address}.\n";
}


    public function validateEmail(): bool {
        return filter_var($this->address, FILTER_VALIDATE_EMAIL) !== false;
    }
}
?>
