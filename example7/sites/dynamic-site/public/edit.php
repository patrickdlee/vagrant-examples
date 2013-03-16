<?php
require_once '../application/config.php';
require_once APPLICATION_DIR . '/models/WishListDAO.php';

$wishListDAO = new WishListDAO();

if (isset($_POST['edit'])) {
    $wishListDAO->editItem($_POST['id'], $_POST['name'], $_POST['desc']);
    header('location: /');
    exit;
}

if (isset($_POST['delete'])) {
    $wishListDAO->deleteItem($_POST['id']);
    header('location: /');
    exit;
}

$item = $wishListDAO->getItem($_GET['id']);

require_once APPLICATION_DIR . '/views/header.php';
require_once APPLICATION_DIR . '/views/edititem.php';
require_once APPLICATION_DIR . '/views/footer.php';
