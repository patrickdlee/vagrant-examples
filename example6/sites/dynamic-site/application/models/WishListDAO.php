<?php
require_once APPLICATION_DIR . '/models/WishListItem.php';

class WishListDAO
{
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
    }

    public function getItem($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM WishListItem WHERE id = :id");
        $stmt->execute(array(':id' => $id));
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'WishListItem');
        return $result[0];
    }

    public function getAllItems() {
        $query = "SELECT id, name, description FROM WishListItem ORDER BY id";
        $result = $this->pdo->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS, 'WishListItem');
        return $result->fetchAll();
    }

    public function addItem($name, $description) {
        $query = "INSERT INTO WishListItem (name, description) VALUES (:name, :desc)";
        $params = array(':name' => $name, ':desc' => $description);
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
    }

    public function editItem($id, $name, $description) {
        $query = "UPDATE WishListItem SET name = :name, description = :desc WHERE id = :id";
        $params = array(':id' => $id, ':name' => $name, ':desc' => $description);
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
    }

    public function deleteItem($id) {
        $stmt = $this->pdo->prepare("DELETE FROM WishListItem WHERE id = :id");
        $stmt->execute(array(':id' => $id));
    }
}
