<?php
require_once("../../../classes/Constants.php");
require_once("../../../classes/DBConnect.php");
require_once("../classes/Test.php");
$dbConnect = new DBConnect(Constants::SERVER_NAME,
    Constants::DB_USERNAME,
    Constants::DB_PASSWORD,
    Constants::DB_NAME);

include("../../../Resources/sessions.php");

$teacher_id = $id;
$test = new Test($dbConnect->getInstance());
if(isset($_REQUEST["id"])){
    if($test->deleteTest($_REQUEST["id"],$teacher_id)){
        $test->parentPageRedirect("Test deleted successfully");
        if(file_exists("offline_test/" . $_REQUEST["id"] . ".pdf")){
            unlink("offline_test/" . $_REQUEST["id"] . ".pdf");
        }else{
        }
    }else{
        $test->parentPageRedirect("Error while deleting test");
    }
}else{
    $test->parentPageRedirect("Error while deleting test");
}