<?php
    extract ($_GET);
    if (isset($_GET["firstName"]) && isset($_GET["lastName"]) && isset($_GET["phoneNumber"]) && isset($_GET["city"]) && isset($_GET["address"]) && isset($_GET["postalCode"]))
    {
        $firstName = $_GET["firstName"];
        $lastName = $_GET["lastName"];
        $phoneNumber = $_GET["phoneNumber"];
        $city = $_GET["city"];
        $address = $_GET["address"];
        $postalCode = $_GET["postalCode"];
    
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "vetclinic";
        $connection = mysqli_connect($host, $user, $password, $database);
                     
        mysqli_query($connection, "INSERT INTO owner VALUES (NULL, '$firstName', '$lastName', '$phoneNumber', '$address', '$city', '$postalCode')");
        
        header ("Location: tech.php"); 
    }
    else
    {
        echo "Missing Data";
    }
?>

