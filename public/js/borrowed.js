$(document).ready(function()
{

    load_data();

    function load_data()  {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        fetchBorrowedBooks(date_from, date_to);
    }

    function fetchBorrowedBooks(date_from, date_to,status){
        console.log(date_from+' asfd');
        console.log(date_to+' dsada');
        $('#borrowed-report-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:{
            url: "applicant-reports",
            data:{
                date_from:date_from,
                date_to:date_to,
                status:status
            },
           },
           
           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'APC-'+data;
            }
         }],
         order: [[0, 'asc']],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'address', name: 'address'},
            {data: 'gender', name: 'gender'},
            {data: 'status', name: 'status'},
           // {data: 'created_at', name: 'created_at'},
           // {data: 'updated_at', name: 'updated_at'},
           ]

          });

       }
       
      

       $('#date_from').change(function()
       {
           let date_from = $('#date_from').val()
           let date_to = $('#date_to').val();
           let status = $('#status').val()
            console.log(status);
            console.log(date_from);
            console.log(date_to);
           $('#borrowed-report-table').DataTable().destroy();
           fetchBorrowedBooks(date_from, date_to,status);
       });

      $('#date_to').change(function()
      {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        let status = $('#status').val()
        console.log(status);
         console.log(date_from);
         console.log(date_to);
         $('#borrowed-report-table').DataTable().destroy();
         fetchBorrowedBooks(date_from, date_to,status);
      });
      
       $('#status').change(function()
      {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        let status = $('#status').val()
        console.log(status);
         console.log(date_from);
         console.log(date_to);
         $('#borrowed-report-table').DataTable().destroy();
         fetchBorrowedBooks(date_from, date_to,status);
      });

      $('#btn-borrowed-print').click(function () {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        let status = $('#status').val()
        window.open('applicant-reports/print/'+date_from+'/'+date_to+'/'+status, '_blank');
        

      });

});
