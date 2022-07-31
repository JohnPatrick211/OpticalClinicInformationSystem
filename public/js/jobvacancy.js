$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      //fetchRegion();
      load_data();
      
      function load_data()  {
        let specialization = $('#filterspecialization').val()
        let region = $('#filterregion').val();
        fetchRegion(specialization,region);
    }

      function fetchRegion(specialization,region){

      var tbl_for_validation = $('#datatable-jobvacancy').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "jobvacancy-data",
           data:{
                specialization:specialization,
                region:region,
            },
          },

        columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'JVC-'+data;
            }
         }],
         order: [[0, 'asc']],

          columns:[
            {data: 'id', name: 'id'},
            {data: 'companyname', name: 'companyname'},
            {data: 'jobtitle', name: 'jobtitle'},
            {data: 'category', name: 'category'},
            {data: 'location', name: 'location'},
            {data: 'email', name: 'email'},
            // { data: 'BIR_file', name: 'BIR_file',
            //         render: function( data, type, full, meta ) {
            //             return "<img src=\"/storage/BIR/" + data + "\" height=\"50\"id=\"trigger\"/>";
            //           // return '<div align="center"><a href="/storage/jobposts/" """><img src="{{ asset("siteicons/Info_Box_Blue.png") }}" id="trigger" onclick="ShowSlider(0)"></a></div>';
            //         }
            //     },
            {data: 'action', name: 'action', orderable:false}
          ],
          order: [[0, 'asc']],
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


      $(document).on('click', '#btn-edit-jobvacancy', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
          fetchUploadInfo(id);
      });

      $(document).on('click', '#btn-delete-jobvacancy', function(){
        var id = $(this).attr('employer-id');
        console.log(id);
          fetchUploadInfofordelete(id);
      });

      function fetchUploadInfo(id){
        $.ajax({
          url:"/jobvacancy/jobvacancyinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            console.log(data[0].name);
            $('#cust-id-hidden').val(data[0].id);
            $('#editjobtitle').val(data[0].jobtitle);
            $('#editjobcompanyname').val(data[0].companyname);
            $('#editjobemail').val(data[0].email);
            $('#editjobspecialization').val(data[0].category);
            $('#editjobregion').val(data[0].location);
            $('#editjobcompanyoverview').val(data[0].companyoverview);
            $('#editjobdescription').val(data[0].jobdescription);
            $('#editjobsalary').val(data[0].salary);
            $('#editjobaddress').val(data[0].address);
             var img_source = '../../storage/profiles/'+data[0].logo;
            $('#image').attr('src', img_source);
            console.log(img_source);
           
          }

         });
      }

      function fetchUploadInfofordelete(id){
        $.ajax({
          url:"/jobvacancy/jobvacancyinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            $('#cust-id-hidden').val(data[0].id);
          }

         });
      }

      $(document).on('click', '#btn-edit-save-jobvacancy', function(){
        var id = $('#cust-id-hidden').val();
        var jobtitle = $('#editjobtitle').val();
        var specialization = $('#editjobspecialization').val();
        var companyoverview = $('#editjobcompanyoverview').val();
        var jobdescription = $('#editjobdescription').val();
        var region= $('#editjobregion').val();
        var address=  $('#editjobaddress').val();
        var salary=  $('#editjobsalary').val();
        var form = new FormData();
        form.append('id', id);
        form.append('jobtitle', jobtitle);
        form.append('specialization',specialization);
        form.append('jobdescription', jobdescription);
        form.append('companyoverview', companyoverview);
        form.append('specialization',specialization);
        form.append('address', address);
        form.append('region', region);
        form.append('salary', salary);
        console.log(form);
        edit(form);

      });

      $(document).on('click', '#btn_jobvacancy_delete', function(){
        var id = $('#cust-id-hidden').val();
        var form = new FormData();
        form.append('id', id);
        console.log(id);

       Delete(form);

      });

      function Delete(form) {
        $.ajax({
          url:"deletejobvacancy",
          type:"POST",
          data:form,
          cache: false,
    contentType: false,
    processData: false,
          beforeSend:function(){
              $('#btn_jobvacancy_delete').text('Please wait...');
              $('.loader').css('display', 'inline');
            }, 
          success:function(data){
              if(data.status == 1)
                {
                    console.log(data.status);
                    console.log(data.success);
                      $('.existjobvacancy-success').css('display', 'inline');
                      $('.loader').css('display', 'none');
                      $('#btn_jobvacancy_delete').text('Yes');
                      $('#datatable-jobvacancy').DataTable().ajax.reload();
                      setTimeout(function(){
                      $('.existjobvacancy-success').fadeOut('slow');
                      },2000);
                     
                }
                else
                {
                    console.log(data.status);
                    console.log(data.success);
                     $('.delete-success').css('display', 'inline');
                      $('.loader').css('display', 'none');
                      $('#btn_jobvacancy_delete').text('Yes');
                      $('#datatable-jobvacancy').DataTable().ajax.reload();
                      setTimeout(function(){
                      $('.delete-success').fadeOut('slow');
                      $('#jobvacancyproconfirmModal').modal('toggle');
                      },2000);
                }
          }

         });
      }

      function edit(form) {
        $.ajax({
          url:"editjobvacancy",
          type:"POST",
          data:form,
          cache: false,
    contentType: false,
    processData: false,
          beforeSend:function(){
              $('#btn-edit-save-region').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
               if(data.status == 1)
                {
                    console.log(data.status);
                    console.log(data.success);
                      $('.existemp-success').css('display', 'inline');
                      $('.loader').css('display', 'none');
                      $('#btn-edit-save-employer').text('Edit');
                      $('#datatable-jobvacancy').DataTable().ajax.reload();
                      setTimeout(function(){
                      $('.existemp-success').fadeOut('slow');
                      },2000);
                     
                }
                else
                {
                     $('.jobupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn-edit-save-jobvacancy').text('Edit');
              $('#datatable-jobvacancy').DataTable().ajax.reload();
              setTimeout(function(){
              $('.jobupdate-success-validation').fadeOut('slow');
              $('#editjobModal').modal('toggle');

            },2000);
                }
          }

         });
      }
      
       $('#filterspecialization').change(function()
       {
           let specialization = $('#filterspecialization').val()
           let region = $('#filterregion').val();
            console.log(specialization);
            console.log(region);
           $('#datatable-jobvacancy').DataTable().destroy();
           fetchRegion(specialization,region)
       });

      $('#filterregion').change(function()
      {
        let specialization = $('#filterspecialization').val()
        let region = $('#filterregion').val();
        console.log(specialization);
         console.log(region);
         $('#datatable-jobvacancy').DataTable().destroy();
         fetchRegion(specialization,region)
      });


});
