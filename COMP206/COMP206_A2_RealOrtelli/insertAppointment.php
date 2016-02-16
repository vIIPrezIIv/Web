<?php
     extract ($_GET);
     
     if (/*isset($_GET["vetId"]) && isset($_GET["petId"]) &&*/ isset($_GET["date"]) && isset($_GET["time"]))
     {
         //$vetId = $_GET["vetId"];
         //$petId = $_GET["petId"];
         $dateTime = $_GET["date"] . ' ' . $_GET["time"];
         $vetSelected = $_GET["vetSelected"];
         $petSelected = $_GET["petSelected"];
         
         $host = "localhost";
         $user = "root";
         $password = "";
         $database = "vetclinic";
         $connection = mysqli_connect($host, $user, $password, $database);
                    
         /*$result = mysqli_query($connection, "SELECT vet_id FROM vet WHERE vet_id = $vetId");
         $result2 = mysqli_query($connection, "SELECT pet_id FROM pet WHERE pet_id = $petId");
       
         if ($result->num_rows > 0 && $result2->num_rows > 0)
         {*/
             mysqli_query($connection, "INSERT INTO appointment VALUES (NULL, (SELECT vet_id FROM vet WHERE '$vetSelected' = CONCAT(firstName, ' ', lastName)), (SELECT pet_id FROM pet WHERE '$petSelected' = petName), '$dateTime')");
             
             header ("Location: tech.php");
         /*}
         else
         {
             echo "The ID's do not exist";
         }*/ 
     }
     else
     {
         echo "Missing Data";
     }
?>

