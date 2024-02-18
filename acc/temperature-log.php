<?php
require_once('../backend/conn.php');

$sql = "SELECT * FROM temperature_log";

foreach($conn->query($sql) as $row){
    echo "<tr class=tbrows id=tbrows width=100% >";
    // echo "<td>" . $i ."</td>";
    echo "<td>" . $row["student_id"] . "</td>";
    echo "<td>" . $row["rf_id"] . "</td>";
    // echo "<td>" . $row["last_name"] . $row["first_name"] . "</td>";
    echo "<td>" . $row["temperature"] . "</td>";
    echo "<td>" . $row["date"] . "</td>";
    echo "<td>" . $row["time"] . "</td>";
    ?>
    <!-- <form class="delete-function" method="post" action= "delete.php">
    <td>
      <input id="deletebtn" type="hidden" name="delete_id" value="<?php echo $row["id"];?>">
      <input id="deletebtn" type="submit" name="delete" value="Delete" class="deletebtn">
    </td></tr>
    </form> -->
    <?php
    // $i = $i + 1;
 } 
?>