<?php
require_once APPLICATION_DIR . '/models/WishListItem.php';

class WishListDAO
{
    private $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
        }
    }

    public function getAllItems() {
        $items = array();

        $result = $this->mysqli->query("SELECT * FROM WishListItem ORDER BY id");
        while ($row = $result->fetch_object()) {
            $items[] = $this->mapRowToItem($row);
        }

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
