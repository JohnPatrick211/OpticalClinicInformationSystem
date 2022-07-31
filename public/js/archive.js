$(document).ready(function()
{

    fetchPatient();
    fetchProduct();
    fetchService();
    fetchDoctor();
    fetchSecretary();
    fetchStaff();


    function fetchPatient(){
        $('#archivepatient-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"archive",

           columnDefs: [
            {
             targets: 0,
             searchable: false,
             orderable: true,
             changeLength: true,
             className: 'dt-body-center',
             render: function (data, type, full, meta){
                 return 'UID-'+data;
             }
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

       $(document).on('click', '#btn-retrieve-patient', function()
       {
           let id = $(this).attr('employer-id');
           $('#id_retrieve').val(id);
           console.log(id);
       });

       $(document).on('click', '#btn_retrieve_patient', function(){
        var id = $('#id_retrieve').val();
        console.log(id);

       Retrieve(id);

      });

      function Retrieve(id) {
        $.ajax({
          url:"archivepatient/retrieve/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_retrieve_patient').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              $('.archiveupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_retrieve_patient').text('Yes');
              $('#archivepatient-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.archiveupdate-success-validation').fadeOut('slow');
              $('#retrievePatientModal').modal('toggle');

            },2000);
          }

         });
      }
      //Archive Product
      function fetchProduct(){
        $('#archiveproduct-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"productarchive",

           columnDefs: [
            {
             targets: 0,
             searchable: false,
             orderable: true,
             changeLength: true,
             className: 'dt-body-center',
             render: function (data, type, full, meta){
                 return 'UID-'+data;
             }
           }],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'productname', name: 'productname'},
            {data: 'branchname', name: 'branchname'},
            {data: 'qty', name: 'qty'},
            {data: 'reorder', name: 'reorder'},
            {data: 'name', name: 'name'},
            {data: 'orig_price', name: 'orig_price'},
            {data: 'selling_price', name: 'selling_price'},
            {data: 'markup', name: 'markup'},
            {data: 'action', name: 'action', orderable:false}
           ],
           order: [[4, 'desc']],

          });

       }

       $(document).on('click', '#btn-retrieve-product', function()
       {
           let id = $(this).attr('employer-id');
           $('#id_retrieve').val(id);
           console.log(id);
       });

       $(document).on('click', '#btn_retrieve_product', function(){
        var id = $('#id_retrieve').val();
        console.log(id);

       RetrieveProduct(id);

      });

      function RetrieveProduct(id) {
        $.ajax({
          url:"archiveproduct/retrieve/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_retrieve_product').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              $('.archiveupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_retrieve_product').text('Yes');
              $('#archiveproduct-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.archiveupdate-success-validation').fadeOut('slow');
              $('#retrieveProductModal').modal('toggle');

            },2000);
          }

         });
      }
      //Archive Service
      function fetchService(){
        $('#archiveservice-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"servicearchive",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'S-'+data;
            }
         },
         {
          targets: [3,4],
          orderable: true,
          changeLength: true,
          className: 'dt-body-center',
          render: function (data, type, full, meta){
              return '₱'+data;
          }
       }],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'servicename', name: 'servicename'},
            {data: 'branchname', name: 'branchname'},
            {data: 'orig_price', name: 'orig_price'},
            {data: 'selling_price', name: 'selling_price'},
            {data: 'action', name: 'action', orderable:false}
           ],
           order: [[4, 'desc']],

          });

       }

       $(document).on('click', '#btn-retrieve-service', function()
       {
           let id = $(this).attr('employer-id');
           $('#id_retrieve').val(id);
           console.log(id);
       });

       $(document).on('click', '#btn_retrieve_service', function(){
        var id = $('#id_retrieve').val();
        console.log(id);

       RetrieveService(id);

      });

      function RetrieveService(id) {
        $.ajax({
          url:"archiveservice/retrieve/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_retrieve_service').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              $('.archiveupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_retrieve_service').text('Yes');
              $('#archiveservice-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.archiveupdate-success-validation').fadeOut('slow');
              $('#retrieveServiceModal').modal('toggle');

            },2000);
          }

         });
      }
      //Archive Doctor
      function fetchDoctor(){
        $('#archivedoctor-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"doctorarchive",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'DOC-'+data;
            }
         }],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'specialty', name: 'specialty'},
            {data: 'branchname', name: 'branchname'},
            {data: 'email', name: 'email'},
            {data: 'contactno', name: 'contactno'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }

       $(document).on('click', '#btn-retrieve-doctor', function()
       {
           let id = $(this).attr('employer-id');
           $('#id_retrieve').val(id);
           console.log(id);
       });

       $(document).on('click', '#btn_retrieve_doctor', function(){
        var id = $('#id_retrieve').val();
        console.log(id);

       RetrieveDoctor(id);

      });

      function RetrieveDoctor(id) {
        $.ajax({
          url:"archivedoctor/retrieve/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_retrieve_doctor').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              $('.archiveupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_retrieve_doctor').text('Yes');
              $('#archivedoctor-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.archiveupdate-success-validation').fadeOut('slow');
              $('#retrieveDoctorModal').modal('toggle');

            },2000);
          }

         });
      }
      //Archive Secretary
      function fetchSecretary(){
        $('#archivesecretary-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"secretaryarchive",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'SEC-'+data;
            }
         }],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'branchname', name: 'branchname'},
            {data: 'email', name: 'email'},
            {data: 'contactno', name: 'contactno'},
            {data: 'action', name: 'action', orderable:false}
           ]
          });

       }

       $(document).on('click', '#btn-retrieve-secretary', function()
       {
           let id = $(this).attr('employer-id');
           $('#id_retrieve').val(id);
           console.log(id);
       });

       $(document).on('click', '#btn_retrieve_secretary', function(){
        var id = $('#id_retrieve').val();
        console.log(id);

       RetrieveSecretary(id);

      });

      function RetrieveSecretary(id) {
        $.ajax({
          url:"archivesecretary/retrieve/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_retrieve_secretary').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              $('.archiveupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_retrieve_secretary').text('Yes');
              $('#archivesecretary-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.archiveupdate-success-validation').fadeOut('slow');
              $('#retrieveSecretaryModal').modal('toggle');

            },2000);
          }

         });
      }
      //Archive Staff
      function fetchStaff(){
        $('#archivestaff-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"staffarchive",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'STAFF-'+data;
            }
         }],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'branchname', name: 'branchname'},
            {data: 'email', name: 'email'},
            {data: 'contactno', name: 'contactno'},
            {data: 'action', name: 'action', orderable:false}
           ]
          });

       }

       $(document).on('click', '#btn-retrieve-staff', function()
       {
           let id = $(this).attr('employer-id');
           $('#id_retrieve').val(id);
           console.log(id);
       });

       $(document).on('click', '#btn_retrieve_staff', function(){
        var id = $('#id_retrieve').val();
        console.log(id);

       RetrieveStaff(id);

      });

      function RetrieveStaff(id) {
        $.ajax({
          url:"archivestaff/retrieve/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_retrieve_staff').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              $('.archiveupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_retrieve_staff').text('Yes');
              $('#archivestaff-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.archiveupdate-success-validation').fadeOut('slow');
              $('#retrieveStaffModal').modal('toggle');

            },2000);
          }

         });
      }
});
