<section id="container-profile">
    <p style="margin-top: 140px;">Hello! <?php echo $_SESSION['auth']['first_name']; ?></p> <br>

    <table id="profile-table-purchases">
        <tr>
            <th>ITEM NAMES</th>
            <th>PRICE</th>
            <th>DATE OF PURCHASE</th>
            <th></th>
        </tr>
        <?php 
            // Display all receipts in rows
            if (isset($_SESSION['profile-receipts'])) {
                $ids = $_SESSION['profile-receipts-ids'];
                $receipts = $_SESSION['profile-receipts'];
                $dates = $_SESSION['profile-receipts-dates'];
                
                // Loop thorugh each receipt in receipts
                for ($i = 0; $i < count($receipts); $i++) {
                    // Make new strings for itemNames, itemPrices, and itemDate
                    $itemId = 0;
                    $itemNames = "";
                    $itemPrices = "";
                    $itemTotal = [];
                    $itemDate = "";

                    // Loop through each items in receipt
                    for ($j = 0; $j < count($receipts[$i]); $j++) {
                        // Append new item names, prices, and date to itemNames, itemPrices, and itemDate
                        
                        $itemId = $ids[$i];
                        $itemNames .= $receipts[$i][$j]->item_name . "<br>";
                        $itemPrices .= "₱ " . number_format($receipts[$i][$j]->item_price, 2) . "<br>";
                        array_push($itemTotal, $receipts[$i][$j]->item_price); ;
                        $itemDate = date('Y-m-d h:i A' , strtotime($dates[$i])) . "<br>";
                    } 
                    
                    echo '<tr>
                            <td>' . $itemNames . '</td>
                            <td>' . $itemPrices . '<hr> <p class="profile-item-total">₱ ' . 
                                                        number_format(array_sum($itemTotal), 2) . 
                                                        '</p> 
                                                    </td>
                            <td>' . $itemDate . '</td>
                            <td>
                                <form action="purchase-delete" method="POST">
                                    <input name="item-id" value="' . $itemId . '" type="hidden" />
                                    <button type="submit" class="btn btn-delete-purchase">
                                        DELETE
                                    </button>
                                </form>
                            </td>
                        </tr>';
                }

            } else {
                echo "You have not yet bought any items from our store.";
            }
        ?>
    </table>
</section>