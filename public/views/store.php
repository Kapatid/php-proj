<div class="container-bg"></div>
<div class="container-modal">
    <div class="modal-body">
        <div class="modal-header">
            <div class="icon-exit exit-modal-book"></div>
        </div>

        <div class="modal-content">
            <div id="modal-content-checkout">
                Your cart is empty.
            </div>
        </div>

        <div class="modal-footer">
            <a class="btn btn-store-buy" style="color:white; background-color:rgb(49, 180, 49)">BUY NOW</a>
        </div>
    </div>
</div>

<div id="container-store">
    <div id="container-store-search">
        <input type="text" placeholder="Search" id="store-search" name="store-search">
        <div class="icon icon-search"></div>
    </div>

    <div id="container-store-items">
        <?php 
            // Show each items in the store database
            if (isset($_SESSION['store-items']) || !empty($_SESSION['store-items'])) {
                $items = $_SESSION['store-items'];

                for ($i = 0; $i < count($_SESSION['store-items']); $i++) {
                    $item_id = $items[$i]['id'];
                    $item_name = $items[$i]['item_name'];
                    $item_price = $items[$i]['item_price'];
                    $item_path= $items[$i]['item_path'];

                    echo '<div class="container-store-item">
                            <img src="' . $item_path . '" 
                                alt="' . $item_name . '">
                
                            <h5 class="store-item-name">' . $item_name . '</h5>
                
                            <p class="store-item-price">₱ ' . number_format($item_price, 2) . '</p>
                
                            <div class="container-store-add">
                                <a class="btn btn-store-add" data-id="' . $item_id . '">
                                    ADD TO CART
                                </a>
                            </div>
                          </div>';
                }
            }
            else {
                echo '<h4 style="color: red">NO ITEMS IN STORE</h4>';
            }
        ?>
    </div>
</div>

<div id="container-btn-cart" class="open-modal">
    <div id="store-item-count">
        0
    </div>

    <div id="btn-cart">
        <div class="icon icon-cart"></div>
    </div>
</div>