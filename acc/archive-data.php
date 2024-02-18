<?php
require_once('../backend/conn.php');

$sql = "SELECT * FROM archived_data";

if(isset($_REQUEST['val'])){
    $to_search = $_REQUEST['val'];
    $sql = "SELECT * FROM attendance_form WHERE $to_search";
    $result = $conn->query($sql);
}

foreach($conn->query($sql) as $row){
    echo "<tr class=tbrows id=tbrows width=100% >";
    // echo "<td>" . $i ."</td>";
    echo "<td>" . $row["Student_ID"] . "</td>";
    echo "<td>" . $row["Last_Name"] . "</td>";
    echo "<td>" . $row["First_Name"] . "</td>";
    echo "<td>" . $row["Course"] . "</td>";
    echo "<td>" . $row["Year"] . "</td>";
    echo "<td>" . $row["Section"] . "</td>";
    echo "<td>" . $row["rf_id"] . "</td>";
    echo "<td>" . $row["Temperature"] . "</td>";
    echo "<td>" . $row["date"] . "</td>";
    echo "<td>" . $row["Time"] . "</td>";
}
    ?> 
    <!-- <form class="delete-function" method="post" action= "delete.php">
    <td>
      <input id="deletebtn" type="hidden" name="delete_id" value="<?php echo $row["id"];?>">
      <input id="deletebtn" type="submit" name="delete" value="Delete" class="deletebtn">
    </td></tr>
    </form> -->
     <!-- // $i = $i + 1; -->
  

<!-- 
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root', '', 'stemsdb');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM archived_data WHERE Section = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Student_ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Course</th>
<th>Year</th>
<th>Section</th>
<th>Temperature</th>
<th>Time</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<td>" . $row["Student_ID"] . "</td>";
  echo "<td>" . $row["Last_Name"] . "</td>";
  echo "<td>" . $row["First_Name"] . "</td>";
  echo "<td>" . $row["Course"] . "</td>";
  echo "<td>" . $row["Year"] . "</td>";
  echo "<td>" . $row["Section"] . "</td>";
  echo "<td>" . $row["rf_id"] . "</td>";
  echo "<td>" . $row["Temperature"] . "</td>";
  echo "<td>" . $row["Time"] . "</td>"; -->
<!-- }
echo "</table>";
mysqli_close($con); -->