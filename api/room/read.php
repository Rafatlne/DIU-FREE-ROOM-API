<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../database/Database.php';
include_once '../objects/roomQuery.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->connect();
 
// initialize object
$roomQuey = new roomQuery($db);
 
// query products
$stmt = $roomQuey->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $freeroom_arr=array();
 
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $freeroom_item=array(
            "id" => $id,
            "roomNo" => $roomNo,
            "day" => $day,
            "time" => $time,
            "timeStamp" => $timeStamp,
            "isbooked" => $isbooked,
           "contact_no" => $contact_no,
            "courseCode" => $courseCode
        );
 
        //array_push($products_arr["records"], $product_item);
        array_push($freeroom_arr, $freeroom_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);

    // //tell the user
    // echo json_encode(array("successful"));
 
    // show products data in json format
    echo json_encode($freeroom_arr);
}
 
// no products found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}