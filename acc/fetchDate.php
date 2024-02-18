<?php
// $conn = new mysqli ("localhost", "root", "", "stemsdb");
// if($conn->connect_error){
// echo "Connection failed" .  $conn->connect_error;
// }



// $sql = "SELECT * FROM archive_data WHERE year = $select1 BETWEEN $select2";
?>
<!-- <select multiple>
  <option>opt 1 text
  <option value="opt 2 value">opt 2 text
  <option value="opt 3 value">opt 3 text
</select> -->

<select id="select-meal-type" multiple="multiple">
    <option value="1">Breakfast</option>
    <option value="2" selected>Lunch</option>
    <option value="3">Dinner</option>
    <option value="4" selected>Snacks</option>
    <option value="5">Dessert</option>
</select>

<script>
    function getSelectValues(select) {
        var options = document.getElementById('select-meal-type').value;
var values = Array.from(options).map(({ value }) => value);
console.log(values);
}
</script>