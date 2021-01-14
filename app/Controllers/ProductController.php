<?php
$id = $_GET['item_id'];
//$_SESSION['store-item'] = Product::getProduct($lastUriSegment);
echo json_encode(Product::getProduct($id));
?>