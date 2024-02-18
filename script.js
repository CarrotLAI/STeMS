var tables= document.getElementsByTagName('table');
while (tables.length>0)
    tables[0].parentNode.removeChild(tables[0]);

// function for dashboard.php   
    
// function noUsername(){
//   msg = document.getElementById('windowAlert');

//   msg.innerHTML = <p>Username is required</p>;
// }
// function noPassword(){
//   window.alert("Password is required");
// }

function directStudentLog(){
  window.location.href = '../studentLog/studentlogSort.php';
}
function directStudentList(){
  window.location.href = '../Studentlist/studentlist.php';
}
function directdashboard(){
  window.location.href = '../Dashboard/dashboard.php';
}
function directAccountSetting(){
  window.location.href = '../acc/accountSetting.php';
}
function funcLogout(){
  window.location.href = '../logout.php';
}