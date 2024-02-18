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

$database = new Database();
$result = $database->runQuery("SELECT * FROM attendance_form");

require_once('../fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',11);


$pdf->Cell(28,5,"No.",1);
$pdf->Cell(28,5,"Student ID",1);
$pdf->Cell(28,5,"Fullname",1);
$pdf->Cell(28,5,'Course Year Section',1);
$pdf->Cell(28,5,'RF ID',1);
$pdf->Cell(28,5,'Temperature',1);
$pdf->Cell(28,5,"Date & Time",1);
$i = 1;


foreach($result as $row) {
	$pdf->Ln();
	$pdf->Cell(28,5,$i,1);
	$pdf->Cell(28,5,$row['Student_ID'],1);
	$pdf->Cell(28,5,$row['Last_Name']." ".$row['First_Name'] ,1);
	$pdf->Cell(28,5,$row['Course']." ".$row['Year']." ".$row['Section'],1);
	$pdf->Cell(28,5,$row['rf_id'],1);
	$pdf->Cell(28,5,$row['Temperature'],1);
	$pdf->Cell(28,5," ".$row['Year']." ". $row['Time'],1);
    $i++;


}
$pdf->Output();