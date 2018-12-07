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
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty

if(
    !empty($data->roomNo) &&
    !empty($data->day) &&
    !empty($data->time) &&
    !empty($data->timeStamp) &&
    !empty($data->isbooked) &&
    !empty($data->contact_no) &&
    !empty($data->courseCode)
){
 
    // set product property values
    $roomQuery->roomNo = $data->roomNo;
    $roomQuery->day = $data->day;
    $roomQuery->time = $data->time;
    $roomQuery->timeStamp = $data->timeStamp;
    $roomQuery->isbooked = $data->isbooked;
    $roomQuery->contact_no = $data->contact_no;
    $roomQuery->courseCode = $data->courseCode;
 
    // create the product
    if($roomQuery->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("successful"));
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

?>