<?php

namespace App\Models;

use App\Models\BaseModel;
use PDO;

class Invoice extends BaseModel {
    public  $id;
    public  $issueDate;
    public  $amount;
    public  $status;

   
public function generate(): string {
    $query = $this->db->prepare("INSERT INTO invoices (issue_date, amount, status) VALUES (:issue_date, :amount, :status)");

    $issueDate = $this->issueDate->format('Y-m-d H:i:s'); // assuming DateTime object
    $query->bindParam(':issue_date', $issueDate);
    $query->bindParam(':amount', $this->amount);
    $query->bindParam(':status', $this->status);

    $query->execute();
    $this->id = $this->db->lastInsertId();

    return "Invoice #{$this->id} generated.";
}

public function sendInvoice(): void {
    
    echo "Invoice #{$this->id} sent to recipient.\n";
}


}
?>
















