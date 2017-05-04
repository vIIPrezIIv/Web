<?php

    $host = "localhost"; 
    $user = "root"; 
    $password = "mysql"; 
    $database = "messages"; 
    $connection = new mysqli($host, $user, $password, $database); 
    $result = null;
    $results = null;
    $allResults;
    //$singleResult;
    
    if(!$connection->errno)
    {
        switch($_SERVER['REQUEST_METHOD'])
        {
            case 'GET':
                
                header('Content-Type: application/json');
                
                $results = array(
                    'status'        => 404,
                    'resourceType'  => '',
                    'data'          => null
                );
                
                if(isset($_GET['id']))
                {
                    $result = $connection->query("SELECT messageData FROM messages WHERE messageId = ".$_GET['id']);
                    //$results = $result->fetch_assoc();
                    //$results['status'] = 200;
                    $results['resourceType'] = 'Item';
                    //$results['data'] = $results['messageId'];
                    //$results['data'] = $results['messageData'];
                    $results['data'] = $result->fetch_assoc();
                }
                else
                {
                    $result = $connection->query("SELECT * FROM messages");

                    while($allResults = $result->fetch_assoc())   
                    {
                        $results['data'][] = $allResults;
                        //$results['data'][] = $allResults['messageId'];
                        //$results['data'][] = $allResults['messageData'];
                    }
                    
                    //$results['status'] = 200;
                    $results['resourceType'] = 'Collection';
                    //$results['data'] = $results[];
                }
                
                if($result->num_rows > 0)
                {
                    $results['status'] = 200;
                    http_response_code(200);
                }   
                else
                {
                    $results['status'] = 404;
                    http_response_code(404);
                }

                break;
                
            case 'PUT':
                
                //$_PUT = json_decode(file_get_contents('php://input'));
                
                //header('Location:' . '');
                
                $input = file_get_contents("php://input");
                
                $input = urldecode($input);
                
                $json = json_decode($input, true);
                
                //var_dump($json);
                //var_dump($input);
                
                if(isset($_REQUEST['id']))
                {
                    $result = $connection->prepare("UPDATE messages SET messageData = ? WHERE messageId = ?");
                    
                    //var_dump($json['message']);
                    //var_dump($_GET['id']);
                    
                    /*IF($result)
                        echo "All ok";
                    ELSE
                        echo "Abandon Ship";*/
                    
                    
                    $result->bind_param('ss', $json['message'], $_GET['id']);
                    
                    $result->execute();
                    
                    $result->close(); 
                    
                    if($result)
                    {
                        header('Location:' . 'messages/' . $_REQUEST['id']);
                        http_response_code(204);
                    }   
                    else
                    {
                        http_response_code(404);
                    }
                }
                else
                {
                    //if($result->execute() && $result->affected_rows > 0)
                    $result = $connection->query("INSERT INTO messages VALUES(NULL, '$json[message]')");
                    //var_dump("INSERT INTO messages VALUES($_GET[id], '$json[message]')");
                    
                    if($result)
                    {
                        $results['id'] = $connection->insert_id;
                    }
                    
                    if($result)
                    {
                        header('Location:' . 'messages/' . $connection->insert_id);
                        http_response_code(201);
                    } 
                    else
                    {
                        http_response_code(404);
                    }
                }
                
                /*if($result)
                {
                    $results['id'] = $connection->insert_id;
                }*/
                
                break;
            
            case 'POST':
                
                $input = file_get_contents("php://input");
                
                $input = urldecode($input);
                
                $json = json_decode($input, true);
                
                //$params = json_decode($_POST[0]);
                
                //$params = jason_decode(current(array_keys($_POST), true));
                
                //if(isset($_GET['id']))
                //{
                $result = $connection->query("INSERT INTO messages VALUES(NULL, '$json[message]')");
                //}
                
                if($result)
                {
                    $results['id'] = $connection->insert_id;
                }
                
                if($result)
                {
                    header('Location:' . 'messages/' . $connection->insert_id);
                    http_response_code(201);
                }   
                else
                {
                    http_response_code(404);
                }
                
                break;
                
            case 'DELETE':
                
                if(isset($_GET['id']))
                {
                    $result = $connection->query("DELETE FROM messages WHERE messageId = ".$_GET['id']);
                }
                
                if($connection->affected_rows > 0)
                {
                    http_response_code(200);
                } 
                else
                {
                    http_response_code(404);
                }
                
                break;
        }

    }
    
    echo json_encode($results);
    
    

