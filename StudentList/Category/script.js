$(document).ready(function () {
    $('#example').DataTable();
});

// $(document).ready(function(){
//     $("#filterYear").on('change',function(){
//         var value = $(this).val();
//         var section = $("filterSection").val()
//         $.ajax({
//             url:"fetch.php",
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
    
    $("#filterSex").on('change',(e)=>{
        const val = e.target.value
        dataTable.columns(6).search(val).draw();
    
    })
    $("#filterCourse").on('change',(e)=>{
        const val = e.target.value
        dataTable.columns(7).search(val).draw();
    
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