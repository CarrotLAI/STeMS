document.querySelector('#mySelect').addEventListener('change', ()=>{
    const toSearch = document.querySelector('#mySelect').value

    console.log(toSearch)
    window.location.replace("/project/studentLog/studentlogSort.php?val="+toSearch)
    });