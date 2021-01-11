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

    <p>hello</p>

    <?php 
        foreach ($_SESSION["users"] as $user) {
            echo $user['first_name'] . " " . $user['last_name'] . "<br>";
        }
        unset($_SESSION);
        session_destroy();
    ?>
</section>
