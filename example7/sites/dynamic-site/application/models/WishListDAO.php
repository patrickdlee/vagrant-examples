<?php
require_once APPLICATION_DIR . '/models/WishListItem.php';

class WishListDAO
{
    private $mysqli;
    private $memcache;

    public function __construct() {
        // establish connection to MySQL
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
        }

        // establish connection to Memcache
        $this->memcache = new Memcache();
        $this->memcache->connect(CACHE_HOST, CACHE_PORT);
    }

    public function getAllItems() {
        // check if the items are in Memcache
        $items = $this->memcache->get('allItems');
        if (is_array($items)) {
            return $items;
        }

        // fetch the items from the database
        $items = array();
        $result = $this->mysqli->query("SELECT * FROM WishListItem ORDER BY id");
        while ($row = $result->fetch_object()) {
            $items[] = $this->mapRowToItem($row);
        }

        // store the items in Memcache for ten seconds
        $this->memcache->set('allItems', $items, MEMCACHE_COMPRESSED, 10);

        return $items;
    }

    private function mapRowToItem($row) {
        $item = new WishListItem();
        $item->setId($row->id);
        $item->setName($row->name);
        $item->setDescription($row->description);
        return $item;
    }
}
