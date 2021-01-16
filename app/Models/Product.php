<?php

class Product extends Database {

    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    public function getProducts() {
        return $this->db->getAll("store_items");
    }

    public function getProduct(int $id) {
        return $this->db->find("store_items", $id);
    }
}