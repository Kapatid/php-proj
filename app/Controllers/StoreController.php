<?php

class StoreController extends Controller {

    public static function index() {
        // Insert all products into a session
        $_SESSION['store-items'] = Product::getProducts();
    }

    /**
     * Get a product in the database and put it in a session
     * 
     */
    public static function getItem() {
        $item_ids = json_decode($_GET['item_id']);
        $store_cart = array();
        
        foreach ($item_ids as $id) {
            array_push($store_cart, Product::getProduct($id));
        }
        
        $_SESSION['cart_items'] = $store_cart;
    }
}