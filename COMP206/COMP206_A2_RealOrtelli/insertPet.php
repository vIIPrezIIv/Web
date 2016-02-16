<?php
    extract ($_GET);
    if (isset($_GET["petName"]) && isset($_GET["breed"]))
    {
        $petName = $_GET["petName"];
        $breed = $_GET["breed"];
        $selectedName = $_GET["ownerSelected"];
        
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "vetclinic";
        $connection = mysqli_connect($host, $user, $password, $database);
        
        mysqli_query($connection, "INSERT INTO pet VALUES (NULL, '$petName', (SELECT owner_id FROM owner WHERE '$selectedName' = CONCAT(firstName, ' ', lastName)), '$breed')");
        
        header ("Location: tech.php"); 
    }
    else
    {
        echo "Missing Data";
    }
?>
    
    
    
    
