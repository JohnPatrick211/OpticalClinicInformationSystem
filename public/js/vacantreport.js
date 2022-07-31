$(document).ready(function()
{

    load_data();

    function load_data()  {
        let date_from = $('#vacantdate_from').val()
        let date_to = $('#vacantdate_to').val();
        fetchVacantReport(date_from, date_to);
    }

    function fetchVacantReport(date_from, date_to,region){
        console.log(date_from+' asfd');
        console.log(date_to+' dsada');
        $('#vacant-reports-table').DataTable({

           processing: true,
           serverSide: true,
           
         

           ajax:{
            url: "vacant-reports",
            data:{
                date_from:date_from,
                date_to:date_to,
                region:region
            },
           },
           
            columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'JV-'+data;
            }
         }],
         order: [[0, 'asc']],
           
           columns:[
            {data: 'id', name: 'id'},
            {data: 'companyname', name: 'companyname'},
            {data: 'jobtitle', name: 'jobtitle'},
            {data: 'location', name: 'location'},
            {data: 'address', name: 'address'},

           // {data: 'created_at', name: 'created_at'},
           // {data: 'updated_at', name: 'updated_at'},
           ]

          });

       }

       $('#vacantdate_from').change(function()
       {
           let date_from = $('#vacantdate_from').val()
           let date_to = $('#vacantdate_to').val();
             let region = $('#filterregion').val()
            console.log(date_from);
            console.log(date_to);
           $('#vacant-reports-table').DataTable().destroy();
           fetchVacantReport(date_from, date_to, region);
       });

      $('#vacantdate_to').change(function()
      {
        let date_from = $('#vacantdate_from').val()
        let date_to = $('#vacantdate_to').val();
         let region = $('#filterregion').val()
         console.log(date_from);
         console.log(date_to);
         $('#vacant-reports-table').DataTable().destroy();
         fetchVacantReport(date_from, date_to, region);
      });
      
       $('#filterregion').change(function()
      {
        let date_from = $('#vacantdate_from').val()
        let date_to = $('#vacantdate_to').val();
         let region = $('#filterregion').val()
         console.log(date_from);
         console.log(date_to);
         $('#vacant-reports-table').DataTable().destroy();
         fetchVacantReport(date_from, date_to, region);
      });

      $('#btn-vacant-print').click(function () {
        let date_from = $('#vacantdate_from').val()
        let date_to = $('#vacantdate_to').val();
        let region = $('#filterregion').val()
        window.open('vacant-reports/print/'+date_from+'/'+date_to+'/'+region, '_blank');

      });

});
