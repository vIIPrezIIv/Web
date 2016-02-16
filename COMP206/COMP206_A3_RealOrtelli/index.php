<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            extract($_GET);
            $host = "localhost";
            $user = "root";
            $password = "";
            $database = "employees";
            $connection = mysqli_connect($host, $user, $password, $database);
            
            $result = mysqli_query($connection, "SELECT * FROM departments");
            
            echo "<table style + 'border:1px solid black' id='table'>";
            
            echo "<th>Departments</th>";
            
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>";
               
                    echo "<td id = $row[dept_no] style = 'border:1px solid black'>";
                    echo $row['dept_name'];
                    echo "</td>";
               
                echo "</tr>";
            }
            echo "</table>";
        ?>
        <?php
            session_start();
            extract($_GET);
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
                                                 WHERE dept_name = 'Finance' LIMIT 10");
            
            echo "<table style + 'border:1px solid black' id='jsonTable'>";
            
            echo "<th colspan = 2>Finance</th>";
            
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>";
               
                    echo "<td style = 'border:1px solid black'>";
                    echo $row['first_name'];
                    echo "</td>";
                    echo "<td style = 'border:1px solid black'>";
                    echo $row['last_name'];
                    echo "</td>";
               
                echo "</tr>";
            }
            echo "</table>";
            
        ?>
        <p>
            <button disabled class = "buttons" id="prev">Prev</button>
            <button class = "buttons" id="next">Next</button>
        </p>
    </body>
    <script type="text/javascript" src="js/libs/jquery/jquery.js">
    </script>
    <script>
    var GLOBAL_page = 1;
        
    $("document").ready(init);
    
    function init()
    {
        $("#table").find("td").click(
              
            function(){
                
                var trClicked = $(this);
                
                GLOBAL_page = 1;
              
                $('#prev').prop("disabled" , true);
                console.log(trClicked.attr("id"));
                $.ajax({
                    url:"jsonScript.php",
                    method: "GET",
                    data: {dept_no: trClicked.attr("id")},
                    datatype: "json",
                    contentType:"application/json"
                    
                }).success(
                  function(msg){
                      msg = $.parseJSON(msg);//dont use on POST
                      //console.log(msg[1][0].Limit);
                      //updateTbl(msg[0] , trClicked);
                      console.log(msg);
                      updateTbl(msg , trClicked);
                }).fail(function(msg){
                      alert(msg);
                });
            }    
        );
        
        $(".buttons").click(function(){
                        
                var butId = $(this).attr("id");
                if(butId == "prev")
                {
                    if(GLOBAL_page > 1)
                    {
                        GLOBAL_page--;
                    }
                }
                else
                {
                    GLOBAL_page++;
                }
                
                if(GLOBAL_page == 1)
                {
                    $('#prev').prop("disabled" , true);
                }
                else if(GLOBAL_page > 1 && $('#prev').prop("disabled") == true)
                {
                    $('#prev').prop("disabled", false);
                }
                     
                $.ajax({
                    url:"prevNext.php",
                    method: "GET",
                    data: {button: $(this).attr("id")},
                    datatype: "json",
                    contentType:"application/json"
                    
                }).success(
                  function(msg){
                    msg = $.parseJSON(msg);//dont use on POST
                    updateTbl(msg , $('#jsonTable').find("th"));
                }).fail(function(msg){
                      alert(msg);
                });
                
              
        });
        
        function updateTbl(msg , trClicked){
        
            if(!msg.length)
            {
                $('#next').prop("disabled", true);
            }
            else
            {   
                    if($('#next').prop("disabled") == true)
                    {
                        $('#next').prop("disabled", false);
                    }
                
                    var tbl = $('#jsonTable').empty().html(
                        "<tr><th colspan = 2>"+ trClicked.text() +"</th></tr>"      
                    );
                
                    $.each(msg , function(){
                        tbl.append("<tr><td style = 'border:1px solid black'>"+this["FirstName"]+"</td><td style = 'border:1px solid black'>"+this["LastName"]+"</td></tr>");
                    });
                       
                    if(msg.length < 10)
                    {
                        $('#next').prop("disabled", true);
                    }
            }
        }
    }
    </script>
</html>
