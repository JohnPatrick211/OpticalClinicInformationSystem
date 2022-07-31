$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      fetchSchedule();

      load_data();

      function load_data()  {
        let schedulebranch = $('#schedulebranch').val()
        console.log(schedulebranch);
        fetchDoctorName(schedulebranch);

      }
      

      function fetchSchedule(){

      var tbl_for_validation = $('#datatable-adminschedule').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "schedule-data",
          },


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

      $('#schedulebranch').change(function()
      {
          let schedulebranch = $('#schedulebranch').val()
          console.log(schedulebranch);
          fetchDoctorName(schedulebranch);
      });

      $('#editschedulebranch').change(function()
      {
        let editschedulebranch = $('#editschedulebranch').val()
        console.log(editschedulebranch);
        fetchDoctorName(editschedulebranch);
      });

    var date = new Date();
    date.setDate(date.getDate());

    $('#doctor_schedule_date').datepicker({
      startDate: date,
      dateFormat: "yy-mm-dd",
      autoclose: true,
      minDate: 0
  });

    $('#editdoctor_schedule_date').datepicker({
      startDate: date,
      dateFormat: "yy-mm-dd",
      autoclose: true,
      minDate: 0
  });

      function fetchDoctorName(schedulebranch){
        console.log("OK");
        $.ajax({
          url:"/schedule/getdoctorname/"+ schedulebranch,
          type:"GET",

          success:function(data){
            console.log(data);
            var len = data.length;

            $("#scheduledoctorname").empty();
            $("#editscheduledoctorname").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]['id'];
                var name = data[i]['name'];
                
                $("#scheduledoctorname").append("<option value='"+id+"'>"+name+"</option>");

            }

            for( var i = 0; i<len; i++){
              var id = data[i]['id'];
              var name = data[i]['name'];
              
              $("#editscheduledoctorname").append("<option value='"+id+"'>"+name+"</option>");

          }
          }

         });
      }

      function fetchDoctorName2(schedulebranch,doctor){
        console.log("OK");
        $.ajax({
          url:"/schedule/getdoctorname/"+ schedulebranch,
          type:"GET",

          success:function(data){
            console.log(data);
            var len = data.length;

            $("#editscheduledoctorname").empty();

            for( var i = 0; i<len; i++){
              var id = data[i]['id'];
              var name = data[i]['name'];
              
              $("#editscheduledoctorname").append("<option value='"+id+"'>"+name+"</option>");
              var selectdoctor = document.getElementById('editscheduledoctorname');
              $(selectdoctor).val(doctor);
              

          }
          }

         });
      }


      $(document).on('click', '#btn-edit-schedule', function(){
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
          url:"/schedule/getdoctorinfo/"+ id,
          type:"GET",

          success:function(data){
            fetchDoctorName2(data[0].branch_id,data[0].doctor_id);
            console.log(data);
            var selectbranch = document.getElementById('editschedulebranch');
            var selectstatus = document.getElementById('editstatus');
            $('#cust-id-hidden').val(data[0].id);
            $(selectbranch).val(data[0].branch_id);
            $(selectstatus).val(data[0].status);
            $('#editoriginalprice').val(data[0].orig_price);doctor_schedule_start_time
            $('#editdoctor_schedule_date').val(data[0].doctor_schedule_date);
            $('#editdoctor_schedule_start_time').val(data[0].doctor_schedule_start_time);
            $('#editdoctor_schedule_end_time').val(data[0].doctor_schedule_end_time);
          }

         });
      }

      function fetchUploadInfofordelete(id){
        $.ajax({
          url:"/schedule/getdoctorinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            $('#cust-id-hidden').val(data[0].id);
          }

         });
      }

      $(document).on('click', '#btn-edit-save-schedule', function(){
        var id = $('#cust-id-hidden').val();
        var branchname = $('#editschedulebranch').val();
        var doctorname = $('#editscheduledoctorname').val();
        var date = $('#editdoctor_schedule_date').val();
        var doctor_schedule_start_time = $('#editdoctor_schedule_start_time').val();
        var doctor_schedule_end_time = $('#editdoctor_schedule_end_time').val();
        var status = $('#editstatus').val();

       edit(id,doctorname,date,doctor_schedule_end_time,doctor_schedule_start_time,branchname,status);

      });

      $(document).on('click', '#btn_service_delete', function(){
        var id = $('#cust-id-hidden').val();
        console.log(id);

       Delete(id);

      });

      function Delete(id) {
        $.ajax({
          url:"/schedule/deleteschedule/"+ id,
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
              $('#datatable-adminschedule').DataTable().ajax.reload();
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
              $('#datatable-adminschedule').DataTable().ajax.reload();
              setTimeout(function(){
              $('.delete-success').fadeOut('slow');
              $('#scheduleproconfirmModal').modal('toggle');

            },2000);
                
            }
          }

         });
      }

      function edit(id,doctorname,date,doctor_schedule_end_time,doctor_schedule_start_time,branchname,status) {
        $.ajax({
          url:"/schedule/editschedule/"+ id +"/"+ doctorname +"/"+ date +"/"+ doctor_schedule_end_time +"/"+ doctor_schedule_start_time +"/"+ branchname +"/"+ status,
          type:"POST",
          data:{
              id:id,
              doctorname:doctorname,
              date:date,
              doctor_schedule_end_time:doctor_schedule_end_time,
              doctor_schedule_start_time:doctor_schedule_start_time,
              branchname:branchname,
              status:status,
            },
          beforeSend:function(){
              $('#btn-edit-save-schedule').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              if(data.status == 1)
            {
                console.log(data.status);
                console.log(data.success);
                $('.existservice-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn-edit-save-schedule').text('Edit');
              $('#datatable-adminschedule').DataTable().ajax.reload();
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
              $('#btn-edit-save-schedule').text('Edit');
              $('#datatable-adminschedule').DataTable().ajax.reload();
              setTimeout(function(){
              $('.update-success-validation').fadeOut('slow');
              $('#EditScheduleModal').modal('toggle');

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
