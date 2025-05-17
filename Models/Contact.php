<?php

namespace App\Models;

use App\Models\BaseModel;
use PDO;
use Datetime;

class Contact extends BaseModel {
    public int $id;
    public string $name;
    public string $email;
    public string $subject;
    public string $message;
    public  $sentAt;

   public function submit(): void {
    $this->sentAt = new DateTime();
    $formattedDate = $this->sentAt->format('Y-m-d H:i:s');

    $query = $this->db->prepare("
        INSERT INTO contacts (name, email, subject, message, sent_at)
        VALUES (:name, :email, :subject, :message, :sent_at)
    ");

    $query->bindParam(':name', $this->name);
    $query->bindParam(':email', $this->email);
    $query->bindParam(':subject', $this->subject);
    $query->bindParam(':message', $this->message);
    $query->bindParam(':sent_at', $formattedDate);

    $query->execute();
}


    public function respond(string $response): void {
        echo "Responding to {$this->email}: $response\n";
    }
}
?>
