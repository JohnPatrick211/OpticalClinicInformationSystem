
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      load_data();

      function load_data()  {
        let date_from = $('#appointmentreportdate_from').val()
        let date_to = $('#appointmentreportdate_to').val();
        let appointmentreportbranch = $('#appointmentreportbranch').val()
        let appointmentreportdoctorname = $('#appointmentreportdoctorname').val()
        fetchAppointmentReport(date_from,date_to,appointmentreportbranch,appointmentreportdoctorname);
        console.log(appointmentreportbranch);

      }


      function fetchAppointmentReport(date_from,date_to,appointmentreportbranch,appointmentreportdoctorname){
      var tbl_for_validation = $('#appointment-report-table').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "appointment-report-data",
           data:{
            date_from:date_from,
            date_to:date_to,
            appointmentreportbranch:appointmentreportbranch,
            appointmentreportdoctorname:appointmentreportdoctorname,
            },
          },

          success:function(data){

            console.log(data);
             },

  
            columns:[
              {data: 'U', name: 'U'},
              {data: 'D', name: 'D'},
              {data: 'branchname', name: 'branchname'},
              {data: 'date', name: 'date'},
              {data: 'day', name: 'day'},
              {data: 'time', name: 'time'},
  
              // { data: 'BIR_file', name: 'BIR_file',
              //         render: function( data, type, full, meta ) {
              //             return "<img src=\"/storage/BIR/" + data + "\" height=\"50\"id=\"trigger\"/>";
              //           // return '<div align="center"><a href="/storage/jobposts/" """><img src="{{ asset("siteicons/Info_Box_Blue.png") }}" id="trigger" onclick="ShowSlider(0)"></a></div>';
              //         }
              //     },
            ],
             order: [[1, 'asc']],
          });

      }

      $('#appointmentreportdate_from').change(function()
      {
        let date_from = $('#appointmentreportdate_from').val()
        let date_to = $('#appointmentreportdate_to').val();
        let appointmentreportbranch = $('#appointmentreportbranch').val()
        let appointmentreportdoctorname = $('#appointmentreportdoctorname').val()
        $('#appointment-report-table').DataTable().destroy();
        fetchAppointmentReport(date_from,date_to,appointmentreportbranch,appointmentreportdoctorname);
       
      });

      $('#appointmentreportdate_to').change(function()
      {
        let date_from = $('#appointmentreportdate_from').val()
        let date_to = $('#appointmentreportdate_to').val();
        let appointmentreportbranch = $('#appointmentreportbranch').val()
        let appointmentreportdoctorname = $('#appointmentreportdoctorname').val()
        $('#appointment-report-table').DataTable().destroy();
        fetchAppointmentReport(date_from,date_to,appointmentreportbranch,appointmentreportdoctorname);
      });

      $('#appointmentreportbranch').change(function()
      {
        let date_from = $('#appointmentreportdate_from').val()
        let date_to = $('#appointmentreportdate_to').val();
        let appointmentreportbranch = $('#appointmentreportbranch').val()
        let appointmentreportdoctorname = $('#appointmentreportdoctorname').val()
        $('#appointment-report-table').DataTable().destroy();
        fetchAppointmentReport(date_from,date_to,appointmentreportbranch,appointmentreportdoctorname);
       
      });

      $('#appointmentreportdoctorname').change(function()
      {
        let date_from = $('#appointmentreportdate_from').val()
        let date_to = $('#appointmentreportdate_to').val();
        let appointmentreportbranch = $('#appointmentreportbranch').val()
        let appointmentreportdoctorname = $('#appointmentreportdoctorname').val()
        console.log(appointmentreportdoctorname);
        $('#appointment-report-table').DataTable().destroy();
        fetchAppointmentReport(date_from,date_to,appointmentreportbranch,appointmentreportdoctorname);
      });
      
      $('#btn-appointmentreport-print').click(function () {
        let date_from = $('#appointmentreportdate_from').val()
        let date_to = $('#appointmentreportdate_to').val();
        let appointmentreportbranch = $('#appointmentreportbranch').val()
        let appointmentreportdoctorname = $('#appointmentreportdoctorname').val()
        window.open('appointment-report/print/'+date_from+'/'+date_to+'/'+appointmentreportbranch +'/'+appointmentreportdoctorname, '_blank');

      });

});




