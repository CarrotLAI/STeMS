<?php 
// Database configuration 
$dbHost     = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName     = "stemsdb"; 
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
}


$sql = $db->query("SELECT * FROM attendance_form");

if ($sql->num_rows > 0){
    $delimiter = ",";
    $filename = "members-data_" . date('Y-m-d') . ".csv";

    //create a file pointer
    $f = fopen('php://memory', 'w');

    //set column headers
    $fields = array('Student ID', 'Last Name', 'First Name', 'Course', 'Year', 'Section', 'Rf ID', 'Temperature', 'Time' );
    fputcsv($f, $fields, $delimiter);

    //Generate each row of the data
    while($row = $sql->fetch_assoc()){
        $lineData = array($row['Student_ID'], $row['Last_Name'], $row['First_Name'], $row['Course'], $row['Year'], $row['Section'], $row['rf_id'], $row['Temperature'], $row['Time']); 
        fputcsv($f, $lineData, $delimiter); 
    }

    //move back to beginning of file
    fseek($f, 0);

    //Set headers to download file rather tan displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //generate all remaining data on a file pointer
    fpassthru($f);
}
exit;
?>