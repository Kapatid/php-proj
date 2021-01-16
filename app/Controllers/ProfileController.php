<?php

class ProfileController extends Controller{
    
    public static function index() {
        $receiptRows = Receipt::getReceiptRows();
        $itemIds = [];
        $items = [];
        $dates = [];

        for ($i = 0; $i < count($receiptRows); $i++) {

            $idColumns = json_decode($receiptRows[$i]['id']); // Get `id` colmun of each row
            array_push($itemIds, $idColumns);

            $itemColumns = json_decode($receiptRows[$i]['items']); // Get `items` colmun of each row
            array_push($items, $itemColumns);
            
            $dateColumns = $receiptRows[$i]['created_at']; // Get `created_at` colmun of each row
            array_push($dates, $dateColumns);
        }

        $_SESSION['profile-receipts-ids'] = $itemIds;
        $_SESSION['profile-receipts'] = $items;
        $_SESSION['profile-receipts-dates'] = $dates;
    }

    public static function deleteReceipt() {{
        $id = $_POST['item-id'];

        Receipt::delReceipt($id);
        self::goToPage("/profile");
    }}
}