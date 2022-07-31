$(document).ready(function()
{

    fetchUsers();

    function fetchUsers(){
        $('#employer-archive-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"employerarchive",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: false,
            visible:false,
            className: 'dt-body-center',
            // render: function (data, type, full, meta){
            //     return '<input type="checkbox" name="checkbox[]" value="' + $('<div/>').text(data).html() + '">';
            // }
         }],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'contactno', name: 'contactno'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable:false}
           ],
           order: [[4, 'desc']],

          });

       }

       $(document).on('click', '#btn-employerretrieve-user', function()
       {
           let id = $(this).attr('employer-id');
           $('#id_retrieve').val(id);
           console.log(id);
       });

       $(document).on('click', '#btn_employerretrieve', function(){
        var id = $('#id_retrieve').val();
        console.log(id);

       Retrieve(id);

      });

      function Retrieve(id) {
        $.ajax({
          url:"employerarchive/retrieve/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_retrieve').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              $('.archiveupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_employerretrieve').text('Yes');
              $('#employer-archive-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.archiveupdate-success-validation').fadeOut('slow');
              $('#retrieveEmployerModal').modal('toggle');

            },2000);
          }

         });
      }
});
