<?php

class Receipt extends Database {

    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    public  function getReceiptRows() {
        $user_id = $_SESSION['auth']['id'];
        return $this->db->findAll("receipts", "user_id", $user_id);
    }

    public function createReceipt(array $purchases) {
        $data = array(
            "user_id" => $_SESSION['auth']['id'],
            "items" => json_encode($purchases)
        );

        return $this->db->create("receipts", $data);
    }

    public function delReceipt(int $id) {
        $this->db->delete("receipts", $id);
    }

}