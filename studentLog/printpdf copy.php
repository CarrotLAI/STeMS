<?php 
class Database {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "stemsdb";
	
	function runQuery($sql) {
		$conn = new mysqli($this->host,$this->user,$this->password,$this->database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $resultset[] = $row;
      }
    }
    $conn->close();

		if(!empty($resultset))
			return $resultset;
	}
}

// $data=array(
// 	array(
// 		"No.",
// 		"Student ID",
// 		"Fullname",
// 		"Course|Year|Section",
// 		"Rf ID",
// 		"Temperature",
// 		"Date|Time"
// 	)
// 	);

$database = new Database();
$result = $database->runQuery("SELECT * FROM attendance_form");

require_once('../fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);
$fontSize = 8;
$tempFontSize = $fontSize;

$pdf->Cell(8,5,"No.",1);
$pdf->Cell(20,5,"Student ID",1);
$pdf->Cell(30,5,'Fullname',1);
$pdf->Cell(30,5,'Course|Year|Section',1);
$pdf->Cell(20,5,'RF ID',1);
$pdf->Cell(25,5,'Temperature',1);
$pdf->Cell(35,5,"Date|Time",1);

	// $pdf->Cell(10, 5, $data[0],1);
	// $pdf->Cell(10, 5, $data[1],1);
	// $pdf->Cell(10, 5, $data[3],1);
	// $pdf->Cell(10, 5, $data[4],1);
	// $pdf->Cell(10, 5, $data[5],1);
	// $pdf->Cell(10, 5, $data[6],1);


foreach($result as $row) {
	$pdf->Ln();
	$item = $row['Last_Name']." ".$row['First_Name'];
	$date_time = $row['Date']." ".$row['Time'];

	$pdf->Cell(8,5,$row['No.'],1);
	$pdf->Cell(20,5,$row['Student_ID'],1);

	$cellWidth=30;
	while($pdf->GetStringWidth($item) > $cellWidth){
	$pdf->SetFontSize($tempFontSize -= 1);
	}
	$pdf ->Cell($cellWidth,5,$item,1); // i remove 0 here
	//reset the size to standard
	$tempFontSize=$fontSize;
	$pdf->SetFontSize($fontSize);

	// $pdf->Cell(28,5,$row['Last_Name']." ".$row['First_Name'] ,1);
	$pdf->Cell(30,5,$row['Course']." ".$row['Year']." ".$row['Section'],1);
	$pdf->Cell(20,5,$row['rf_id'],1);
	$pdf->Cell(25,5,$row['Temperature'],1);

	while($pdf->GetStringWidth($date_time) > 35){
		$pdf->SetFontSize($tempFontSize -= 1);
		}
		$pdf ->Cell(35,5,$date_time,1); // i remove 0 here
		//reset the size to standard
		$tempFontSize=$fontSize;
		$pdf->SetFontSize($fontSize);
	// $pdf->Cell(28,5,$date_time,1);
}
$pdf->Output();
