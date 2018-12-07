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
 
   // set ID property of product to be edited
    $roomQuery->id = $data->id;
    // set product property values
    $roomQuery->isbooked = $data->isbooked;
    $roomQuery->contact_no = $data->contact_no;
    $roomQuery->courseCode = $data->courseCode;
 
// update the product
if($roomQuery->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "successful"));
}
 
// if unable to update the product, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update product."));
}
?>