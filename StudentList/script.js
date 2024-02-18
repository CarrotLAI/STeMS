$(document).ready(function () {
    $('#example').DataTable();
});

function directStudentLog(){
    window.location.href = '../studentLog/studentlogSort.php';
  }
  function directDashboard(){
    window.location.href = '../Dashboard/dashboard.php';
  }
function directStudentList(){
  window.location.href = 'addStudentForm.php';
}
// $(document).ready(function(){
//         $.ajax({
//             url:"fetchRf.php",
//             type: "POST",
//             data: 'year=' + value+"&section="+section,
//             beforeSend:function(){
//                 $(".table-container").html("<span>Working...</span>");
//             },
//             success:function(data){
//                 $(".table-container").html(data)
//             }
//         })
//     })
// })

function loadlink(){
    // $('#InputRf').click('fetchRf.php',function () {
    $('#InputRf').load('fetchRf.php',function () {
         $(this).unwrap();
    });
}
loadlink(); // This will run on page load
setInterval(function(){
    loadlink() // this will run after every 3 seconds
}, 3000);

//filter by search
$(document).ready(function(){
    $("#myInput").on("keyup",function(){
        var value = $(this).val().toLowerCase()
        $("#myTable tr").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)                    
            // console.log(value)       
        })            
    })
})

// Get the modal
var todelete = 0
var modal = document.getElementById('modal');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function deleteModal(id){
  console.log("id to delete: ",id)
  document.getElementById('modal').style.display='block'
  document.getElementById('deletebtn').value = id
}

// function UpdateModal(id){
//     console.log("id to update: ",id)
//     document.getElementById('update-modal').style.display='block'
//     document.getElementById('updatebtn').value = id
//   }

$(document).ready(function () {
    let dataTable = $("#example").DataTable();

    $("#filterCourse").on('change',(e)=>{
        const val = e.target.value
        dataTable.columns(7).search(val).draw();
    })
    $("#filterSex").on('change',(e)=>{
        const val = e.target.value
        dataTable.columns(6).search(val).draw();
    
    })
    $("#filterYear").on('change',(e)=>{
        const val = e.target.value
        dataTable.columns(8).search(val).draw();
    })
    $("#filterSection").on('change',(e)=>{
        const val = e.target.value
        dataTable.columns(9).search(val).draw();
    })
    
});