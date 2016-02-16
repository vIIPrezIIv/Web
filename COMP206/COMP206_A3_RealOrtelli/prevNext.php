<?php
    session_start();
    extract($_GET);
    
    if (empty($_SESSION['pages']))
    {
        $_SESSION['pages'] = 0;
    }
    
    if (empty($_SESSION['table_default']))
    {
        $_SESSION['table_default'] = 1;
    }
    
    if ($button == "next")
    {
        $_SESSION['pages']++;
    }
    else
    {
        $_SESSION['pages']--;
    }
    
    $pagesResults = $_SESSION['pages'] * 10;
    
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "employees";
    $connection = mysqli_connect($host, $user, $password, $database);
    
    if ($_SESSION['table_default'] == 1)
    {
        $result = mysqli_query($connection, "SELECT first_name, last_name  
                                         FROM dept_emp 
                                         INNER JOIN employees
                                         USING(emp_no) 
                                         INNER JOIN departments
                                         USING(dept_no)
                                         WHERE dept_no = 'd002' LIMIT $pagesResults , 10");
    }
    else
    {
        $result = mysqli_query($connection, "SELECT first_name, last_name  
                                         FROM dept_emp 
                                         INNER JOIN employees
                                         USING(emp_no) 
                                         INNER JOIN departments
                                         USING(dept_no)
                                         WHERE dept_no = '".$_SESSION['dept_no']."' LIMIT $pagesResults , 10");
    }
    
    $jsonArray = array();
    if(mysqli_num_rows($result)){
        while($row = mysqli_fetch_assoc($result))
        {
        /*foreach($row AS $key => $val){
            $jsonArray[$key] = $val;
        }*/
            array_push($jsonArray, array("FirstName" => $row["first_name"] , 
                                         "LastName" => $row["last_name"])  );
        //$jsonArray["first_name"] = $row["first_name"];
        //$jsonArray["last_name"] = $row["last_name"];
        }
    }
    
    echo json_encode($jsonArray);
    
?>

