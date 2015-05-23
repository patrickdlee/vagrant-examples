<?php
require_once APPLICATION_DIR . '/models/WishListItem.php';

class WishListDAO
{
    private $pdo;
    private $memcache;

    const ALL_ITEMS_KEY = 'allItems';
    const CACHE_LIFETIME = 15;

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
        $items = $this->memcache->get(self::ALL_ITEMS_KEY);
        if (is_array($items)) {
            return $items;
        }

        // fetch the items from the database
        $query = "SELECT id, name, description FROM WishListItem ORDER BY id";
        $result = $this->pdo->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS, 'WishListItem');
        $items = $result->fetchAll();

        // store the items in Memcache for a short time
        $this->memcache->set(self::ALL_ITEMS_KEY, $items, MEMCACHE_COMPRESSED, self::CACHE_LIFETIME);

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
