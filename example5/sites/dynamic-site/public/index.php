<?php
require_once '../application/config.php';
require_once APPLICATION_DIR . '/models/WishListDAO.php';

$wishListDAO = new WishListDAO();
$items = $wishListDAO->getAllItems();

require_once APPLICATION_DIR . '/views/header.php';
require_once APPLICATION_DIR . '/views/allitems.php';
require_once APPLICATION_DIR . '/views/footer.php';
