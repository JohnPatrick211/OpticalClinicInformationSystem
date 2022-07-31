$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      fetchBranch();

      function fetchBranch(){

      var tbl_for_validation = $('#datatable-branch').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "branch-data",
          },

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
            {data: 'branchname', name: 'branchname'},
            {data: 'address', name: 'address'},
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


      $(document).on('click', '#btn-edit-category', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
          fetchUploadInfo(id);
      });

      $(document).on('click', '#btn-delete-category', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
          fetchUploadInfofordelete(id);
      });

      function fetchUploadInfo(id){
        $.ajax({
          url:"/branch/getbranchinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            $('#cust-id-hidden').val(data[0].id);
            $('#editbranchname').val(data[0].branchname);
            $('#editaddress').val(data[0].address);
          }

         });
      }

      function fetchUploadInfofordelete(id){
        $.ajax({
          url:"/branch/getbranchinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            $('#cust-id-hidden').val(data[0].id);
          }

         });
      }

      $(document).on('click', '#btn-edit-save-category', function(){
        var id = $('#cust-id-hidden').val();
        var branchname = $('#editbranchname').val();
        var address = $('#editaddress').val();
        console.log(branchname);

       edit(id,branchname,address);

      });

      $(document).on('click', '#btn_category_delete', function(){
        var id = $('#cust-id-hidden').val();
        console.log(id);

       Delete(id);

      });

      function Delete(id) {
        $.ajax({
          url:"/branch/deletebranch/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_category_delete').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
            if(data.status == 1)
            {
                console.log(data.status);
                console.log(data.success);
                $('.existcategory-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_category_delete').text('Yes');
              $('#datatable-branch').DataTable().ajax.reload();
              setTimeout(function(){
              $('.existcategory-success').fadeOut('slow');
            },2000);
              
            }
            else
            {
                console.log(data.status);
                console.log(data.success);
            $('.delete-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_category_delete').text('Yes');
              $('#datatable-branch').DataTable().ajax.reload();
              setTimeout(function(){
              $('.delete-success').fadeOut('slow');
              $('#proconfirmModal').modal('toggle');

            },2000);
                
            }
          }

         });
      }

      function edit(id,branchname,address) {
        $.ajax({
          url:"/branch/editbranch/"+ id +"/"+ branchname +"/"+ address,
          type:"POST",
          data:{
              id:id,
              branchname:branchname,
              address:address,
            },
          beforeSend:function(){
              $('#btn-edit-save-category').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              if(data.status == 1)
            {
                console.log(data.status);
                console.log(data.success);
                $('.existcategory-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn-edit-save-category').text('Edit');
              $('#datatable-branch').DataTable().ajax.reload();
              setTimeout(function(){
              $('.existcategory-success').fadeOut('slow');
            },2000);
              
            }
            else
            {
              console.log(data.status);
                console.log(data.success);
                             $('.update-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn-edit-save-category').text('Edit');
              $('#datatable-branch').DataTable().ajax.reload();
              setTimeout(function(){
              $('.update-success-validation').fadeOut('slow');
              $('#EditCategoryModal').modal('toggle');

            },2000);
            }
          }

         });
      }


});
