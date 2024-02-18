<?php
require_once('../backend/conn.php');

$sql = "SELECT * FROM student";

if(isset($_REQUEST['val'])){
    $to_search = $_REQUEST['val'];
    $sql = "SELECT * FROM student WHERE year = '$to_search'";
    $result = $conn->query($sql);
}

foreach($conn->query($sql) as $row){
    echo "<tr class=tbrows id=tbrows width=100% >";
    // echo "<td>" . $i ."</td>";
    echo "<td>" . $row["student_id"] . "</td>";
    echo "<td>" . $row["rf_id"] . "</td>";
    echo "<td>" . $row["last_name"] . "</td>";
    echo "<td>" . $row["first_name"] . "</td>";
    echo "<td>" . $row["middle_initial"] . "</td>";
    echo "<td>" . $row["Sex"] . "</td>";
    echo "<td>" . $row["course"] . "</td>";
    echo "<td>" . $row["year"] . "</td>";
    echo "<td>" . $row["section"] . "</td>";
    ?>
    <form class="delete-function" method="post" action= "delete.php">
    <td>
      <!-- delete btn -->
      <input id="deletebtn" type="hidden" name="delete_id" value="<?php echo $row["id"];?>">
      <input id="deletebtn" type="submit" name="delete" value="Delete" class="deletebtn">
      <!-- update btn -->
      <input id="updatebtn" type="hidden" name="update_id" value="<?php echo $row["id"];?>">
      <input id="updatebtn" type="submit" name="update" value="Update" class="updatebtn">
    </td></tr>
    </form>
    <?php
    // $i = $i + 1;
 } 
?>