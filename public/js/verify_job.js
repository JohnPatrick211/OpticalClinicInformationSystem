
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      fetchForValidation();

      function fetchForValidation(){

      var tbl_for_validation = $('#job-approval-table').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "job-approval-data",
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
            {data: 'jobtitle', name: 'jobtitle'},
            {data: 'companyname', name: 'companyname'},
            {data: 'email', name: 'email'},
            {data: 'address', name: 'address'},
            {data: 'created_at', name: 'created_at'},
            // { data: 'BIR_file', name: 'BIR_file',
            //         render: function( data, type, full, meta ) {
            //             return "<img src=\"/storage/BIR/" + data + "\" height=\"50\"id=\"trigger\"/>";
            //           // return '<div align="center"><a href="/storage/jobposts/" """><img src="{{ asset("siteicons/Info_Box_Blue.png") }}" id="trigger" onclick="ShowSlider(0)"></a></div>';
            //         }
            //     },
            {data: 'jobstatus', name: 'jobstatus'},
            {data: 'action', name: 'action', orderable:false}
          ]
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

      fetchVerified();

      function fetchVerified(){
        $('#job-approved-table').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "job-approval-data-approved",
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
            {data: 'jobtitle', name: 'jobtitle'},
            {data: 'companyname', name: 'companyname'},
            {data: 'email', name: 'email'},
            {data: 'address', name: 'address'},
            {data: 'created_at', name: 'created_at'},
            // { data: 'BIR_file', name: 'BIR_file',
            //         render: function( data, type, full, meta ) {
            //             return "<img src=\"/storage/BIR/" + data + "\" height=\"50\"id=\"trigger\"/>";
            //           // return '<div align="center"><a href="/storage/jobposts/" """><img src="{{ asset("siteicons/Info_Box_Blue.png") }}" id="trigger" onclick="ShowSlider(0)"></a></div>';
            //         }
            //     },
            {data: 'jobstatus', name: 'jobstatus'},
            {data: 'action', name: 'action', orderable:false}
          ]
        });

      }

      $(document).on('click', '#btn-job-view-upload', function(){
        var id = $(this).attr('employer-id');
          fetchUploadInfo(id);
      });

      function fetchUploadInfo(id){
        $.ajax({
          url:"/verifyemployer/getJobverificationinfo/"+ id,
          type:"GET",

          success:function(data){
                console.log(data);
            isVerified(id);
            $('#cust-id-hidden').val(data[0].id);
            $('#jobtitle').text(data[0].jobtitle);
            $('#name').text(data[0].companyname);
            $('#email').text(data[0].email);
            $('#status').text(data[0].jobstatus);
            $('#region').text(data[0].location);
            $('#address').text(data[0].address);
            $('#specialization').text(data[0].category);
            $('#salary').text(data[0].salary);
            $('#jobdescription').text(data[0].jobdescription);
            $('#companyoverview').text(data[0].companyoverview);
            $('#JobLogo-hidden').text(data[0].logo);
            if(data[0].BIR_file !== null){
              var img_source = '../../storage/profiles/'+data[0].logo;
            }
            else{
              var img_source = '../../storage/profiles/banner2.jpg';
            }
              $('#image').attr('src', img_source);
              console.log(img_source);
          }

         });
      }

      function isVerified(id){
        $.ajax({
          url:"/verifyemployer/getJobverificationinfo/"+ id,
          type:"GET",

          success:function(data){

           var status = data[0].jobstatus;
              if(status == 'Pending')
              {
                console.log('Pending');
                $("#btn-jobapprove").attr('disabled', false);
                $("#btn-jobdecline").attr('disabled', false);
              }
              else
              {
                $("#btn-jobapprove").attr('disabled', true);
                $("#btn-jobdecline").attr('disabled', true);
              }
            }
         });
      }

      $(document).on('click', '#btn-jobapprove', function() {

        
        $("#confirmationjobapproveModal").modal('show') // or .modal("show");
        // approve(id,email,joblogo,name,companyoverview,jobdescription, address, region, specialization, salary,jobtitle);

      });
      
      $(document).on('click', '#btn_confirmjobapprove', function() {
            var id = $('#cust-id-hidden').val();

            var name = $('#name').text();
            var jobtitle = $('#jobtitle').text();
            var email = $('#email').text();
            var companyoverview = $('#companyoverview').text();
            var jobdescription = $('#jobdescription').text();
            var address = $('#address').text();
            var region = $('#region').text();
            var salary = $('#salary').text();
            var specialization = $('#specialization').text();
            var joblogo = $('#JobLogo-hidden').text();
            console.log(joblogo);
           $("#confirmationjobapproveModal").modal('hide')
            approve(id,email,joblogo,name,companyoverview,jobdescription, address, region, specialization, salary,jobtitle);
      });

    function approve(id,email,joblogo,name,companyoverview,jobdescription, address, region, specialization, salary,jobtitle) {
      $.ajax({
        url:"/verifyemployer/jobapprove/"+ id,
        type:"POST",
        data:{
          id:id,
          email:email,
          joblogo:joblogo,
          name:name,
          companyoverview:companyoverview,
          jobdescription:jobdescription,
          region:region,
          specialization:specialization,
          salary:salary,
          jobtitle:jobtitle,
          address:address
        },
        beforeSend:function(){
          $('#btn-jobapprove').text('Please wait...');
          $('.loader').css('display', 'inline');
        },
        success:function(){
          $('#job-approval-table').DataTable().ajax.reload();
          $('#job-approved-table').DataTable().ajax.reload();
          setTimeout(function(){
            $('.update-success-validation').css('display', 'inline');
            $('#btn-jobapprove').text('Approve');
            $('.loader').css('display', 'none');
            setTimeout(function(){
              $('.update-success-validation').fadeOut('slow');
              $('#jobapprovalModal').modal('toggle');

            },2000);

          },1000);
        }

       });
    }

    $(document).on('click', '#btn-jobdecline', function(){
      
         $("#confirmationjobrejectModal").modal('show')
      //reject(id,email);

    });
    
    $(document).on('click', '#btn_confirmjobreject', function() {
            var id = $('#cust-id-hidden').val();
            var email = $('#email').text();
           $("#confirmationjobrejectModal").modal('hide')
            reject(id,email);
      });

    function reject(id,email) {
      $.ajax({
        url:"/verifyemployer/jobreject/"+ id,
        type:"POST",
        data:{
            id:id,
            email:email
          },
        beforeSend:function(){
            $('#btn-jobdecline').text('Please wait...');
            $('.loader').css('display', 'inline');
          },
        success:function(data){
            $('.reject-validation').css('display', 'inline');
            $('.loader').css('display', 'none');
            $('#btn-jobdecline').text('Reject');
            $('#job-approval-table').DataTable().ajax.reload();
            setTimeout(function(){
            $('.reject-validation').fadeOut('slow');
            $('#jobapprovalModal').modal('toggle');

          },2000);
        }

       });
    }

    function countForValidation() {
      $.ajax({
        url:"/verifycustomer/countforvalidation/",
        type:"GET",

        success:function(data){
          return data;
        }

       });
    }


    $('#btn-bulk-verified').click(function(){

        var user_ids = [];

        $(':checkbox:checked').each(function(i){
          user_ids[i] = $(this).val();
        });

        if(user_ids.length > 0){

            if($('#select-all').is(":checked")){
              //used slice method to start index at 1, so the value of sellect_all checkbox is not included in array
              user_ids = user_ids.slice(1).join(", ");
              console.log(user_ids);
            }
            else{
              user_ids = user_ids.join(", ");
              console.log(user_ids);
            }

            $.ajax({
              url:"/verifycustomer/bulkverified/"+user_ids,
              type:"POST",
              beforeSend:function(){
                $('.loader').css('display', 'inline');
              },
              success:function(){

                setTimeout(function(){
                  $('#for-validation-table').DataTable().ajax.reload();
                  $('#verified-table').DataTable().ajax.reload();
                  $('.loader').css('display', 'none');
                  },1000);

              }
            });
        }
        else{
            alert('Please select a customer!')

        }




    });

});




