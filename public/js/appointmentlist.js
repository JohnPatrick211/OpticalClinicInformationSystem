








$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      load_data();

      function load_data()  {

        let date_today = $('#appointmentlisttoday').val()
        let appointmentlistbranch = $('#appointmentlistbranch').val()
        let appointmentlistdoctorname = $('#appointmentlistdoctorname').val()
        fetchAppointmentList(date_today,appointmentlistbranch,appointmentlistdoctorname);

      }


      function fetchAppointmentList(date_today,appointmentlistbranch,appointmentlistdoctorname){

      var tbl_for_validation = $('#appointment-list-table').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "appointment-list-data",
           data:{
            date_today:date_today,
            appointmentlistbranch:appointmentlistbranch,
            appointmentlistdoctorname:appointmentlistdoctorname,
            },
          },

          success:function(data){

            console.log(data);
             },

          columnDefs: [
            {
            targets: [5],
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return data+ ' - ' + full.doctor_schedule_end_time;
            }
          },
          {
            visible: false, targets: [6],
          }],
  
            columns:[
              {data: 'N', name: 'N'},
              {data: 'D', name: 'D'},
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

      $('#appointmentlisttoday').change(function()
      {
        let date_today = $('#appointmentlisttoday').val()
        let appointmentlistbranch = $('#appointmentlistbranch').val()
        let appointmentlistdoctorname = $('#appointmentlistdoctorname').val()
        $('#appointment-list-table').DataTable().destroy();
        fetchAppointmentList(date_today,appointmentlistbranch,appointmentlistdoctorname);
      });

      $('#appointmentlistbranch').change(function()
      {
        let date_today = $('#appointmentlisttoday').val()
        let appointmentlistbranch = $('#appointmentlistbranch').val()
        let appointmentlistdoctorname = $('#appointmentlistdoctorname').val()
        $('#appointment-list-table').DataTable().destroy();
        fetchAppointmentList(date_today,appointmentlistbranch,appointmentlistdoctorname);
      });

      $('#appointmentlistdoctorname').change(function()
      {
        let date_today = $('#appointmentlisttoday').val()
        let appointmentlistbranch = $('#appointmentlistbranch').val()
        let appointmentlistdoctorname = $('#appointmentlistdoctorname').val()
        $('#appointment-list-table').DataTable().destroy();
        fetchAppointmentList(date_today,appointmentlistbranch,appointmentlistdoctorname);
      });   

      $(document).on('click', '#btn-view-appointmentprescription', function(){
        var id = $(this).attr('employer-id');
        var patient_id = $(this).attr('patient-id');
        var branch_id = $(this).attr('branch-id');
        console.log(id);
        console.log(patient_id);
        console.log(branch_id);
        fetchUploadInfo(id,patient_id,branch_id);
      });

      function fetchUploadInfo(id,patient_id,branch_id){
        $.ajax({
          url:"/verifyprescription/getprescriptioninfo/"+ id +"/"+ patient_id,
          type:"GET",

          success:function(data){
                console.log(data);
             //schedule id
             $('#appointmentprescriptioncust-id-hidden').val(data[1][0].I);
             //patient id
             $('#appointmentprescriptioncust-patient-id-hidden').val(data[0][0].id);
             //doctor id
             $('#appointmentprescriptioncust-doctor-id-hidden').val(data[1][0].doctor_id);
             //branch id
             $('#appointmentprescriptioncust-branch-id-hidden').val(branch_id);
            //patient details
             $('#appointmentprescriptionpatientname').val(data[0][0].name);
             $('#appointmentprescriptionemail').val(data[0][0].email);
             $('#appointmentprescriptioncontactno').val(data[0][0].contactno);
             $('#appointmentprescriptionage').val(data[0][0].age);
             $('#appointmentprescriptiongender').val(data[0][0].gender);
             $('#appointmentprescriptioncivilstatus').val(data[0][0].civilstatus);
             $('#appointmentprescriptionbirthdate').val(data[0][0].birthdate);
             $('#appointmentprescriptionreasonforappointment').val(data[1][0].reason_for_appointment);
              //appointment details
              $('#appointmentprescriptiondoctorname').val(data[1][0].name);
              $('#appointmentprescriptionbranch').val(data[1][0].branchname);
              $('#appointmentprescriptiondate').val(data[1][0].doctor_schedule_date);
              $('#appointmentprescriptionday').val(data[1][0].doctor_schedule_day);
              $('#appointmentprescriptiontime').val(data[1][0].doctor_schedule_start_time + ' - '+ data[1][0].doctor_schedule_end_time);
          }

         });
      }
      $(document).on('click', '#btn-appointmentprescriptionsave', function() {

        $("#confirmationappointmentprescriptionModal").modal('show')
        

      });
      
       $(document).on('click', '#btn_confirmappointmentprescription', function() {
           
            var id = $('#appointmentprescriptioncust-id-hidden').val();
            var patient_id = $('#appointmentprescriptioncust-patient-id-hidden').val();
            var doctor_id = $('#appointmentprescriptioncust-doctor-id-hidden').val();
            var branch_id = $('#appointmentprescriptioncust-branch-id-hidden').val();
            var prescription = $('#appointmentprescriptiontext').val();
            var branchname = $('#appointmentprescriptionbranch').val();
            var reason = $('#appointmentprescriptionreasonforappointment').val();
            var doctorname = $('#appointmentprescriptiondoctorname').val();
            var date = $('#appointmentprescriptiondate').val();
            var time = $('#appointmentprescriptiontime').val();
            var day = $('#appointmentprescriptionday').val();
            console.log(id);
            $("#confirmationappointmentprescriptionModal").modal('hide')
            SavePrescription(id,patient_id,prescription,doctorname,branch_id,date,time,doctor_id,day,branchname,reason);
       });

    function SavePrescription(id,patient_id,prescription,doctorname,branch_id,date,time,doctor_id,day,branchname,reason) {
      $.ajax({
        url:"/verifyprescription/save/"+ id +"/"+ patient_id+"/"+prescription+"/"+ doctorname+"/"+branch_id+"/"+date+"/"+time+"/"+doctor_id+"/"+day+"/"+branchname+"/"+reason,
        type:"POST",
        data:{
          id:id,
          patient_id:patient_id,
          prescription:prescription,
          doctorname:doctorname,
          branch_id:branch_id,
          date:date,
          time:time,
          doctor_id:doctor_id,
          day:day,
          branchname:branchname,
          reason:reason,
        },
        beforeSend:function(){
          $('#btn-appointmentprescriptionsave').text('Please wait...');
          $('.loader').css('display', 'inline');
        },
        success:function(){
          $('#appointment-list-table').DataTable().ajax.reload();
          setTimeout(function(){
            $('.update-success-validation').css('display', 'inline');
            $('#btn-appointmentprescriptionsave').text('Approve');
            $('.loader').css('display', 'none');
            setTimeout(function(){
              $('.update-success-validation').fadeOut('slow');
              $('#AppointmentPrescriptionModal').modal('toggle');

            },2000);

          },1000);
        }

       });
    }

});




