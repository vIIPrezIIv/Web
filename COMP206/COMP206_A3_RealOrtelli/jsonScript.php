<?php
    session_start();
    extract($_GET);
    
    $_SESSION['table_default']++;
    $_SESSION['pages'] = 0;
    $_SESSION['dept_no'] = $dept_no;

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "employees";
    $connection = mysqli_connect($host, $user, $password, $database);
    
    $result = mysqli_query($connection, "SELECT first_name,last_name  
                                         FROM dept_emp 
                                         INNER JOIN employees
                                         USING(emp_no) 
                                         INNER JOIN departments
                                         USING(dept_no)
                                         WHERE dept_no = '$dept_no' LIMIT 10");
    
    $result2 = mysqli_query($connection, "SELECT COUNT(*) / 10 AS ctr
                                          FROM dept_emp 
                                          INNER JOIN employees
                                          USING(emp_no) 
                                          INNER JOIN departments
                                          USING(dept_no)
                                          WHERE dept_no = '".$_SESSION['dept_no']."'
                                          GROUP BY dept_no");
        
    $jsonArray = array();
    //array_push($jsonArray , array() , array());
    if(mysqli_num_rows($result)){
        while($row = mysqli_fetch_assoc($result))
        {
        /*foreach($row AS $key => $val){
            $jsonArray[$key] = $val;
        }*/
            array_push($jsonArray, array("FirstName" => $row["first_name"] , 
                                         "LastName" => $row["last_name"]));
        //$jsonArray["first_name"] = $row["first_name"];
        //$jsonArray["last_name"] = $row["last_name"];
        }
    }
    
    /*if(mysqli_num_rows($result2)){
        while($row = mysqli_fetch_assoc($result2))
        {
            array_push($jsonArray[1], array("Limit" => $row["ctr"]));
        }
    }*/
    echo json_encode($jsonArray);
    
?>

