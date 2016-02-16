<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>login</title>
        <?php
            extract ($_GET);
            $host = "localhost";
            $user = "root";
            $password = "realreal";
            $database = "vetclinic";
            $connection = mysqli_connect($host, $user, $password, $database);
            
            $userName = $_GET["userName"];
            
            $result = mysqli_query($connection, "SELECT accessRole FROM access WHERE userName = '$userName'");
      
            $role = mysqli_fetch_assoc($result);
            
            switch($role['accessRole'])
            {
                case 'vet':
                    header ("Location: vet.php"); 
                    break;
                case 'tech':
                    header ("Location: tech.php"); 
                    break;
                case 'manager':
                    break;
                default:
                    header ("Location: index.php"); 
                    break;
            }
            
          
        ?>              
    </head>
    <body>
        <form action = "index.php" method="GET">
            <p>
                <input type ="submit" value ="View Pets" name ="viewPets"/>
            </p>
        </form>
        <form action = "index.php" method="GET">
            <p>
                <input type ="submit" value ="View Clients" name ="viewClients"/>
            </p>  
        </form>
        <form action = "index.php" method="GET">
             <p>
                <input type ="submit" value ="View Vets" name ="viewVets"/>
            </p>  
        </form
    </body>
</html>
            
            
            
            
          

