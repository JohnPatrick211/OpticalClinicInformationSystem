
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      load_data();

      function load_data()  {
        $('#appointmentdate_to')[0].valueAsDate = new Date();

      $('#appointmentdate_to').change(function() {
        var date= this.valueAsDate;
        date.setDate(date.getDate() + 7);
        $('#appointmentdate_to')[0].valueAsDate = date;
      });

      $('#appointmentdate_to').change();
        let date_from = $('#appointmentdate_from').val()
        let date_to = $('#appointmentdate_to').val();
        let approvalappointmentbranch = $('#approvalappointmentbranch').val()
        let appointmentapprovaldoctorname = $('#appointmentapprovaldoctorname').val()
        console.log(approvalappointmentbranch);
        fetchApprovalAppointment(date_from,date_to,approvalappointmentbranch,appointmentapprovaldoctorname);
        fetchApprovedAppointment(date_from,date_to,approvalappointmentbranch,appointmentapprovaldoctorname);

      }


      function fetchApprovalAppointment(date_from,date_to,approvalappointmentbranch,appointmentapprovaldoctorname){

      var tbl_for_validation = $('#appointment-approval-table').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "appointment-approval-data",
           data:{
            date_from:date_from,
            date_to:date_to,
            approvalappointmentbranch:approvalappointmentbranch,
            appointmentapprovaldoctorname:appointmentapprovaldoctorname,
            },
          },

          success:function(data){

            console.log(data);
             },

          columnDefs: [
            {
            targets: [6],
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return data+ ' - ' + full.doctor_schedule_end_time;
            }
          },
          {
            visible: false, targets: [7],
          }],
  
            columns:[
              {data: 'N', name: 'N'},
              {data: 'D', name: 'D'},
              {data: 'specialty', name: 'specialty'},
              {data: 'branchname', name: 'branchname'},
              {data: 'doctor_schedule_date', name: 'doctor_schedule_date'},
              {data: 'doctor_schedule_day', name: 'doctor_schedule_day'},
              {data: 'doctor_schedule_start_time', name: 'doctor_schedule_start_time'},
              {data: 'doctor_schedule_end_time', name: 'doctor_schedule_end_time'},
              {data: 'status', name: 'status'},
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

      }

      $('#appointmentdate_from').change(function()
      {
        let date_from = $('#appointmentdate_from').val()
        let date_to = $('#appointmentdate_to').val();
        let approvalappointmentbranch = $('#approvalappointmentbranch').val()
        let appointmentapprovaldoctorname = $('#appointmentapprovaldoctorname').val()
        $('#appointment-approval-table').DataTable().destroy();
        $('#appointment-approved-table').DataTable().destroy();
        console.log(approvalappointmentbranch);
        fetchApprovalAppointment(date_from,date_to,approvalappointmentbranch,appointmentapprovaldoctorname);
        fetchApprovedAppointment(date_from,date_to,approvalappointmentbranch,appointmentapprovaldoctorname);
      });

      $('#appointmentdate_to').change(function()
      {
        let date_from = $('#appointmentdate_from').val()
        let date_to = $('#appointmentdate_to').val();
        let approvalappointmentbranch = $('#approvalappointmentbranch').val()
        let appointmentapprovaldoctorname = $('#appointmentapprovaldoctorname').val()
        $('#appointment-approval-table').DataTable().destroy();
        $('#appointment-approved-table').DataTable().destroy();
        console.log(approvalappointmentbranch);
        fetchApprovalAppointment(date_from,date_to,approvalappointmentbranch,appointmentapprovaldoctorname);
        fetchApprovedAppointment(date_from,date_to,approvalappointmentbranch,appointmentapprovaldoctorname);
      });

      $('#approvalappointmentbranch').change(function()
      {
        let date_from = $('#appointmentdate_from').val()
        let date_to = $('#appointmentdate_to').val();
        let approvalappointmentbranch = $('#approvalappointmentbranch').val()
        let appointmentapprovaldoctorname = $('#appointmentapprovaldoctorname').val()
        $('#appointment-approval-table').DataTable().destroy();
        $('#appointment-approved-table').DataTable().destroy();
        console.log(approvalappointmentbranch);
        fetchApprovalAppointment(date_from,date_to,approvalappointmentbranch,appointmentapprovaldoctorname);
        fetchApprovedAppointment(date_from,date_to,approvalappointmentbranch,appointmentapprovaldoctorname);
      });

      $('#appointmentapprovaldoctorname').change(function()
      {
        let date_from = $('#appointmentdate_from').val()
        let date_to = $('#appointmentdate_to').val();
        let approvalappointmentbranch = $('#approvalappointmentbranch').val()
        let appointmentapprovaldoctorname = $('#appointmentapprovaldoctorname').val()
        $('#appointment-approval-table').DataTable().destroy();
        $('#appointment-approved-table').DataTable().destroy();
        console.log(approvalappointmentbranch);
        fetchApprovalAppointment(date_from,date_to,approvalappointmentbranch,appointmentapprovaldoctorname);
        fetchApprovedAppointment(date_from,date_to,approvalappointmentbranch,appointmentapprovaldoctorname);
      });   

      function fetchApprovedAppointment(date_from,date_to,approvalappointmentbranch,appointmentapprovaldoctorname){
        $('#appointment-approved-table').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "appointment-approved-data",
           data:{
            date_from:date_from,
            date_to:date_to,
            approvalappointmentbranch:approvalappointmentbranch,
            appointmentapprovaldoctorname:appointmentapprovaldoctorname,
            },
          },
          
          columnDefs: [
            {
            targets: [6],
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return data+ ' - ' + full.doctor_schedule_end_time;
            }
          },
          {
            visible: false, targets: [7],
          }],
  
            columns:[
              {data: 'N', name: 'N'},
              {data: 'D', name: 'D'},
              {data: 'specialty', name: 'specialty'},
              {data: 'branchname', name: 'branchname'},
              {data: 'doctor_schedule_date', name: 'doctor_schedule_date'},
              {data: 'doctor_schedule_day', name: 'doctor_schedule_day'},
              {data: 'doctor_schedule_start_time', name: 'doctor_schedule_start_time'},
              {data: 'doctor_schedule_end_time', name: 'doctor_schedule_end_time'},
              {data: 'status', name: 'status'},
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
      }

      $(document).on('click', '#btn-view-appointmentapproval', function(){
        var id = $(this).attr('employer-id');
        var patient_id = $(this).attr('patient-id');
        console.log(id);
        console.log(patient_id);
        fetchUploadInfo(id,patient_id);
      });

      function fetchUploadInfo(id,patient_id){
        $.ajax({
          url:"/verifyappointment/getappointmentinfo/"+ id +"/"+ patient_id,
          type:"GET",

          success:function(data){
                console.log(data);
            isVerified(id,patient_id);
             //schedule id
             $('#viewapprovalcust-id-hidden').val(data[1][0].I);
             //patient id
             $('#viewapprovalcust-patient-id-hidden').val(data[0][0].id);
             //doctor id
             $('#viewapprovalcust-doctor-id-hidden').val(data[1][0].doctor_id);
            //patient details
             $('#viewapprovalpatientname').val(data[0][0].name);
             $('#viewapprovalemail').val(data[0][0].email);
             $('#viewapprovalcontactno').val(data[0][0].contactno);
             $('#viewapprovalage').val(data[0][0].age);
             $('#viewapprovalgender').val(data[0][0].gender);
             $('#viewapprovalcivilstatus').val(data[0][0].civilstatus);
             $('#viewapprovalbirthdate').val(data[0][0].birthdate);
             //appointment details 
             $('#viewapprovaldoctorname').val(data[1][0].name);
             $('#viewapprovalspecialization').val(data[1][0].specialty);
             $('#viewapprovalbranch').val(data[1][0].branchname);
             $('#viewapprovalappointmentdate').val(data[1][0].doctor_schedule_date);
             $('#viewapprovalappointmentday').val(data[1][0].doctor_schedule_day);
             $('#viewapprovalappointmenttime').val(data[1][0].doctor_schedule_start_time + ' - '+ data[1][0].doctor_schedule_end_time);
             $('#viewapprovalreasonforappointment').val(data[1][0].reason_for_appointment);
          }

         });
      }

      function isVerified(id,patient_id){
        $.ajax({
          url:"/verifyappointment/getappointmentinfo/"+ id +"/"+ patient_id,
          type:"GET",

          success:function(data){

           var status = data[1][0].status;
           console.log(status);
              if(status == 'Pending')
              {
                console.log('Pending');
                $("#btn-appointmentapprovalapprove").attr('disabled', false);
                $("#btn-appointmentapprovaldecline").attr('disabled', false);
              }
              else
              {
                $("#btn-appointmentapprovalapprove").attr('disabled', true);
                $("#btn-appointmentapprovaldecline").attr('disabled', true);
              }
            }
         });
      }

      $(document).on('click', '#btn-appointmentapprovalapprove', function() {

        $("#confirmationappointmentapproveModal").modal('show')
        

      });
      
       $(document).on('click', '#btn_confirmpappointmentapprove', function() {
           
            var id = $('#viewapprovalcust-id-hidden').val();
            var patient_id = $('#viewapprovalcust-patient-id-hidden').val();
            console.log(id);
            $("#confirmationappointmentapproveModal").modal('hide')
            approve(id,patient_id);
       });

    function approve(id,patient_id) {
      $.ajax({
        url:"/verifyappointmentapproval/approve/"+ id +"/"+ patient_id,
        type:"POST",
        data:{
          id:id,
          patient_id:patient_id,
        },
        beforeSend:function(){
          $('#btn-appointmentapprovalapprove').text('Please wait...');
          $('.loader').css('display', 'inline');
        },
        success:function(){
          $('#appointment-approval-table').DataTable().ajax.reload();
          $('#appointment-approved-table').DataTable().ajax.reload();
          setTimeout(function(){
            $('.update-success-validation').css('display', 'inline');
            $('#btn-appointmentapprovalapprove').text('Approve');
            $('.loader').css('display', 'none');
            setTimeout(function(){
              $('.update-success-validation').fadeOut('slow');
              $('#ViewAppointmentApprovalModal').modal('toggle');

            },2000);

          },1000);
        }

       });
    }

    $(document).on('click', '#btn-appointmentapprovaldecline', function(){
     
      $("#confirmationappointmentrejectModal").modal('show')
      //reject(id,email);

    });
    
      $(document).on('click', '#btn_confirmappointmentreject', function() {
            var id = $('#viewapprovalcust-id-hidden').val();
            var patient_id = $('#viewapprovalcust-patient-id-hidden').val();
           $("#confirmationappointmentrejectModal").modal('hide')
            reject(id,patient_id);
      });

    function reject(id,patient_id) {
      $.ajax({
        url:"/verifyappointmentapproval/reject/"+ id +"/"+ patient_id,
        type:"POST",
        data:{
            id:id,
            patient_id:patient_id,
          },
        beforeSend:function(){
            $('#btn_confirmappointmentreject').text('Please wait...');
            $('.loader').css('display', 'inline');
          },
        success:function(data){
            $('.reject-validation').css('display', 'inline');
            $('.loader').css('display', 'none');
            $('#btn_confirmappointmentreject').text('Reject');
            $('#appointment-approval-table').DataTable().ajax.reload();
            $('#appointment-approved-table').DataTable().ajax.reload();
            setTimeout(function(){
            $('.reject-validation').fadeOut('slow');
            $('#ViewAppointmentApprovalModal').modal('toggle');

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




