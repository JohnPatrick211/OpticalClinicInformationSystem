$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      fetchPatientHistory();

      function fetchPatientHistory(){

      var tbl_for_validation = $('#datatable-secretarypatienthistory').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "secretarypatienthistory-data",
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
            {data: 'invoice_no', name: 'invoice_no'},
            {data: 'branchname', name: 'branchname'},
            {data: 'payment_method', name: 'payment_method'},
            {data: 'updated_at', name: 'updated_at'},
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


      $(document).on('click', '#btn-preview-receipt', function(){
        var invoice_no = $(this).attr('employer-id');
        console.log(invoice_no);
        fetchHistoryInfo(invoice_no);
      });

      function fetchHistoryInfo(invoice_no){
        $.ajax({
          url:"/secretarypatienthistory/getpatienthistoryinfo/"+ invoice_no,
          type:"GET",

          success:function(data){
            console.log(data);
            // $('#cust-id-hidden').val(data[0].id);
            // $('#editservicename').val(data[0].servicename);
            // $('#editoriginalprice').val(data[0].orig_price);
            // $('#editsellingprice').val(data[0].selling_price);
            // $('#editmarkup').val(data[0].markup);
            var wholesale_discount_amount = data[0].wholesale_discount_amount;
            var senior_pwd_discount_amount = data[0].senior_pwd_discount_amount;
            var billingbranch = data[0].branch_id;
            var patientname = data[0].user_id;
            console.log(wholesale_discount_amount);
            console.log(senior_pwd_discount_amount);
            window.open("secretarypatienthistory/preview-invoice/"+wholesale_discount_amount +"/"+senior_pwd_discount_amount+"/"+billingbranch+"/"+patientname+"/"+invoice_no);
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
