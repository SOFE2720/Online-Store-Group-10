<!-- to connect to the database -->
<?php
    $conn = new mysqli("localhost", "root", "", "cart_system");
    if($conn->connect_error){     ///checking error
        die("Connection Failed!".$conn->connect_error);
    }

?>