$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      fetchRegion();

      function fetchRegion(){

      var tbl_for_validation = $('#datatable-employer').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "employer-data",
          },

        columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'EMP-'+data;
            }
         }],
         order: [[0, 'asc']],

          columns:[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'address', name: 'address'},
            // { data: 'BIR_file', name: 'BIR_file',
            //         render: function( data, type, full, meta ) {
            //             return "<img src=\"/storage/BIR/" + data + "\" height=\"50\"id=\"trigger\"/>";
            //           // return '<div align="center"><a href="/storage/jobposts/" """><img src="{{ asset("siteicons/Info_Box_Blue.png") }}" id="trigger" onclick="ShowSlider(0)"></a></div>';
            //         }
            //     },
            {data: 'action', name: 'action', orderable:false}
          ],
          order: [[0, 'asc']],
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


      $(document).on('click', '#btn-edit-employer', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
          fetchUploadInfo(id);
      });

      $(document).on('click', '#btn-delete-employer', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
          fetchUploadInfofordelete(id);
      });

      function fetchUploadInfo(id){
        $.ajax({
          url:"/employer/getemployerinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            console.log(data[0].name);
            $('#cust-id-hidden2').val(data[0].employer_id);
            $('#eeditname').val(data[0].name);
            $('#eeditemail').val(data[0].email);
            $('#eeeditnewpassword').val(data[0].password);
            $('#eeditcontactnumber').val(data[0].contactno);
            $('#eeditcompanyoverview').val(data[0].companyoverview);
            $('#eeditcategory').val(data[0].Specialization);
            //$('#eeditcategory option:selected').val(data[0].Specialization);
            $('#eeditaddress').val(data[0].address);
             var img_source = '../../storage/profiles/'+data[0].profile_pic;
            $('#imagelogo').attr('src', img_source);
              $("#eeditlogo").on("change", function (e) {
                var file = $(this)[0].files[0];
                console.log(file);
            });
            console.log(img_source);
           
          }

         });
      }

      function fetchUploadInfofordelete(id){
        $.ajax({
          url:"/employer/getemployerinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            $('#cust-id-hidden').val(data[0].id);
          }

         });
      }

      $(document).on('click', '#btn-edit-save-employer', function(){
          var id = $('#cust-id-hidden2').val();
        var name = $('#eeditname').val();
        var email = $('#eeditemail').val();
        var newpassword2 = $('#eeeditnewpassword').val();
        var contactnumber = $('#eeditcontactnumber').val();
        var companyoverview = $('#eeditcompanyoverview').val();
        var specialization= $('#eeditcategory').val();
        var address=  $('#eeditaddress').val();
        var file = $("#eeditlogo")[0].files[0];
        var form = new FormData();
        form.append('id', id);
        form.append('name', name);
        form.append('email', email);
        form.append('contactnumber', contactnumber);
        form.append('companyoverview', companyoverview);
        form.append('specialization',specialization);
        form.append('address', address);
        form.append('newpassword2', newpassword2);
        form.append('file', file);
        console.log(form);
         console.log(newpassword2);
        edit(form);

      });

      $(document).on('click', '#btn_employer_delete', function(){
        var id = $('#cust-id-hidden').val();
        var form = new FormData();
        form.append('id', id);
        console.log(id);

       Delete(form);

      });

      function Delete(form) {
        $.ajax({
          url:"deleteemployer",
          type:"POST",
          data:form,
          cache: false,
    contentType: false,
    processData: false,
          beforeSend:function(){
              $('#btn_employer_delete').text('Please wait...');
              $('.loader').css('display', 'inline');
            }, 
          success:function(data){
              if(data.status == 1)
                {
                    console.log(data.status);
                    console.log(data.success);
                      $('.existemployer-success').css('display', 'inline');
                      $('.loader').css('display', 'none');
                      $('#btn_employer_delete').text('Yes');
                      $('#datatable-employer').DataTable().ajax.reload();
                      setTimeout(function(){
                      $('.existemployer-success').fadeOut('slow');
                      },2000);
                     
                }
                else
                {
                    console.log(data.status);
                    console.log(data.success);
                     $('.delete-success').css('display', 'inline');
                      $('.loader').css('display', 'none');
                      $('#btn_employer_delete').text('Yes');
                      $('#datatable-employer').DataTable().ajax.reload();
                      setTimeout(function(){
                      $('.delete-success').fadeOut('slow');
                      $('#employerproconfirmModal').modal('toggle');
                      },2000);
                }
          }

         });
      }

      function edit(form) {
        $.ajax({
          url:"editemployer",
          type:"POST",
          data:form,
          cache: false,
    contentType: false,
    processData: false,
          beforeSend:function(){
              $('#btn-edit-save-region').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
               if(data.status == 1)
                {
                    console.log(data.status);
                    console.log(data.success);
                      $('.existemp-success').css('display', 'inline');
                      $('.loader').css('display', 'none');
                      $('#btn-edit-save-employer').text('Edit');
                      $('#datatable-employer').DataTable().ajax.reload();
                      setTimeout(function(){
                      $('.existemp-success').fadeOut('slow');
                      },2000);
                     
                }
                else
                {
                     $('.empupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn-edit-save-employer').text('Edit');
              $('#datatable-employer').DataTable().ajax.reload();
              setTimeout(function(){
              $('.empupdate-success-validation').fadeOut('slow');
              $('#editEmployerModal').modal('toggle');

            },2000);
                }
          }

         });
      }


});
