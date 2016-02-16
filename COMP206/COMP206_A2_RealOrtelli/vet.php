<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>vet</title>
        <?php
            extract ($_GET);
            $host = "localhost";
            $user = "root";
            $password = "";
            $database = "vetclinic";
            $connection = mysqli_connect($host, $user, $password, $database);
            
            $result = mysqli_query($connection, "SELECT CONCAT(v.firstname, ' ', v.lastname), b.petname, b.breed, p.appt_time 
                                                 FROM appointment p 
                                                 INNER JOIN vet v
                                                 ON p.vet_id = v.vet_id
                                                 INNER JOIN pet b
                                                 ON p.pet_id = b.pet_id
                                                 ORDER BY appt_time");
            
            echo "<table style + 'border:1px solid black'>";
            
            echo "<th>First Name/Last Name</th><th>Pet Name</th><th>Breed</th><th>Appointment</th>";
            
            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>";
                foreach ($row as $col)
                {
                    echo "<td style = 'border:1px solid black'>";
                    echo $col;
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
         ?>
    </head>
    <body>
        <form action ="index.php">
            <p>
                <input type ="submit" value ="Logout"/>
            </p>
        </form>
    </body>
</html>


