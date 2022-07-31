$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      fetchRegion();

      function fetchRegion(){

      var tbl_for_validation = $('#datatable-region').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "region-data",
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
            {data: 'region', name: 'region'},
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


      $(document).on('click', '#btn-edit-region', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
          fetchUploadInfo(id);
      });

      $(document).on('click', '#btn-delete-region', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
          fetchUploadInfofordelete(id);
      });

      function fetchUploadInfo(id){
        $.ajax({
          url:"/region/getregioninfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            $('#cust-id-hidden').val(data[0].id);
            $('#editregion').val(data[0].region);
          }

         });
      }

      function fetchUploadInfofordelete(id){
        $.ajax({
          url:"/region/getregioninfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            $('#cust-id-hidden').val(data[0].id);
          }

         });
      }

      $(document).on('click', '#btn-edit-save-region', function(){
        var id = $('#cust-id-hidden').val();
        var region = $('#editregion').val();
        console.log(id);
        console.log(region);

       edit(id,region);

      });

      $(document).on('click', '#btn_region_delete', function(){
        var id = $('#cust-id-hidden').val();
        console.log(id);

       Delete(id);

      });

      function Delete(id) {
        $.ajax({
          url:"/region/deleteregion/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_region_delete').text('Please wait...');
              $('.loader').css('display', 'inline');
            }, 
          success:function(data){
              if(data.status == 1)
                {
                    console.log(data.status);
                    console.log(data.success);
                      $('.existregion-success').css('display', 'inline');
                      $('.loader').css('display', 'none');
                      $('#btn_region_delete').text('Yes');
                      $('#datatable-region').DataTable().ajax.reload();
                      setTimeout(function(){
                      $('.existregion-success').fadeOut('slow');
                      },2000);
                     
                }
                else
                {
                    console.log(data.status);
                    console.log(data.success);
                     $('.delete-success').css('display', 'inline');
                      $('.loader').css('display', 'none');
                      $('#btn_region_delete').text('Yes');
                      $('#datatable-region').DataTable().ajax.reload();
                      setTimeout(function(){
                      $('.delete-success').fadeOut('slow');
                      $('#regionproconfirmModal').modal('toggle');
                      },2000);
                }
          }

         });
      }

      function edit(id,region) {
        $.ajax({
          url:"/region/editregion/"+ id +"/"+ region,
          type:"POST",
          data:{
              id:id,
              region:region
            },
          beforeSend:function(){
              $('#btn-edit-save-region').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
               if(data.status == 1)
                {
                    console.log(data.status);
                    console.log(data.success);
                      $('.existregion-success').css('display', 'inline');
                      $('.loader').css('display', 'none');
                      $('#btn-edit-save-region').text('Edit');
                      $('#datatable-region').DataTable().ajax.reload();
                      setTimeout(function(){
                      $('.existregion-success').fadeOut('slow');
                      },2000);
                     
                }
                else
                {
                     $('.update-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn-edit-save-region').text('Edit');
              $('#datatable-region').DataTable().ajax.reload();
              setTimeout(function(){
              $('.update-success-validation').fadeOut('slow');
              $('#EditRegionModal').modal('toggle');

            },2000);
                }
          }

         });
      }


});
