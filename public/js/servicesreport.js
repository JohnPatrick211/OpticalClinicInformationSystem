
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      load_data();

      function load_data()  {
        let date_from = $('#servicesreportdate_from').val()
        let date_to = $('#servicesreportdate_to').val();
        let servicesreportbranch = $('#servicesreportbranch').val()
        fetchServicesReport(date_from,date_to,servicesreportbranch);
        console.log(servicesreportbranch);
        fetchTotalServices(date_from, date_to,servicesreportbranch);

      }


      function fetchServicesReport(date_from,date_to,servicesreportbranch){
      var tbl_for_validation = $('#services-report-table').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "services-report-data",
           data:{
            date_from:date_from,
            date_to:date_to,
            servicesreportbranch:servicesreportbranch,
            },
          },

          success:function(data){

            console.log(data);
             },

             columnDefs: [{
              targets: 1,
              searchable: false,
              orderable: true,
              changeLength: true,
              className: 'dt-body-center',
              render: function (data, type, full, meta){
                const firstDigitStr = String(data)[0];
                console.log(firstDigitStr);
                if(firstDigitStr == 2)
                {
                  return 'S-'+data;
                }
                else
                {
                  return '1-'+data;
                }
              }
           },
           {
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'INV-'+data;
            }
          },
           {
            targets: [4,6],
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return '₱'+data;
            }
         }],

  
            columns:[
              {data: 'invoice_no', name: 'invoice_no'},
              {data: 'product_id', name: 'product_id'},
              {data: 'productname', name: 'productname'},
              {data: 'branchname', name: 'branchname'},
              {data: 'selling_price', name: 'selling_price'},
              {data: 'qty', name: 'qty'},
              {data: 'amount', name: 'amount'},
              {data: 'created_at', name: 'created_at'},
  
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

      $('#servicesreportdate_from').change(function()
      {
        let date_from = $('#servicesreportdate_from').val()
        let date_to = $('#servicesreportdate_to').val();
        let servicesreportbranch = $('#servicesreportbranch').val()
        $('#services-report-table').DataTable().destroy();
        fetchServicesReport(date_from,date_to,servicesreportbranch);
        fetchTotalServices(date_from, date_to,servicesreportbranch);
       
      });

      $('#servicesreportdate_to').change(function()
      {
        let date_from = $('#servicesreportdate_from').val()
        let date_to = $('#servicesreportdate_to').val();
        let servicesreportbranch = $('#servicesreportbranch').val()
        $('#services-report-table').DataTable().destroy();
        fetchServicesReport(date_from,date_to,servicesreportbranch);
        fetchTotalServices(date_from, date_to,servicesreportbranch);
      });

      $('#servicesreportbranch').change(function()
      {
        let date_from = $('#servicesreportdate_from').val()
        let date_to = $('#servicesreportdate_to').val();
        let servicesreportbranch = $('#servicesreportbranch').val()
        $('#services-report-table').DataTable().destroy();
        fetchServicesReport(date_from,date_to,servicesreportbranch);
        fetchTotalServices(date_from, date_to,servicesreportbranch);
       
      });
      
      $('#btn-servicesreport-print').click(function () {
        let date_from = $('#servicesreportdate_from').val()
        let date_to = $('#servicesreportdate_to').val();
        let servicesreportbranch = $('#servicesreportbranch').val()
        window.open('services-report/print/'+date_from+'/'+date_to+'/'+servicesreportbranch, '_blank');

      });

      function fetchTotalServices(date_from, date_to,servicesreportbranch) {
        $('#txt-total-services').html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            url: '/compute-total-services',
            type: 'GET',
            data: {
                date_from        :date_from,
                date_to          :date_to,
                servicesreportbranch:servicesreportbranch,
            },
            success:function(total_sales){
                
                total_sales = parseFloat(total_sales)
                $('#txt-total-services').html(formatNumber(total_sales));
            }
        });
    }

});




