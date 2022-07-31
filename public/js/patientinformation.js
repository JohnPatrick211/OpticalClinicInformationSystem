$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

     
      fetchPatientInformation();

      function fetchPatientInformation(){

          $('#datatable-patientinformation').DataTable({
    
              processing: true,
              serverSide: true,
    
              ajax:{
               url: "patientinformation-data",
              },

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
    
          }

      $(document).on('click', '#btn-view-patientinformation', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
        fetchViewUploadInfo(id);
      });

      function fetchViewUploadInfo(id){
        $.ajax({
          url:"/patientinformation/getpatientinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            //schedule id
            // $('#viewcust-id-hidden').val(data[1][0].id);
            // //patient id
            // $('#viewcust-patient-id-hidden').val(data[0][0].id);
            // //doctor id
            // $('#viewcust-doctor-id-hidden').val(data[1][0].doctor_id);
            //patient detailsviewinfopatientid
            $('#viewinfopatientid').val('UID-' + data[0].id);
            $('#viewinfopatientname').val(data[0].name);
            $('#viewinfopatientemail').val(data[0].email);
            $('#viewinfopatientcontactno').val(data[0].contactno);
            $('#viewinfopatientage').val(data[0].age);
            $('#viewinfopatientgender').val(data[0].gender);
            $('#viewinfopatientcivilstatus').val(data[0].civilstatus);
            $('#viewinfopatientbirthdate').val(data[0].birthdate);
            $('#viewinfopatientaddress').val(data[0].address);
            //appointment details
            // $('#viewdoctorname').val(data[1][0].name);
            // $('#viewbranch').val(data[1][0].branchname);
            // $('#viewappointmentdate').val(data[1][0].doctor_schedule_date);
            // $('#viewappointmentday').val(data[1][0].doctor_schedule_day);
            // $('#viewappointmenttime').val(data[1][0].doctor_schedule_start_time + ' - '+ data[1][0].doctor_schedule_end_time);
            // $('#viewreasonforappointment').val(data[1][0].reason_for_appointment);
          }

         });
      }

      $(document).on('click', '#btn-archive-patient', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            $('#id_archive').val(id);
        });

        $(document).on('click', '#btn_archive_patient', function(){
            var id = $('#id_archive').val();
            console.log(id);

           Archive(id);

          });

          function Archive(id) {
            $.ajax({
              url:"usermaintenance/archiveuser/"+ id,
              type:"POST",
              data:{
                  id:id,
                },
                beforeSend:function(){
                    $('#btn_archive_patient').text('Please wait...');
                    $('.loader').css('display', 'inline');
                  },
                success:function(data){
                    $('.dupdate-success-validation').css('display', 'inline');
                    $('.loader').css('display', 'none');
                    $('#btn_archive_patient').text('Yes');
                    $('#datatable-patientinformation').DataTable().ajax.reload();
                    setTimeout(function(){
                    $('.dupdate-success-validation').fadeOut('slow');
                    $('#archivePatientModal').modal('toggle');

                },2000);
              }

             });
          }


});
