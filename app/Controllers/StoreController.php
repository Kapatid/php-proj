<?php

class StoreController extends Controller {

    public static function index() {
        $product = new Product();
        // Insert all products into a session
        $_SESSION['store-items'] = $product->getProducts();
    }

    /**
     * Get a product in the database and put it in a session
     * 
     */
    public static function getItem() {
        $product = new Product();

        $item_ids = json_decode($_GET['item_id']); // Id came from an ajax/jquery GET
        $store_cart = array();
        
        foreach ($item_ids as $id) {
            array_push($store_cart, $product->getProduct($id));
        }
        
        ob_end_clean(); // Remove all headers
        echo json_encode($store_cart); // Echo string to a page
        exit; // Skip loading scripts and other html elements
    }

    public static function newReciept() {
        $product = new Product();
        $receipt = new Receipt();

        $item_ids = json_decode($_POST['purchases']);
        $store_cart = array();
        
        // Get all products from database based on id
        foreach ($item_ids as $id) {
            array_push($store_cart, $product->getProduct($id));
        }

        // Insert store_cart as a receipt to database
        $receipt->createReceipt($store_cart);
    }
}