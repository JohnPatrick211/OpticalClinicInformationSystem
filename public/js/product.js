$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      fetchProduct();

      function fetchProduct(){

      var tbl_for_validation = $('#datatable-product').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "product-data",
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


      $(document).on('click', '#btn-edit-product', function(){
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
          url:"/product/getproductinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            $('#cust-id-hidden').val(data[0].id);
            $('#editproductname').val(data[0].productname);
            $('#editqty').val(data[0].qty);
            $('#editreorder').val(data[0].reorder);
            $('#editoriginalprice').val(data[0].orig_price);
            $('#editsellingprice').val(data[0].selling_price);
            $('#editmarkup').val(data[0].markup);
            $('#productimage-hidden').val(data[0].image);
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

      function fetchUploadInfofordelete(id){
        $.ajax({
          url:"/product/getproductinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            $('#cust-id-hidden').val(data[0].id);
          }

         });
      }

      $(document).on('click', '#btn-edit-save-product', function(){
        var id = $('#cust-id-hidden').val();
        var productname = $('#editproductname').val();
        var branchname = $('#editproductbranch').val();
        var category =  $('#editcategory_id').val();
        var qty =  $('#editqty').val();
        var reorder =  $('#editreorder').val();
        var originalprice = $('#editoriginalprice').val();
        var sellingprice = $('#editsellingprice').val();
        var markup = $('#editmarkup').val();
        var file = $("#editproductimage")[0].files[0];
        var form = new FormData();
        form.append('id', id);
        form.append('productname', productname);
        form.append('branchname', branchname);
        form.append('category', category);
        form.append('qty', qty);
        form.append('reorder', reorder);
        form.append('originalprice',originalprice);
        form.append('sellingprice', sellingprice);
        form.append('markup', markup);
        form.append('file', file);
        console.log(file);
        console.log(form);
        edit(form);

      });

      $(document).on('click', '#btn_product_delete', function(){
        var id = $('#cust-id-hidden').val();
        console.log(id);

       Delete(id);

      });

      function Delete(id) {
        $.ajax({
          url:"/product/deleteproduct/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_product_delete').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
            if(data.status == 1)
            {
                console.log(data.status);
                console.log(data.success);
                $('.existproduct-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_product_delete').text('Yes');
              $('#datatable-product').DataTable().ajax.reload();
              setTimeout(function(){
              $('.existproduct-success').fadeOut('slow');
            },2000);
              
            }
            else
            {
                console.log(data.status);
                console.log(data.success);
            $('.delete-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_product_delete').text('Yes');
              $('#datatable-product').DataTable().ajax.reload();
              setTimeout(function(){
              $('.delete-success').fadeOut('slow');
              $('#proconfirmModal').modal('toggle');

            },2000);
                
            }
          }

         });
      }

      function edit(form) {
        $.ajax({
          url:"/product/editproduct/",
          type:"POST",
          data:form,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend:function(){
              $('#btn-edit-save-product').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              if(data.status == 1)
            {
                console.log(data.status);
                console.log(data.success);
                $('.existproduct-success').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn-edit-save-product').text('Edit');
              $('#datatable-product').DataTable().ajax.reload();
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
              $('#btn-edit-save-product').text('Edit');
              $('#datatable-product').DataTable().ajax.reload();
              setTimeout(function(){
              $('.update-success-validation').fadeOut('slow');
              $('#EditProductModal').modal('toggle');

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
