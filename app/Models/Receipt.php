<?php

class Receipt extends Database {

    public static function getReceiptRows() {
        $db = new Database();
        $user_id = $_SESSION['auth']['id'];
        return $db->findAll("receipts", "user_id", $user_id);
    }

    public static function createReceipt(array $purchases) {
        $data = array(
            "user_id" => $_SESSION['auth']['id'],
            "items" => json_encode($purchases)
        );

        $db = new Database();
        return $db->create("receipts", $data);
    }

    public static function delReceipt(int $id) {
        $db = new Database();
        $db->delete("receipts", $id);
    }

}