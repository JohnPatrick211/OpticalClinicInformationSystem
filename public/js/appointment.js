$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      load_data();
      load_data2();

      function load_data()  {
          let bookappointmentbranch = $('#bookappointmentbranch').val()
          console.log(bookappointmentbranch);
          fetchBookAppointment(bookappointmentbranch);

      }

      function load_data2()  {
        let myappointmentbranch = $('#myappointmentbranch').val()
        console.log(myappointmentbranch);
        fetchMyAppointment(myappointmentbranch);
        fetchMyAppointmentComplete(myappointmentbranch);

    }

      function fetchBookAppointment(bookappointmentbranch){

        $('#datatable-bookappointment').DataTable({
  
            processing: true,
            serverSide: true,
  
            ajax:{
             url: "bookappointment-data",
             data:{
              bookappointmentbranch:bookappointmentbranch,
              },
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
              {data: 'name', name: 'name'},
              {data: 'specialty', name: 'specialty'},
              {data: 'branchname', name: 'branchname'},
              {data: 'doctor_schedule_date', name: 'doctor_schedule_date'},
              {data: 'doctor_schedule_day', name: 'doctor_schedule_day'},
              {data: 'doctor_schedule_start_time', name: 'doctor_schedule_start_time'},
              {data: 'doctor_schedule_end_time', name: 'doctor_schedule_end_time'},
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

        function fetchMyAppointment(myappointmentbranch){

          $('#datatable-myappointment').DataTable({
    
              processing: true,
              serverSide: true,
    
              ajax:{
               url: "myappointment-data",
               data:{
                myappointmentbranch:myappointmentbranch,
                },
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
                {data: 'name', name: 'name'},
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

          function fetchMyAppointmentComplete(myappointmentbranch){

            $('#datatable-myappointmentcompleted').DataTable({
      
                processing: true,
                serverSide: true,
      
                ajax:{
                 url: "myappointmentcomplete-data",
                 data:{
                  myappointmentbranch:myappointmentbranch,
                  },
                },
      
                columns:[
                  {data: 'name', name: 'name'},
                  {data: 'specialty', name: 'specialty'},
                  {data: 'branchname', name: 'branchname'},
                  {data: 'date', name: 'date'},
                  {data: 'day', name: 'day'},
                  {data: 'time', name: 'time'},
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

      $('#bookappointmentbranch').change(function()
      {
          let bookappointmentbranch = $('#bookappointmentbranch').val()
          console.log(bookappointmentbranch);
          $('#datatable-bookappointment').DataTable().destroy();
          fetchBookAppointment(bookappointmentbranch);
      });

      $('#myappointmentbranch').change(function()
      {
          let myappointmentbranch = $('#myappointmentbranch').val()
          console.log(myappointmentbranch);
          $('#datatable-myappointment').DataTable().destroy();
          $('#datatable-myappointmentcompleted').DataTable().destroy();
          fetchMyAppointment(myappointmentbranch);
          fetchMyAppointmentComplete(myappointmentbranch);
      });

      $(document).on('click', '#btn-make-appointment', function(){
        var id = $(this).attr('employer-id');
        var patient_id = $(this).attr('patient-id');
        console.log(id);
        console.log(patient_id);
        fetchUploadInfo(id,patient_id);
      });

      $(document).on('click', '#btn-view-appointment', function(){
        var id = $(this).attr('employer-id');
        var patient_id = $(this).attr('patient-id');
        console.log(id);
        console.log(patient_id);
        fetchViewUploadInfo(id,patient_id);
      });

      $(document).on('click', '#btn-view-appointmentpending', function(){
        var id = $(this).attr('employer-id');
        var patient_id = $(this).attr('patient-id');
        console.log(id);
        console.log(patient_id);
        fetchViewUploadInfoPending(id,patient_id);
      });

      function fetchUploadInfo(id,patient_id){
        $.ajax({
          url:"/appointment/getappointmentinfo/"+ id +"/"+ patient_id,
          type:"GET",

          success:function(data){
            console.log(data);
            //schedule id
            $('#cust-id-hidden').val(data[1][0].id);
            //patient id
            $('#cust-patient-id-hidden').val(data[0][0].id);
            //doctor id
            $('#cust-doctor-id-hidden').val(data[1][0].doctor_id);
            //patient details
            $('#bookpatientname').val(data[0][0].name);
            $('#bookemail').val(data[0][0].email);
            $('#bookcontactno').val(data[0][0].contactno);
            $('#bookage').val(data[0][0].age);
            $('#bookgender').val(data[0][0].gender);
            $('#bookcivilstatus').val(data[0][0].civilstatus);
            $('#bookbirthdate').val(data[0][0].birthdate);
            //appointment details 
            $('#bookdoctorname').val(data[1][0].name);
            $('#bookspecialization').val(data[1][0].specialty);
            $('#bookbranch').val(data[1][0].branchname);
            $('#bookappointmentdate').val(data[1][0].doctor_schedule_date);
            $('#bookappointmentday').val(data[1][0].doctor_schedule_day);
            $('#bookappointmenttime').val(data[1][0].doctor_schedule_start_time + ' - '+ data[1][0].doctor_schedule_end_time);
          }

         });
      }

      function fetchViewUploadInfo(id,patient_id){
        $.ajax({
          url:"/myappointment/getappointmentinfo/"+ id +"/"+ patient_id,
          type:"GET",

          success:function(data){
            console.log(data);
            //schedule id
            $('#viewcust-id-hidden').val(data[1][0].id);
            //patient id
            $('#viewcust-patient-id-hidden').val(data[0][0].id);
            //doctor id
            $('#viewcust-doctor-id-hidden').val(data[1][0].doctor_id);
            //patient details
            $('#viewpatientname').val(data[0][0].name);
            $('#viewemail').val(data[0][0].email);
            $('#viewcontactno').val(data[0][0].contactno);
            $('#viewage').val(data[0][0].age);
            $('#viewgender').val(data[0][0].gender);
            $('#viewcivilstatus').val(data[0][0].civilstatus);
            $('#viewbirthdate').val(data[0][0].birthdate);
            //appointment details 
            $('#viewdoctorname').val(data[1][0].name);
            $('#viewspecialization').val(data[1][0].specialty);
            $('#viewbranch').val(data[1][0].branchname);
            $('#viewappointmentdate').val(data[1][0].date);
            $('#viewappointmentday').val(data[1][0].day);
            $('#viewappointmenttime').val(data[1][0].time);
            $('#viewreasonforappointment').val(data[1][0].reason);
          }

         });
      }

      function fetchViewUploadInfoPending(id,patient_id){
        $.ajax({
          url:"/myappointment/getappointmentinfopending/"+ id +"/"+ patient_id,
          type:"GET",

          success:function(data){
            console.log(data);
            //schedule id
            $('#viewcust-id-hidden').val(data[1][0].id);
            //patient id
            $('#viewcust-patient-id-hidden').val(data[0][0].id);
            //doctor id
            $('#viewcust-doctor-id-hidden').val(data[1][0].doctor_id);
            //patient details
            $('#viewpatientname').val(data[0][0].name);
            $('#viewemail').val(data[0][0].email);
            $('#viewcontactno').val(data[0][0].contactno);
            $('#viewage').val(data[0][0].age);
            $('#viewgender').val(data[0][0].gender);
            $('#viewcivilstatus').val(data[0][0].civilstatus);
            $('#viewbirthdate').val(data[0][0].birthdate);
            //appointment details
            $('#viewdoctorname').val(data[1][0].name);
            $('#viewspecialization').val(data[1][0].specialty);
            $('#viewbranch').val(data[1][0].branchname);
            $('#viewappointmentdate').val(data[1][0].doctor_schedule_date);
            $('#viewappointmentday').val(data[1][0].doctor_schedule_day);
            $('#viewappointmenttime').val(data[1][0].doctor_schedule_start_time + ' - '+ data[1][0].doctor_schedule_end_time);
            $('#viewreasonforappointment').val(data[1][0].reason_for_appointment);
          }

         });
      }

      $(document).on('click', '#btn-add-bookappointment', function(){
        var schedule_id = $('#cust-id-hidden').val();
        var patient_id = $('#cust-patient-id-hidden').val();
        var doctor_id = $('#cust-doctor-id-hidden').val();
        var reason_for_appointment = $('#bookereasonforappointment').val();
        var appointmenttime = $('#bookappointmenttime').val();
        var form = new FormData();
        form.append('schedule_id', schedule_id);
        form.append('patient_id', patient_id);
        form.append('doctor_id', doctor_id);
        form.append('reason_for_appointment', reason_for_appointment);
        form.append('appointmenttime', appointmenttime);
        Book(form);

      });

      function Book(form) {
        $.ajax({
          url:"/appointment/makeappointment/",
          type:"POST",
          data:form,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend:function(){
              $('#btn-add-bookappointment').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              if(data.status == 1)
            {
                console.log(data.status);
                console.log(data.success);
                $('.existproduct-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn-add-bookappointment').text('Book');
              $('#datatable-bookappointment').DataTable().ajax.reload();
              setTimeout(function(){
              $('.existproduct-success').fadeOut('slow');
            },2000);
              
            }
            else
            {
              console.log(data.status);
                console.log(data.success);
                             $('.update-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn-add-bookappointment').text('Book');
              $('#datatable-bookappointment').DataTable().ajax.reload();
              setTimeout(function(){
              $('.update-success-validation').fadeOut('slow');
              $('#MakeAppointmentModal').modal('toggle');

            },2000);
            }
          }

         });
      }

         $(document).on('click', '#btn-cancel-appointment', function(){
        var id = $(this).attr('employer-ids');
        var patient_id = $(this).attr('patient-id');
        console.log(id);
        console.log(patient_id);
          fetchUploadInfofordelete(id,patient_id);
      });

      function fetchUploadInfofordelete(id,patient_id){
        $.ajax({
          url:"/myappointment/getappointmentinfopending/"+ id +"/"+ patient_id,
          type:"GET",

          success:function(data){
            console.log(data);
            //schedule id
            $('#cancelcust-id-hidden').val(data[1][0].I);
            //patient id
            $('#cancelcust-patient-id-hidden').val(data[0][0].id);
            //doctor id
            $('#cancelcust-doctor-id-hidden').val(data[1][0].doctor_id);
          }

         });
      }


      $(document).on('click', '#btn_cancel_appointment', function(){
        var id = $('#cancelcust-id-hidden').val();
        var patient_id = $('#cancelcust-patient-id-hidden').val();
        var doctor_id = $('#cancelcust-doctor-id-hidden').val();
        console.log(id);

       Cancel(id);

      });

      function Cancel(id) {
        $.ajax({
          url:"/myappointment/cancelappointment/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_cancel_appointment').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
            if(data.status == 1)
            {
                console.log(data.status);
                console.log(data.success);
                $('.existcategoryproduct-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_cancel_appointment').text('Yes');
              $('#datatable-myappointment').DataTable().ajax.reload();
              setTimeout(function(){
              $('.existcategoryproduct-success').fadeOut('slow');
            },2000);
              
            }
            else
            {
                console.log(data.status);
                console.log(data.success);
            $('.delete-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_cancel_appointment').text('Yes');
              $('#datatable-myappointment').DataTable().ajax.reload();
              setTimeout(function(){
              $('.delete-success').fadeOut('slow');
              $('#cancelconfirmModal').modal('toggle');

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
