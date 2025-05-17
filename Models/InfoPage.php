<?php

namespace App\Models;

use App\Models\BaseModel;
use PDO;



class InfoPage extends BaseModel {
    public int $id;
    public string $slug;
    public string $title;
    public string $content;

  
  public function publish(): void {
    $query = $this->db->prepare("INSERT INTO info_pages (slug, title, content) VALUES (:slug, :title, :content)");

    $query->bindParam(':slug', $this->slug);
    $query->bindParam(':title', $this->title);
    $query->bindParam(':content', $this->content);

    $query->execute();
    $this->id = $this->db->lastInsertId();
}


   public function updateContent(string $newContent): void {
    $query = $this->db->prepare("UPDATE info_pages SET content = :content WHERE id = :id");

    $query->bindParam(':content', $newContent);
    $query->bindParam(':id', $this->id);

    $query->execute();
    $this->content = $newContent;
}


  public function archive(): void {
    $query = $this->db->prepare("UPDATE info_pages SET archived = 1 WHERE id = :id");

    $query->bindParam(':id', $this->id);
    $query->execute();
}

    public function getSlug(): string {
        return $this->slug;
    }
}
?>
