$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      load_data();

      function load_data()  {
        let certificationreportbranch = $('#certificationreportbranch').val()
        let schedulebranch = $('#certificationbranch').val()
        let certificationreportdoctorname = $('#certificationreportdoctorname').val()
        fetchDoctorName(schedulebranch);
        fetchcertificationReport(certificationreportbranch,certificationreportdoctorname);
        console.log(certificationreportbranch);

      }
      

      function fetchcertificationReport(certificationreportbranch,certificationreportdoctorname){

      var tbl_for_validation = $('#datatable-certification').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "certification-data",
           data:{
            certificationreportbranch:certificationreportbranch,
            certificationreportdoctorname:certificationreportdoctorname,
            },
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
            {data: 'U', name: 'U'},
            {data: 'D', name: 'D'},
            {data: 'branchname', name: 'branchname'},
            {data: 'date', name: 'date'},
            {data: 'action', name: 'action', orderable:false}
          ],
           order: [[1, 'asc']],
        });

      }



      $('#certificationreportbranch').change(function()
      {
        let certificationreportbranch = $('#certificationreportbranch').val()
        let certificationreportdoctorname = $('#certificationreportdoctorname').val()
        $('#datatable-certification').DataTable().destroy();
        fetchcertificationReport(certificationreportbranch,certificationreportdoctorname);
       
      });

      $('#certificationreportdoctorname').change(function()
      {
        let certificationreportbranch = $('#certificationreportbranch').val()
        let certificationreportdoctorname = $('#certificationreportdoctorname').val()
        $('#datatable-certification').DataTable().destroy();
        fetchcertificationReport(certificationreportbranch,certificationreportdoctorname);
      });

  $(document).on('click', '.cbtn-search-userid', function(){
    searchUser ();
  });

  $(document).on('click', '#btn-add-certificate', function(){
    var patientid = $('#cinput-search-userid').val();
    var branchname = $('#certificationbranch').val();
    var doctorname = $('#certificationdoctorname').val();
    var impressions = $('#certificationimpression').val();
    var diagnosis = $('#certificationdiagnosis').val();
    var remarks = $('#certificationremarks').val();

    addcert(patientid,branchname,doctorname,impressions,diagnosis,remarks);
  });

  function fetchDoctorName(schedulebranch){
    $.ajax({
      url:"/schedule/getdoctorname/"+ schedulebranch,
      type:"GET",

      success:function(data){
        console.log(data);
        var len = data.length;

        $("#certificationdoctorname").empty();
        for( var i = 0; i<len; i++){
            var id = data[i]['id'];
            var name = data[i]['name'];
            
            $("#certificationdoctorname").append("<option value='"+id+"'>"+name+"</option>");

        }
      }

     });
  }

  $('#certificationbranch').change(function()
  {
      let schedulebranch = $('#certificationbranch').val()
      console.log(schedulebranch);
      fetchDoctorName(schedulebranch);
  });

  function addcert(patientid,branchname,doctorname,impressions,diagnosis,remarks) {
    $.ajax({
      url:"addcert/"+ patientid +"/"+branchname +"/"+ doctorname +"/"+ impressions +"/"+ diagnosis +"/"+ remarks,
      type:"POST",
      dataType:"json",
      data:{
        patientid:patientid,
        branchname:branchname,
        doctorname:doctorname,
        impressions:impressions,
        diagnosis:diagnosis,
        remarks: remarks,
        },
        beforeSend:function(){
          $('#btn-add-certificate').text('Please wait...');
          $('.loader').css('display', 'inline');
        },
      success:function(response){
               $('.update-success-validation').css('display', 'inline');
                $('.loader').css('display', 'none');
                $('#btn-add-certificate').text('Add');
                $('#datatable-certification').DataTable().ajax.reload();
                setTimeout(function(){
                $('.update-success-validation').fadeOut('slow');
                var patientname = $('#cinput-patientname').val('');
                var patientid = $('#cinput-search-userid').val('');
                var impressions = $('#certificationimpression').val('');
                var diagnosis = $('#certificationdiagnosis').val('');
                var remarks = $('#certificationremarks').val('');
                $('#CertificationModal').modal('toggle');
                $('#DoctorCertificationModal').modal('toggle');
                },2000);
      },
     });
  }

  function searchUser()
        {
            var id = $('#cinput-search-userid').val();
            $.ajax({
                url:"getusername/"+id,
                type:"GET",

                success:function(data){
                    console.log(data[0].name);
                    $('#cinput-patientname').val(data[0].name);
                   // $('#ebranch').val(data[0].branchname);
                }
               });
        }

        $(document).on('click', '#btn-certificationreport-print', function(){
          var id = $(this).attr('main-id');
          var patient_id = $(this).attr('patient-id');
          var doctor_id = $(this).attr('doctor-id');
          var branch_id = $(this).attr('branch-id');
          // let certificationreportbranch = $('#certificationreportbranch').val()
          // let certificationreportdoctorname = $('#certificationreportdoctorname').val()
          window.open('certification-report/print/'+id+'/'+patient_id+'/'+doctor_id+'/'+branch_id, '_blank');
        });


        // $('#btn-certificationreport-print').click(function () {
        //   let certificationreportbranch = $('#certificationreportbranch').val()
        //   let certificationreportdoctorname = $('#certificationreportdoctorname').val()
        //   console.log('ok');
        //   window.open('certification-report/print/'+certificationreportbranch+'/'+certificationreportdoctorname, '_blank');
  
        // });


});
