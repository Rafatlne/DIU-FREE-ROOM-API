<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../database/Database.php';
include_once '../objects/roomQuery.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->connect();
 
// initialize object
$roomQuery = new roomQuery($db);

 
// get posted data
$json = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
foreach($json as $data)
{
        if(!empty($data->roomNo) && !empty($data->day) &&
           !empty($data->time) && !empty($data->timeStamp))
            {
        
            // set product property values
            $roomQuery->roomNo = $data->roomNo;
            $roomQuery->day = $data->day;
            $roomQuery->time = $data->time;
            $roomQuery->timeStamp = $data->timeStamp;
        
                // create the product
                if($roomQuery->insertAllJson()){
            
                    // set response code - 201 created
                    http_response_code(201);
        

                }
        
            // if unable to create the product, tell the user
                else{
            
                    // set response code - 503 service unavailable
                    http_response_code(503);
            
                    // tell the user
                    echo json_encode(array("message" => "Unable to create product."));
                }
        }
        
        // tell the user data is incomplete
        else{
        
            // set response code - 400 bad request
            http_response_code(400);
        
            // tell the user
            echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
        }
}

?>