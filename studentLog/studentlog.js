function directStudentList(){
    window.location.href = '../StudentList/studentlist.php'; // ../StudentList/studentListCategory.php
}
function directdashboard(){
    window.location.href = '../Dashboard/dashboard.php';
}

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );

$(document).ready(function(){
    refreshTable();
  });

  function refreshTable(){
      $('#showTable').load('table.php', function(){
        // console.log("test")
         setTimeout(refreshTable, 5000);
      });
  }