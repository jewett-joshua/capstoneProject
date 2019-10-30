<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare patient object
$patient = new Patient($db);

// query patient
$stmt = $patient->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // patients array
    $patients_arr=array();
    $patients_arr["patients"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $patient_item=array(
            "Patient_Name_First" => $Patient_Name_First,
            "Patient_Name_Last" => $Patient_Name_Last,
            "Rank" => $Rank,
            "Branch" => $Branch,
            "Component" => $Component,
            "Address_Street" => $Address_Street,
            "Address_City" => $Address_City,
            "Address_State" => $Address_State
        );
        array_push($patients_arr["patients"], $patient_item);
    }
 
    echo json_encode($patients_arr["patients"]);
}
else{
    echo json_encode(array());
}
?>