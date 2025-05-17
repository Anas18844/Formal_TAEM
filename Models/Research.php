<?php

namespace App\Models;

use App\Models\BaseModel;
use PDO;

class Research extends BaseModel {
    public int $id;
    public string $topic;
    public string $summary;
    public  $startDate;
    public  $endDate;



public function addFinding(string $finding): void {
    $query = $this->db->prepare("INSERT INTO research (research_id, finding) VALUES (:research_id, :finding)");
    $query->bindParam(':research_id', $this->id, PDO::PARAM_INT);
    $query->bindParam(':finding', $finding, PDO::PARAM_STR);
    $query->execute();
}

public function publish(): void {
    $query = $this->db->prepare("UPDATE research SET published = 1 WHERE id = :id");
    $query->bindParam(':id', $this->id, PDO::PARAM_INT);
    $query->execute();
    echo "Research #{$this->id} published.\n";
}

}
?>
