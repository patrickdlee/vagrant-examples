<?php
require_once APPLICATION_DIR . '/models/WishListItem.php';

class WishListDAO
{
    private $pdo;
    private $memcache;

    public function __construct() {
        // establish connection to MySQL
        $this->pdo = new PDO(DB_DSN, DB_USER, DB_PASS);

        // establish connection to Memcache
        $this->memcache = new Memcache();
        $this->memcache->connect(CACHE_HOST, CACHE_PORT);
    }

    public function getItem($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM WishListItem WHERE id = :id");
        $stmt->execute(array(':id' => $id));
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'WishListItem');
        return $result[0];
    }

    public function getAllItems() {
        // check if the items are in Memcache
        $items = $this->memcache->get('allItems');
        if (is_array($items)) {
            return $items;
        }

        // fetch the items from the database
        $query = "SELECT id, name, description FROM WishListItem ORDER BY id";
        $result = $this->pdo->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS, 'WishListItem');
        $items = $result->fetchAll();

        // store the items in Memcache for ten seconds
        $this->memcache->set('allItems', $items, MEMCACHE_COMPRESSED, 10);

        return $items;
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
