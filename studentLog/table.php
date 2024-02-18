<?php
date_default_timezone_set('Asia/Manila');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stemsdb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    	echo "Connection failed: " . $e->getMessage();
    }


// condition to move the recent data into archived data
// $query = "SELECT * FROM `attendance_form` WHERE `Date` != '$date'";
// $fetchQuery = $conn->prepare($query);
// $stmt = $fetchQuery->execute
// end of condition
        $date = date("Y-m-d");
        $query = "INSERT INTO archived_data (Student_ID, Last_Name, First_Name, Course, Year, Section, rf_id, Temperature, Date, Time) SELECT student_id, last_name, first_name, course, year, section, rf_id, Temperature, Date, Time FROM attendance_form WHERE Date != '$date'";
        $fetchQ = $conn->query($query);
        $deleteQuery ="DELETE FROM `attendance_form` WHERE `Date` != '$date'";
        $fetchDeletedQ = $conn->query($deleteQuery); 
        $sql = "SELECT * FROM `attendance_form` WHERE `Date` = '$date'";
        $fetch = $conn->query($sql); 
        $i=1;
        if($fetch){
            foreach($fetch as $row){
                echo "<tr class=tbrows id=tbrows width=100% >";
                echo "<td>" . $i ."</td>";
                echo "<td>" . $row["Student_ID"] . "</td>";
                echo "<td>" . $row["Last_Name"] . "</td>";
                echo "<td>" . $row["First_Name"] . "</td>";
                echo "<td>" . $row["Course"] . "</td>";
                echo "<td>" . $row["Year"] . "</td>";
                echo "<td>" . $row["Section"] . "</td>";
                echo "<td>" . $row["rf_id"] . "</td>";
                echo "<td>" . $row["Temperature"] . "</td>";
                echo "<td>" . $row["Date"]." ".$row['Time']. "</td></tr>";
                $i = $i + 1;
            }      
        }
        $conn = null;
?>