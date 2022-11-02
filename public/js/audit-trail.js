$(document).ready(function()
{

    load_data();

    function load_data()  {
        let date_from = $('#audit-date_from').val()
        let date_to = $('#audit-date_to').val();
        fetchAuditTrail(date_from, date_to);
    }

    function fetchAuditTrail(date_from, date_to){
        $('#audit-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:{
            url: "audit-trail",
            data:{
                date_from:date_from,
                date_to:date_to
            },
           },

           columns:[
            {data: 'name', name: 'name'},
            {data: 'user_type', name: 'user_type'},
            {data: 'module', name: 'module'},
            {data: 'action', name: 'action', orderable:false},
            {data: 'formatteddate', name: 'formatteddate'},
           ],
          order: [[0, 'desc']],

          });

       }

       $('#audit-date_from').change(function()
       {
           let date_from = $('#audit-date_from').val()
           let date_to = $('#audit-date_to').val();
            console.log(date_from);
            console.log(date_to);
           $('#audit-table').DataTable().destroy();
           fetchAuditTrail(date_from, date_to);
       });

      $('#audit-date_to').change(function()
      {
        let date_from = $('#audit-date_from').val()
        let date_to = $('#audit-date_to').val();
         console.log(date_from);
         console.log(date_to);
         $('#audit-table').DataTable().destroy();
         fetchAuditTrail(date_from, date_to);
      });
});
