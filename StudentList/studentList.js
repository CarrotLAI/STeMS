function alertmsg() {
    let msg = "Successfully Added!";
    let event = document.getElementById('alertmsg'); 
}
function directStudentLog(){
    window.location.href = '../studentLog/studentlogSort.php';
  }
  function directDashboard(){
    window.location.href = '../Dashboard/dashboard.php';
  }
function directStudentList(){
  window.location.href = '../addStudentForm.php';
}

function goToBsit(){
  window.location.href = 'Category/BSIT.php';
}
function goToBshm(){
  window.location.href = 'Category/BSHM.php';
}
function goToBsa(){
  window.location.href = 'Category/BSA.php';
}
function goToBsEntrep(){
  window.location.href = 'Category/BSEntrep.php';
}

// document.querySelector('#mySelect').addEventListener('change', ()=>{
//   const toSearch = document.querySelector('#mySelect').value

//   console.log(toSearch)
//   window.location.replace("/project/studentList/Category/BsitFour.php?val="+toSearch)
//   });
// document.getElementById("onchangeYear").onchange = function() {
//   if(value == 3 || value == 4){
//     myFunction()
//   }
// };

// function myFunction() {
//   var x = document.getElementById("fname");
//   x.value = x.value.toUpperCase();
// }