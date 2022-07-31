$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      load_data();

      function load_data()  {
          let inventorybranch = $('#inventorybranch').val()
          console.log(inventorybranch);
          fetchInventoryProduct(inventorybranch);
          fetchReorderProduct(inventorybranch);

      }

      function fetchInventoryProduct(inventorybranch){

        $('#inventory-table').DataTable({
  
            processing: true,
            serverSide: true,
  
            ajax:{
             url: "inventory-data",
             data:{
              inventorybranch:inventorybranch
              },
            },
            
  
            columnDefs: [{
              targets: 0,
              searchable: false,
              orderable: true,
              changeLength: true,
              className: 'dt-body-center',
              render: function (data, type, full, meta){
                  return 'P-'+data;
              }
           },
           {
            targets: [6,7],
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return '₱'+data;
            }
         }],
  
            columns:[
              {data: 'id', name: 'id'},
              {data: 'productname', name: 'productname'},
              {data: 'branchname', name: 'branchname'},
              {data: 'qty', name: 'qty'},
              {data: 'reorder', name: 'reorder'},
              {data: 'name', name: 'name'},
              {data: 'orig_price', name: 'orig_price'},
              {data: 'selling_price', name: 'selling_price'},
              {data: 'markup', name: 'markup'},
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


      function fetchReorderProduct(inventorybranch){

      $('#reorder-table').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "reorder-data",
           data:{
            inventorybranch:inventorybranch
            },
          },
          

          columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'P-'+data;
            }
         },
         {
          targets: [6,7],
          orderable: true,
          changeLength: true,
          className: 'dt-body-center',
          render: function (data, type, full, meta){
              return '₱'+data;
          }
       }],

          columns:[
            {data: 'id', name: 'id'},
            {data: 'productname', name: 'productname'},
            {data: 'branchname', name: 'branchname'},
            {data: 'qty', name: 'qty'},
            {data: 'reorder', name: 'reorder'},
            {data: 'name', name: 'name'},
            {data: 'orig_price', name: 'orig_price'},
            {data: 'selling_price', name: 'selling_price'},
            {data: 'markup', name: 'markup'},
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

      $('#inventorybranch').change(function()
      {
          let inventorybranch = $('#inventorybranch').val()
          console.log(inventorybranch);
          $('#inventory-table').DataTable().destroy();
          $('#reorder-table').DataTable().destroy();
          fetchInventoryProduct(inventorybranch);
          fetchReorderProduct(inventorybranch);
      });
      


      $(document).on('click', '#btn-inventory-product', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
        fetchUploadInfo(id);
      });

      $(document).on('click', '#btn-delete-product', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
          fetchUploadInfofordelete(id);
      });

      function fetchUploadInfo(id){
        $.ajax({
          url:"/inventory/getproductinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            $('#cust-id-hidden').val(data[0].id);
            $('#inventoryproductid').val('P-' + data[0].id);
            $('#inventoryproductname').val(data[0].productname);
            $('#inventorycategory').val(data[0].name);
            $('#inventoryqty').val(data[0].qty);
            if(data[0].image !== null){
              var img_source = '../../images/productimage/'+data[0].image;
            }
            else{
              var img_source = '../../storage/BIR/banner2.jpg';
            }
              $('#image').attr('src', img_source);
              console.log(img_source);
              
                $("#editproductimage").on("change", function (e) {
                  var file = $(this)[0].files[0];
                  console.log(file);
              });
          }

         });
      }

      $(document).on('click', '#btn-inventoryproduct', function(){
        var id = $('#cust-id-hidden').val();
        var qty =  $('#addinventoryqty').val();
        var form = new FormData();
        form.append('id', id);
        form.append('qty', qty);
        edit(form);

      });

      function edit(form) {
        $.ajax({
          url:"/inventory/addquantity/",
          type:"POST",
          data:form,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend:function(){
              $('#btn-inventoryproduct').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              if(data.status == 1)
            {
                console.log(data.status);
                console.log(data.success);
                $('.existproduct-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn-inventoryproduct').text('Add');
              $('#inventory-table').DataTable().ajax.reload();
              $('#reorder-table').DataTable().ajax.reload();
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
              $('#btn-inventoryproduct').text('Add');
              $('#inventory-table').DataTable().ajax.reload();
              $('#reorder-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.update-success-validation').fadeOut('slow');
              $('#EditReorderProductModal').modal('toggle');

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
