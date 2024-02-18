<?php 
// 	echo "succesfully connected ";
// $test_answer = 'addCardId';
// switch ($test_answer){

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){
	switch ($_POST['action']){

		case 'getDataId':
		getDataId();
		break;
		case 'addCardId':
		addCardId();
		break;		
		case 'checkRecord':
		checkRecord();
		break;
		case 'getTemp':
		getTemp();
		break;
		case 'storeHighTemp':
		storeHighTemp();
		break;
		case 'getData':
		getData();
		break;
		case 'showProcess':
		showProcess();
		default:
		break;
	}
}

function getDataId(){
	include_once('conn.php');
	// if (!empty($_POST)) {
		$id=$_POST["id"];
		$data = [
			'id' => $id 
		];
		// $pdo = Database::connect();
		// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// echo "insa indi timo mag gwa";
		$sql = "SELECT isfetch FROM condition_2 WHERE id = :id";
		$q = $conn->prepare($sql);
		$q->bindParam(':id', $data['id'], PDO::PARAM_INT);
		$q->execute();
		$result = $q->fetch(PDO::FETCH_ASSOC);
		// Database::disconnect();
		echo $result['isfetch'];
		exit();
}

function addCardId(){
	include_once('conn.php');
	$cardid = $_POST["cardid"];
	// $cardid = "23154782";
	$checkQuery = "SELECT student_id FROM student WHERE student_id = '$cardid'";
	$fetch = $conn->query($checkQuery);
	$count = $fetch->rowCount();
	// $stmt = $fetch->fetch();
	if ($count < 1) {
		$query ="INSERT INTO rfid(rf_id) VALUES ('$cardid')";
		$stmt = $conn->query($query);
		$query = "UPDATE condition_2 SET `isfetch` = 2 WHERE `id` = 0"; 
		$fetch = $conn->query($query);
		// $stmt=$fetch->execute();
		echo "inserted succesfully";
	}
	// $fetch= $stmt->fetch(PDO::FETCH_ASSOC);
	if ($count > 0) {
		echo "RF ID is already existing";	
		$query = "UPDATE condition_2 SET `isfetch` = 1 WHERE `id` = 0"; 
		$fetch = $conn->query($query);
		$delQuery = "DELETE FROM rfid";
    	$fetchdelQuery = $conn->query($delQuery);
	}
	// else{
	// 	echo "$count";
	// }
	exit();
}

function checkRecord() {
    include_once('conn.php');
	// echo "connection success";
	$cardid = $_POST["cardid"];
    // $cardid = 1171820;
	// $date = date("Y-m-d");
	// $time = time();
	$isrf_id = 1;
	$id = 0;
	$rfData = [
		'isrf_id' => $isrf_id,
		'id' => $id 
	];
	$conditionSql = "UPDATE stems_condition SET isrf_id = 0 WHERE id = 0"; 
	$conditionStmt1 = $conn->prepare($conditionSql);
	$conditionStmt1->execute();
	$checkSql = "SELECT * FROM student WHERE rf_id = $cardid"; 
	$checkstmt = $conn->query($checkSql);
	$checkResult = $checkstmt->fetchAll(PDO::FETCH_ASSOC);
	if($checkResult){
			// insert data
		// echo "inserted record";
		$sql1 = "INSERT INTO student_log (Student_ID, Last_Name, First_Name, Course, Year, Section, rf_id) SELECT student_id, last_name, first_name, course, year, section, rf_id FROM student WHERE rf_id = '$cardid'";
		$stmt1 = $conn->query($sql1);
		// $fetch = $stmt1->execute();
		echo "inserted record";

	}
	else{
		echo "This student is not register yet \n";		
		$conditionSql = "UPDATE stems_condition SET isrf_id = 1 WHERE id = 0"; // change value to 1 = TRUE	
		$conditionStmt = $conn->query($conditionSql);
		// $conditionStmt->execute();
		echo "setting condition to 1/TRUE";
	}
	$conn=null;
	exit();
}


