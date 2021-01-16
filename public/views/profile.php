<section>
    <!--     
    <?php
        // $text = new SecondClass();
        // echo $text->someData();

        // $person = new Person("Roi", 10);
        // // unset($person); // Destroy an object
        // echo "<br>" . $person->getName() . "<br>"; 

        // // Access static property/method
        // echo Person::$dringkingAge . "<br>";
        // Person::setDrinkingAge(21);
        // echo Person::$dringkingAge . "<br>";

        // try {
        //     Person::setDrinkingAge("something");
        //     echo Person::$dringkingAge;
        // } catch (TypeError $e) {
        //     echo "ERROR: " . $e->getMessage();
        // }
    ?>

    <br> <br> <br> -->

    <p style="margin-top: 140px;">Hello! <?php echo $_SESSION['auth']['first_name']; ?></p> <br>

    <table id="profile-table-purchases">
        <tr>
            <th>ITEM NAMES</th>
            <th>PRICE</th>
            <th>DATE OF PURCHASE</th>
            <th></th>
        </tr>
        
        <?php 
        
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
                    $itemDate = "";

                    // Loop through each items in receipt
                    for ($j = 0; $j < count($receipts[$i]); $j++) {
                        // Append new item names, prices, and date to itemNames, itemPrices, and itemDate
                        
                        $itemId = $ids[$i];
                        $itemNames .= $receipts[$i][$j]->item_name . "<br>";
                        $itemPrices .= $receipts[$i][$j]->item_price . "<br>";
                        $itemDate = date('Y-m-d' , strtotime($dates[$i])) . "<br>";
                    } 
                    
                    echo '<tr>
                            <td>' . $itemNames . '</td>
                            <td>' . $itemPrices . '</td>
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