

function funcExit(){
    window.location.href = '../Dashboard/dashboard.php';
}

function openContents(evt, contentName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(contentName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();


var minDate, maxDate; 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[8] );
 
        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);

 


  $(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
    });
    var table1 = $('#dataTable1').DataTable({
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'copy',
            text: 'Copy'
          },
          {
            extend: 'csv',
            text: 'CSV'
          },
          {
            extend: 'excel',
            text: 'Excel'
          },
          {
            extend: 'pdf',
            text: 'PDF'
          },
          {
            extend: 'print',
            text: 'Print'
          }
          // {
          //   extend: 'dateRange',
          //   text: 'Filter by Date Range'
          // }
        ],
        
      });
    var table = $('#dataTable').DataTable({
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'copy',
          text: 'Copy'
        },
        {
          extend: 'csv',
          text: 'CSV'
        },
        {
          extend: 'excel',
          text: 'Excel'
        },
        {
          extend: 'pdf',
          text: 'PDF'
        },
        {
          extend: 'print',
          text: 'Print'
        }
        // {
        //   extend: 'dateRange',
        //   text: 'Filter by Date Range'
        // }
      ],
      
    });
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });
    
});
    
//   });
  