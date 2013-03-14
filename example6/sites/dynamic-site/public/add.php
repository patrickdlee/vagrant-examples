<?php
require_once '../application/config.php';
require_once APPLICATION_DIR . '/models/WishListDAO.php';

$wishListDAO = new WishListDAO();

if (isset($_POST['add'])) {
    $wishListDAO->addItem($_POST['name'], $_POST['desc']);

    header('location: /');
    exit;
}

require_once APPLICATION_DIR . '/views/header.php';
require_once APPLICATION_DIR . '/views/additem.php';
require_once APPLICATION_DIR . '/views/footer.php';
