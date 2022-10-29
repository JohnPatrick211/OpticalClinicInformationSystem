$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      fetchPatientPrescription();

      function fetchPatientPrescription(){

      var tbl_for_validation = $('#datatable-doctorpatientprescription').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "doctorpatientprescription-data",
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
            {data: 'doctor_name', name: 'doctor_name'},
            {data: 'branchname', name: 'branchname'},
            {data: 'date', name: 'date'},
            {data: 'time', name: 'time'},
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


      $(document).on('click', '#btn-preview-prescription', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
        fetchPrescriptionInfo(id);
      });

      function fetchPrescriptionInfo(id){
        $.ajax({
          url:"/doctorpatientprescription/getpatientprescriptioninfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            // $('#cust-id-hidden').val(data[0].id);
            // $('#editservicename').val(data[0].servicename);
            // $('#editoriginalprice').val(data[0].orig_price);
            // $('#editsellingprice').val(data[0].selling_price);
            // $('#editmarkup').val(data[0].markup);
            var doctorname = data[0].doctor_name;
            var branchname = data[0].branchname;  
            var date = data[0].date;
            var time = data[0].time;
            var patient_id = data[0].patient_id;
            var prescription = data[0].prescription;
            // console.log(wholesale_discount_amount);
            // console.log(senior_pwd_discount_amount);
            window.open("doctorpatientprescription/preview-prescription/"+doctorname +"/"+branchname+"/"+date+"/"+time+"/"+patient_id+"/"+prescription);
          }

         });
      }


      $(document).on('click', '#btn-edit-save-service', function(){
        var id = $('#cust-id-hidden').val();
        var servicename = $('#editservicename').val();
        var originalprice = $('#editoriginalprice').val();
        var sellingprice = $('#editsellingprice').val();
        var markup = $('#editmarkup').val();
        var branchname = $('#editservicebranch').val();
        console.log(servicename);

       edit(id,servicename,originalprice,sellingprice,markup,branchname);

      });



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