function getTemp(){
	include_once('conn.php');
	$temp = $_POST["Temperature"];
	// $temp = 38.5;
	$cardid = $_POST["cardid"];
	// $cardid = 1171820;
	$date = date("Y-m-d");
	$current_timestamp = time();
	$time = date('H:i:s', $current_timestamp);
	$student_log = [
		'rf_id' => $cardid,
		'Temperature' => $temp,
		'Date' => $date,
		'Time' => $time
	];
	$sql = "SELECT * FROM student_log WHERE rf_id = :rf_id";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':rf_id', $student_log['rf_id'], PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// echo "retrieved RFID ";
	if($result){
	// if($temp < 38 && $temp > 33){
		$sql = "UPDATE student_log SET Temperature = :Temperature, Date = :Date, Time = :Time WHERE rf_id = :rf_id";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':rf_id', $student_log['rf_id'], PDO::PARAM_INT);
		$stmt->bindParam(':Temperature', $student_log['Temperature']);
		$stmt->bindParam(':Date', $student_log['Date']);
		$stmt->bindParam(':Time', $student_log['Time']);
		$stmt->execute();
		// echo $result['Last_Name'];
		echo "updated temp record";
		exit();
	}
	else{
		echo "failed to update";
	}
	exit();
}

function storeHighTemp(){
	include_once('conn.php');
	// $cardid = 2440600;
	$temp = $_POST["Temperature"];
	// $temp = 36.5;
	$cardid = $_POST["cardid"];
	$date = date("Y-m-d");
	$time = time();
	$student_log = [
		'rf_id' => $cardid,
		'Temperature' => $temp,
		'Date' => $date,
		'Time' => $time
	];
	$sql = "SELECT * FROM student_log WHERE rf_id = :rf_id";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':rf_id', $student_log['rf_id'], PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "retrieved RFID ";
	if($result){
		// echo $result['Student_ID']. " ";
		$sql = "UPDATE student_log SET Temperature = :Temperature, Date = :Date, Time = :Time WHERE rf_id = :rf_id"; // update with high temperature
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':rf_id', $student_log['rf_id'], PDO::PARAM_INT);
		$stmt->bindParam(':Temperature', $student_log['Temperature']);
		$stmt->bindParam(':Date', $student_log['Date']);
		$stmt->bindParam(':Time', $student_log['Time']);
		$stmt->execute();
		//insert
		$sql = "INSERT INTO temperature_log(student_id, rf_id, temperature, date, time) SELECT student_id, rf_id, Temperature, Date, Time FROM student_log WHERE rf_id = $cardid";
		$stmt = $conn->query($sql);
		//delete
		$delsql="DELETE FROM student_log WHERE rf_id = $cardid";
		$dekstmt = $conn->query($delsql);
		echo "moving to temperature log";	
	}
	exit();
}

function getData(){
	include_once('conn.php');
	// if (!empty($_POST)) {
		$id=$_POST["id"];
		$data = [
			'id' => $id 
		];
		// $pdo = Database::connect();
		// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT isrf_id FROM stems_condition WHERE id = :id";
		$q = $conn->prepare($sql);
		$q->bindParam(':id', $data['id'], PDO::PARAM_INT);
		$q->execute();
		$result = $q->fetch(PDO::FETCH_ASSOC);
		// Database::disconnect();
		echo $result['isrf_id'];
		exit();
		}
// }

function showProcess()
{
	include_once('conn.php');
	$cardid = $_POST["cardid"];
	$sql = "INSERT INTO attendance_form (Student_ID, Last_Name, First_Name, Course, Year, Section, rf_id, Temperature, Date, Time) SELECT student_id, last_name, first_name, course, year, section, rf_id, Temperature, Date, Time FROM student_log WHERE Temperature >=34.5 AND Temperature<=38.0";
	$stmt = $conn->query($sql);
	// after insertion
	$movesql = "INSERT INTO archived_data SELECT * FROM  student_log WHERE rf_id = $cardid";
	$movestmt = $conn->query($movesql);
	echo "success";
	$delsql="DELETE FROM student_log";
	$delstmt = $conn->query($delsql);
	exit();
	}


?>