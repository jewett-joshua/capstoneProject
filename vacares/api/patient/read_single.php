<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare patient object
$patient = new Patient($db);
// set ID property of patient to be edited
$patient->Patient_Name_Last = isset($_GET['Patient_Name_Last']) ? $_GET['Patient_Name_Last'] : die();
// read the details of patient to be edited
$stmt = $patient->read_single();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $patient_arr=array(
        "Patient_Name_First" => $row['Patient_Name_First'],
        "Patient_Name_Last" => $row['Patient_Name_Last'],
        "Rank" => $row['Rank'],
        "Branch" => $row['Branch'],
        "Component" => $row['Component'],
        "Address_Street" => $row['Address_Street'],
        "Address_City" => $row['Address_City'],
        "Address_State" => $row['Address_State']
    );
}
// make it json format
print_r(json_encode($patient_arr));
?>