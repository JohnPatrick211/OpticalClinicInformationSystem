$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      load_data();

      function load_data()  {
          let mainservicebranch = $('#mainservicebranch').val()
          console.log(mainservicebranch);
          fetchService(mainservicebranch);
          fetchDoctorService(mainservicebranch);
          fetchSecretaryService(mainservicebranch);

      }

      function fetchService(mainservicebranch){

      var tbl_for_validation = $('#datatable-service').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "service-data",
           data:{
            mainservicebranch:mainservicebranch
            },
          },

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

      //    columnDefs: [{
      //     targets: [2,3],
      //     orderable: true,
      //     changeLength: true,
      //     className: 'dt-body-center',
      //     render: function (data, type, full, meta){
      //         return '₱'+data;
      //     }
      //  }],

          columns:[
            {data: 'id', name: 'id'},
            {data: 'servicename', name: 'servicename'},
            {data: 'branchname', name: 'branchname'},
            {data: 'orig_price', name: 'orig_price'},
            {data: 'selling_price', name: 'selling_price'},
            // { data: 'BIR_file', name: 'BIR_file',
            //         render: function( data, type, full, meta ) {
            //             return "<img src=\"/storage/BIR/" + data + "\" height=\"50\"id=\"trigger\"/>";
            //           // return '<div align="center"><a href="/storage/jobposts/" """><img src="{{ asset("siteicons/Info_Box_Blue.png") }}" id="trigger" onclick="ShowSlider(0)"></a></div>';
            //         }
            //     },
            {data: 'action', name: 'action', orderable:false}
          ],
           order: [[1, 'asc']],
        });


   $('#select-all').on('click', function(){
    var rows = tbl_for_validation.rows({ 'search': 'applied' }).nodes();
    $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    $('#for-validation-table tbody').on('change', 'input[type="checkbox"]', function(){
      if(!this.checked){
         var el = $('#select-all').get(0);
         if(el && el.checked && ('indeterminate' in el)){
            el.indeterminate = true;
         }
      }
   });

      }

      function fetchDoctorService(mainservicebranch){

        var tbl_for_validation = $('#datatable-doctor-service').DataTable({
  
            processing: true,
            serverSide: true,
  
            ajax:{
             url: "doctor-service-data",
             data:{
              mainservicebranch:mainservicebranch
              },
            },
  
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
  
        //    columnDefs: [{
        //     targets: [2,3],
        //     orderable: true,
        //     changeLength: true,
        //     className: 'dt-body-center',
        //     render: function (data, type, full, meta){
        //         return '₱'+data;
        //     }
        //  }],
  
            columns:[
              {data: 'id', name: 'id'},
              {data: 'servicename', name: 'servicename'},
              {data: 'branchname', name: 'branchname'},
              {data: 'orig_price', name: 'orig_price'},
              {data: 'selling_price', name: 'selling_price'},
              // { data: 'BIR_file', name: 'BIR_file',
              //         render: function( data, type, full, meta ) {
              //             return "<img src=\"/storage/BIR/" + data + "\" height=\"50\"id=\"trigger\"/>";
              //           // return '<div align="center"><a href="/storage/jobposts/" """><img src="{{ asset("siteicons/Info_Box_Blue.png") }}" id="trigger" onclick="ShowSlider(0)"></a></div>';
              //         }
              //     },
              {data: 'action', name: 'action', orderable:false}
            ],
             order: [[1, 'asc']],
          });
  
  
     $('#select-all').on('click', function(){
      var rows = tbl_for_validation.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
      });
  
      $('#for-validation-table tbody').on('change', 'input[type="checkbox"]', function(){
        if(!this.checked){
           var el = $('#select-all').get(0);
           if(el && el.checked && ('indeterminate' in el)){
              el.indeterminate = true;
           }
        }
     });
  
        }

        function fetchSecretaryService(mainservicebranch){

          var tbl_for_validation = $('#datatable-secretary-service').DataTable({
    
              processing: true,
              serverSide: true,
    
              ajax:{
               url: "secretary-service-data",
               data:{
                mainservicebranch:mainservicebranch
                },
              },
    
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
    
          //    columnDefs: [{
          //     targets: [2,3],
          //     orderable: true,
          //     changeLength: true,
          //     className: 'dt-body-center',
          //     render: function (data, type, full, meta){
          //         return '₱'+data;
          //     }
          //  }],
    
              columns:[
                {data: 'id', name: 'id'},
                {data: 'servicename', name: 'servicename'},
                {data: 'branchname', name: 'branchname'},
                {data: 'orig_price', name: 'orig_price'},
                {data: 'selling_price', name: 'selling_price'},
                // { data: 'BIR_file', name: 'BIR_file',
                //         render: function( data, type, full, meta ) {
                //             return "<img src=\"/storage/BIR/" + data + "\" height=\"50\"id=\"trigger\"/>";
                //           // return '<div align="center"><a href="/storage/jobposts/" """><img src="{{ asset("siteicons/Info_Box_Blue.png") }}" id="trigger" onclick="ShowSlider(0)"></a></div>';
                //         }
                //     },
                {data: 'action', name: 'action', orderable:false}
              ],
               order: [[1, 'asc']],
            });
    
    
       $('#select-all').on('click', function(){
        var rows = tbl_for_validation.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });
    
        $('#for-validation-table tbody').on('change', 'input[type="checkbox"]', function(){
          if(!this.checked){
             var el = $('#select-all').get(0);
             if(el && el.checked && ('indeterminate' in el)){
                el.indeterminate = true;
             }
          }
       });
    
          }

      $('#mainservicebranch').change(function()
      {
          let mainservicebranch = $('#mainservicebranch').val()
          console.log(mainservicebranch);
          $('#datatable-service').DataTable().destroy();
          fetchService(mainservicebranch);
      });


      $(document).on('click', '#btn-edit-service', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
          fetchUploadInfo(id);
      });

      $(document).on('click', '#btn-delete-service', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
          fetchUploadInfofordelete(id);
      });

      function fetchUploadInfo(id){
        $.ajax({
          url:"/service/getserviceinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            $('#cust-id-hidden').val(data[0].id);
            $('#editservicename').val(data[0].servicename);
            $('#editoriginalprice').val(data[0].orig_price);
            $('#editsellingprice').val(data[0].selling_price);
            $('#editmarkup').val(data[0].markup);
          }

         });
      }

      function fetchUploadInfofordelete(id){
        $.ajax({
          url:"/service/getserviceinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            $('#cust-id-hidden').val(data[0].id);
          }

         });
      }

      $(document).on('click', '#btn-edit-save-service', function(){
        var id = $('#cust-id-hidden').val();
        var servicename = $('#editservicename').val();
        var originalprice = $('#editoriginalprice').val();
        var sellingprice = $('#editsellingprice').val();
        var markup = $('#editmarkup').val();
        var branchname = $('#editservicebranch').val();
        console.log(servicename);

       edit(id,servicename,originalprice,sellingprice,markup,branchname);

      });

      $(document).on('click', '#btn_service_delete', function(){
        var id = $('#cust-id-hidden').val();
        console.log(id);

       Delete(id);

      });

      function Delete(id) {
        $.ajax({
          url:"/service/deleteservice/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_service_delete').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
            if(data.status == 1)
            {
                console.log(data.status);
                console.log(data.success);
                $('.existservice-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_service_delete').text('Yes');
              $('#datatable-service').DataTable().ajax.reload();
              $('#datatable-doctor-service').DataTable().ajax.reload();
              $('#datatable-secretary-service').DataTable().ajax.reload();
              setTimeout(function(){
              $('.existservice-success').fadeOut('slow');
            },2000);
              
            }
            else
            {
                console.log(data.status);
                console.log(data.success);
            $('.delete-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_service_delete').text('Yes');
              $('#datatable-service').DataTable().ajax.reload();
              $('#datatable-doctor-service').DataTable().ajax.reload();
              $('#datatable-secretary-service').DataTable().ajax.reload();
              setTimeout(function(){
              $('.delete-success').fadeOut('slow');
              $('#proconfirmModal').modal('toggle');

            },2000);
                
            }
          }

         });
      }

      function edit(id,servicename,originalprice,sellingprice,markup,branchname) {
        $.ajax({
          url:"/service/editservice/"+ id +"/"+ servicename +"/"+ originalprice +"/"+ sellingprice +"/"+ markup +"/"+ branchname,
          type:"POST",
          data:{
              id:id,
              servicename:servicename,
              originalprice:originalprice,
              sellingprice:sellingprice,
              markup:markup,
              branchname:branchname,
            },
          beforeSend:function(){
              $('#btn-edit-save-service').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              if(data.status == 1)
            {
                console.log(data.status);
                console.log(data.success);
                $('.existservice-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn-edit-save-service').text('Edit');
              $('#datatable-service').DataTable().ajax.reload();
              $('#datatable-doctor-service').DataTable().ajax.reload();
              $('#datatable-secretary-service').DataTable().ajax.reload();
              setTimeout(function(){
              $('.existservice-success').fadeOut('slow');
            },2000);
              
            }
            else
            {
              console.log(data.status);
                console.log(data.success);
                             $('.update-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn-edit-save-service').text('Edit');
              $('#datatable-service').DataTable().ajax.reload();
              $('#datatable-doctor-service').DataTable().ajax.reload();
              $('#datatable-secretary-service').DataTable().ajax.reload();
              setTimeout(function(){
              $('.update-success-validation').fadeOut('slow');
              $('#EditServiceModal').modal('toggle');
              $('#DoctorEditServiceModal').modal('toggle');
              $('#SecretaryEditServiceModal').modal('toggle');

            },2000);
            }
          }

         });
      }

      $(document).on('keyup', '#markup', async function() {
        var markup = $(this).val();
        await computeSellingPrice(markup);
      });

      async function computeSellingPrice(markup){

        var orig_price = $('#originalprice').val();
        var markup = orig_price * markup;
        var selling_price = parseFloat(markup) + parseFloat(orig_price);
      
        return $('#sellingprice').val(selling_price);
      }

      $(document).on('keyup', '#editmarkup', async function() {
        var editmarkup = $(this).val();
        await editcomputeSellingPrice(editmarkup);
      });

      async function editcomputeSellingPrice(editmarkup){

        var orig_price = $('#editoriginalprice').val();
        var markup = orig_price * editmarkup;
        var selling_price = parseFloat(markup) + parseFloat(orig_price);
      
        return $('#editsellingprice').val(selling_price);
      }


});
