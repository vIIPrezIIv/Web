<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>tech</title>    
    </head>
    <body>
        <form action = "insertFunction.php" method ="GET" >
            <h2>Owner Info</h2>
            <p>
                <label>First/Last Name</label>
                <input type ="text" name ="firstName" required ="true" title ="Enter a first name"/>
                <input type ="text" name ="lastName" required ="true" title ="Enter a last name"/>
            </p>
            <p>
                <label>Phone Number</label>
                <input type ="tel" name ="phoneNumber" required ="true" title ="Enter a phone number"/>
            </p>
            <p>
                <label>Address</label>
                <input type ="text" name ="address" required ="true" title ="Enter a address"/>
            </p>
            <p>
                <label>City</label>
                <input type ="text" name ="city" required ="true" title ="Enter a city"/>
            </p>
            <p>
                <label>Postal Code</label>
                <input type ="text" name ="postalCode" required ="true" pattern ="[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]" title ="Enter a postal code"/>
            </p>
            <p>
                <input type ="submit" value ="Submit"/>
            </p>
        </form>
        <form action = "insertPet.php" method ="GET" >
            <h2>Pet Info</h2>
            <p>
                <label>Pet Name</label>
                <input type ="text" name ="petName" required ="true" title ="Enter a pet name"/>
                <label>Breed</label>
                <input type ="text" name ="breed" required ="true" title ="Enter a breed"/>
            </p>
            <p>
                <label>Owner</label>
                <select name = "ownerSelected">
                <?PHP
                    $host = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "vetclinic";
                    $connection = mysqli_connect($host, $user, $password, $database);
                    
                    $result = mysqli_query($connection, "SELECT CONCAT(firstName, ' ', lastName) FROM owner");
                            
                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) 
                        {
                            foreach ($row AS $owners)
                            {
                                echo "<option>".$owners."</option>";
                            }
                        }
                    }
                ?>
                </select>
            </p>
            <p>
                <input type ="submit" value ="Submit"/>
            </p>
        </form>
        <form action = "insertAppointment.php" method ="GET">
            <h2>Schedule Appointments</h2>
            <p>
                <label>Vets</label>
                <select name = "vetSelected">
                 <?PHP
                    $host = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "vetclinic";
                    $connection = mysqli_connect($host, $user, $password, $database);
                    
                    $result = mysqli_query($connection, "SELECT CONCAT(firstName, ' ', lastName) FROM vet");
                            
                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) 
                        {
                            foreach ($row AS $vets)
                            {
                                echo "<option>".$vets."</option>";
                            }
                        }
                    }
                ?>
                </select>
                <!--<input type ="numeric" name ="vetId" required ="true" title ="Enter a vet ID"/>--> 
            </p>
            <p>
                <label>Pets</label>
                <select name = "petSelected">
                <?PHP
                    $host = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "vetclinic";
                    $connection = mysqli_connect($host, $user, $password, $database);
                    
                    $result = mysqli_query($connection, "SELECT petName FROM pet");
                            
                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) 
                        {
                            foreach ($row AS $pets)
                            {
                                echo "<option>".$pets."</option>";
                            }
                        }
                    }
                ?>
                </select>
                <!--<input type ="numeric" name ="petId" required ="true" title ="Enter a pet ID"/>-->
            </p>
            <p>
                <label>Date</label>
                <input type ="date" name ="date" required ="true" title ="Enter a date"/>   
            </p>
            <p>
                <label>Time</label>
                <input type ="time" name ="time" required ="true" title ="Enter a time"/>
            </p>
            <p>
                <input type ="submit" value ="Submit"/>
            </p>
        </form>
        <form action ="index.php">
            <p>
                <input type ="submit" value ="Logout"/>
            </p>
        </form>
    </body>
</html>

    

