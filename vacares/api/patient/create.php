<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare patient object
$patient = new Patient($db);
 
// set patient property values
$patient->Patient_Name_First = $_POST['Patient_Name_First'];
$patient->Patient_Name_Last = $_POST['Patient_Name_Last'];
$patient->Rank = $_POST['Rank'];
$patient->Branch = $_POST['Branch'];
$patient->Component = $_POST['Component'];
$patient->Address_Street = $_POST['Address_Street'];
$patient->Address_City = $_POST['Address_City'];
$patient->Address_State = $_POST['Address_State'];

// create the patient
if($patient->create()){
    $patient_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "Patient_Name_First" => $patient->Patient_Name_First,
        "Patient_Name_Last" => $patient->Patient_Name_Last,
        "Rank" => $patient->Rank,
        "Component" => $patient->Component,
        "Address_Street" => $patient->Address_Street,
        "Address_City" => $patient->Address_City,
        "Address_State" => $patient->Address_State
    );
}
else{
    $patient_arr=array(
        "status" => false,
        "message" => "Patient already exists!"
    );
}
print_r(json_encode($patient_arr));
?>