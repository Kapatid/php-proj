<?php

class Product extends Database {

    public static function getProducts() {
        $db = new Database();
        return $db->getAll("store_items");
    }

    public static function getProduct(int $id) {
        $db = new Database();
        return $db->find("store_items", $id);
    }
}