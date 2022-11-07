$(document).ready(function()
{

    fetchStaff();
    fetchDoctor();
    fetchSecretary();
    fetchAdmin();
    LoadSpecialization();

    // var check4 = function() {
    //   if (document.getElementById('password').value.trim().length <=
    //    7) {
    //     $('.reject-password').css('display', 'inline');
    //     document.getElementById('btn-register-user').disabled = false;
    //   }if(document.getElementById('registerpassword').value !=
    //   document.getElementById('registerconfirm_password').value){
    //     $('.registerprofile-fail').css('display', 'inline');
    //     $('.registerprofile-success').css('display', 'none');
    //     document.getElementById('btn-register-user').disabled = true;
    //     }     
    // }

    function LoadSpecialization()
    {
      let user_type = $('#user_type').val()
         if(user_type == 'Doctor')
         {
          var test = $('#specialization').val('');
          $('.hide-specialization').css('display', 'inline');
          console.log(test);
         }
         else
         {
          var test = $('#specialization').val('none');
          $('.hide-specialization').css('display', 'none');
          console.log(test);
         }
    }

    function LoadSpecialization2()
    {
      let user_type = $('#euser_type').val()
         if(user_type == 'Doctor')
         {
          var test = $('#especialization').val('');
          $('.ehide-specialization').css('display', 'inline');
          console.log(test);
         }
         else
         {
          var test = $('#especialization').val('none');
          $('.ehide-specialization').css('display', 'none');
          console.log(test);
         }
    }

    function fetchAdmin(){
        $('#admin-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"user-maintenance/admin",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'ADM-'+data;
            }
         }],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'contactno', name: 'contactno'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }

       function fetchDoctor(){
        $('#doctor-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"user-maintenance/doctor",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'DOC-'+data;
            }
         }],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'specialty', name: 'specialty'},
            {data: 'branchname', name: 'branchname'},
            {data: 'email', name: 'email'},
            {data: 'contactno', name: 'contactno'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }

       function fetchSecretary(){
        $('#secretary-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"user-maintenance/secretary",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'SEC-'+data;
            }
         }],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'branchname', name: 'branchname'},
            {data: 'email', name: 'email'},
            {data: 'contactno', name: 'contactno'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }

       function fetchStaff(){
        $('#staff-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"user-maintenance/staff",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'STAFF-'+data;
            }
         }],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'branchname', name: 'branchname'},
            {data: 'email', name: 'email'},
            {data: 'contactno', name: 'contactno'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }

       $('#user_type').change(function()
       {
         let user_type = $('#user_type').val()
         if(user_type == 'Doctor')
         {
          var test = $('#specialization').val('');
          $('.hide-specialization').css('display', 'inline');
          console.log(test);
         }
         else
         {
          var test = $('#specialization').val('none');
          $('.hide-specialization').css('display', 'none');
          console.log(test);
         }
       });

      //  $('#euser_type').change(function()
      //  {
      //    let user_type = $('#euser_type').val()
      //    if(user_type == 'Doctor')
      //    {
      //     var test = $('#especialization').val('');
      //     $('.ehide-specialization').css('display', 'inline');
      //     console.log(test);
      //    }
      //    else
      //    {
          // var test = $('#especialization').val('none');
          // $('.ehide-specialization').css('display', 'none');
          // console.log(test);
      //    }
      //  });

       
        // show user details
        $(document).on('click', '#btn-edit-user', function()
        {
            let id = $(this).attr('employer-id');
            let user_type = $(this).attr('user-type');
            console.log(id);
            console.log(user_type);
            if(user_type == 'Doctor')
            {
                $('#edit_user_type').val('Doctor'); 
                console.log(user_type);
                var test = $('#especialization').val('');
                $('.ehide-specialization').css('display', 'inline');
                console.log(test);
                getUserDetails(id);
            }
            else if(user_type == 'Secretary'){
                $('#edit_user_type').val('Secretary');
                console.log(user_type);
                var test = $('#especialization').val('none');
                $('.ehide-specialization').css('display', 'none');
               console.log(test);
                getUserDetails(id);
            }
            else if(user_type == 'Staff'){
              $('#edit_user_type').val('Staff');
              console.log(user_type);
              var test = $('#especialization').val('none');
             $('.ehide-specialization').css('display', 'none');
             console.log(test);
              getUserDetails(id);
          }
            else if(user_type == 'System Admin'){
              $('#edit_user_type').val('System Admin');
              console.log(user_type);
              var test = $('#especialization').val('none');
             $('.ehide-specialization').css('display', 'none');
             console.log(test);
              getUserDetails(id);
          }
        });

        function getUserDetails(id)
        {
            $.ajax({
                url:"user-maintenance-details/"+id,
                type:"GET",

                success:function(data){
                    console.log(data);
                    $('#euser_id_hidden').val(id);
                    $('#euser_type').text(data[0].user_role);
                    $('#ename').val(data[0].name);
                    $('#eemail').val(data[0].email);
                    $('#econtact_no').val(data[0].contactno);
                    $('#eaddress').val(data[0].address);
                    $('#eusername').val(data[0].username);
                    $('#eage').val(data[0].age);
                    $('#ebirthdate').val(data[0].birthdate);
                    $('#egender').val(data[0].gender);
                    $('#ecivilstatus').val(data[0].civilstatus);
                    if(data[0].user_role == 'Doctor')
                    {
                      $('#especialization').val(data[0].specialty);
                    }
                    else{
                      $('#especialization').val('none');
                    }
                   // $('#ebranch').val(data[0].branchname);
                }
               });
        }

        $(document).on('click', '#btn-archive-user', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            $('#id_archive').val(id);
        });

        $(document).on('click', '#btn_archive_user', function(){
            var id = $('#id_archive').val();
            console.log(id);

           Archive(id);

          });

          function Archive(id) {
            $.ajax({
              url:"usermaintenance/archiveuser/"+ id,
              type:"POST",
              data:{
                  id:id,
                },
                beforeSend:function(){
                    $('#btn_archive_user').text('Please wait...');
                    $('.loader').css('display', 'inline');
                  },
                success:function(data){
                    $('.dupdate-success-validation').css('display', 'inline');
                    $('.loader').css('display', 'none');
                    $('#btn_archive_user').text('Yes');
                    $('#secretary-table').DataTable().ajax.reload();
                    $('#doctor-table').DataTable().ajax.reload();
                    $('#staff-table').DataTable().ajax.reload();
                    $('#admin-table').DataTable().ajax.reload();
                    setTimeout(function(){
                    $('.dupdate-success-validation').fadeOut('slow');
                    $('#archiveModal').modal('toggle');

                },2000);
              }

             });
          }


        $(document).on('click', '#ebtn-update', function(){
            var id = $('#euser_id_hidden').val();
            var user_type = $('#euser_type').text();
            var name = $('#ename').val();
            var specialization = $('#especialization').val();
            var email = $('#eemail').val();
            var contact_no = $('#econtact_no').val();
            var address = $('#eaddress').val();
            var username = $('#eusername').val();
            var password =  $('#epassword').val();
            var age = $('#eage').val();
            var birthdate = $('#ebirthdate').val();
            var gender = $('#egender').val();
            var civilstatus = $('#ecivilstatus').val();
            var branch = $('#ebranch').val();
            console.log(id);
            console.log(user_type);
            if(password.trim() == '')
            {
                editwithoutpassword(id,user_type,name,email,contact_no,address,username,age,birthdate,gender,civilstatus,branch,specialization);
            }
            else
            {
                edit(id,user_type,name,email,contact_no,address,username,password,age,birthdate,gender,civilstatus,branch,specialization);
            }

        function edit(id,user_type,name,email,contact_no,address,username,password,age,birthdate,gender,civilstatus,branch,specialization) {
            $.ajax({
              url:"usermaintenance/edituser/"+ id +"/"+ user_type +"/"+ name +"/"+ email +"/"+ contact_no +"/"+ address +"/"+ username +"/"+ password +"/"+ age +"/"+ birthdate +"/"+ gender +"/"+ civilstatus +"/"+ branch+"/"+ specialization,
              type:"POST",
              data:{
                  id:id,
                  user_type:user_type,
                  name:name,
                  email:email,
                  contact_no:contact_no,
                  address:address,
                  username:username,
                  password:password,
                  age:age,
                  birthdate:birthdate,
                  gender:gender,
                  civilstatus:civilstatus,
                  branch:branch,
                  specialization:specialization,
                },
              beforeSend:function(){
                  $('#ebtn-update').text('Please wait...');
                  $('.loader').css('display', 'inline');
                },
              success:function(data){
                  $('.eupdate-success-validation').css('display', 'inline');
                  $('.loader').css('display', 'none');
                  $('#ebtn-update').text('Edit');
                  $('#secretary-table').DataTable().ajax.reload();
                  $('#doctor-table').DataTable().ajax.reload();
                  $('#staff-table').DataTable().ajax.reload();
                  $('#admin-table').DataTable().ajax.reload();
                  setTimeout(function(){
                  $('.eupdate-success-validation').fadeOut('slow');
                  var password =  $('#epassword').val("");
                  $('#editUserModal').modal('toggle');

                },2000);
              }

             });
          }

          function editwithoutpassword(id,user_type,name,email,contact_no,address,username,age,birthdate,gender,civilstatus,branch,specialization) {
            $.ajax({
              url:"usermaintenance/edituserwithoutpassword/"+ id +"/"+ user_type +"/"+ name +"/"+ email +"/"+ contact_no +"/"+ address +"/"+ username +"/"+ age +"/"+ birthdate +"/"+ gender +"/"+ civilstatus +"/"+ branch+"/"+ specialization,
              type:"POST",
              data:{
                  id:id,
                  user_type:user_type,
                  name:name,
                  email:email,
                  contact_no:contact_no,
                  address:address,
                  username:username,
                  age:age,
                  birthdate:birthdate,
                  gender:gender,
                  civilstatus:civilstatus,
                  branch:branch,
                  specialization:specialization,
                },
              beforeSend:function(){
                  $('#ebtn-update').text('Please wait...');
                  $('.loader').css('display', 'inline');
                },
              success:function(data){
                console.log(data);
                  $('.eupdate-success-validation').css('display', 'inline');
                  $('.loader').css('display', 'none');
                  $('#ebtn-update').text('Edit');
                  $('#secretary-table').DataTable().ajax.reload();
                  $('#doctor-table').DataTable().ajax.reload();
                  $('#staff-table').DataTable().ajax.reload();
                  $('#admin-table').DataTable().ajax.reload();
                  setTimeout(function(){
                  $('.eupdate-success-validation').fadeOut('slow');
                  $('#editUserModal').modal('toggle');

                },2000);
              }

             });
          }

        });
        $(document).on('click', '#btn-save-user', function(){
            var user_type = $('#user_type').val();
            var name = $('#name').val();
            var specialization = $('#specialization').val();
            console.log(specialization);
            var email = $('#email').val();
            var contact_no = $('#contact_no').val();
            var address = $('#address').val();
            var username = $('#username').val();
            var password =  $('#password').val();
            var age = $('#age').val();
            var birthdate = $('#birthdate').val();
            var gender = $('#gender').val();
            var civilstatus = $('#civilstatus').val();
            var branch = $('#branch').val();
            add(user_type,name,email,contact_no,address,username,password,age,birthdate,gender,civilstatus,branch,specialization);

            function add(user_type,name,email,contact_no,address,username,password,age,birthdate,gender,civilstatus,branch,specialization) {
                $.ajax({
                  url:"usermaintenance/adduser/"+ user_type +"/"+ name +"/"+ email +"/"+ contact_no +"/"+ address +"/"+ username +"/"+ password +"/"+ age +"/"+ birthdate +"/"+ gender +"/"+ civilstatus +"/"+ branch+"/"+ specialization,
                  type:"POST",
                  dataType:"json",
                  data:{
                      user_type:user_type,
                      name:name,
                      email:email,
                      contact_no:contact_no,
                      address:address,
                      username:username,
                      password:password,
                      age:age,
                      birthdate:birthdate,
                      gender:gender,
                      civilstatus:civilstatus,
                      branch:branch,
                      specialization:specialization,
                    },
                  beforeSend:function(){
                      $('#btn-save-user').text('Please wait...');
                      $('.loader').css('display', 'inline');
                      $('.empty-reject-password').css('display', 'none');
                      $('.reject-password').css('display', 'none');
                      $('.empty-reject-name').css('display', 'none');
                      $('.empty-reject-email').css('display', 'none');
                      $('.empty-reject-contact_no').css('display', 'none');
                      $('.empty-reject-address').css('display', 'none');
                      $('.empty-reject-username').css('display', 'none');
                      $('.reject-contact_no').css('display', 'none');
                    },
                  success:function(response){
                    if(response.status == 1)
                      {
                          console.log(response.status);
                           $('.update-success-validation').css('display', 'inline');
                            $('.loader').css('display', 'none');
                            $('#btn-save-user').text('Save');
                            $('#secretary-table').DataTable().ajax.reload();
                            $('#doctor-table').DataTable().ajax.reload();
                            $('#staff-table').DataTable().ajax.reload();
                            $('#admin-table').DataTable().ajax.reload();
                            setTimeout(function(){
                            $('.update-success-validation').fadeOut('slow');
                            var user_type = $('#user_type').val();
                            var name = $('#name').val("");
                            var specialization = $('#specialization').val('');
                            var email = $('#email').val("");
                            var contact_no = $('#contact_no').val("");
                            var address = $('#address').val("");
                            var username = $('#username').val("");
                            var password =  $('#password').val("");
                            var age = $('#age').val("");
                            var birthdate = $('#birthdate').val();
                            $('#addUserModal').modal('toggle');

                            },2000);
                      }
                        else
                        {
                            console.log(response.status);
                              $('.reject-validation').css('display', 'inline');
                              $('.loader').css('display', 'none');
                              $('#btn-save-user').text('Save');
                              $('#secretary-table').DataTable().ajax.reload();
                              $('#doctor-table').DataTable().ajax.reload();
                              $('#staff-table').DataTable().ajax.reload();
                              $('#admin-table').DataTable().ajax.reload();
                              setTimeout(function(){
                                  $('.reject-validation').fadeOut('slow');
                                  var password =  $('#password').val("");
                                  },2000);
                        }



                    //   else if(response.status == 2)
                    //   {
                    //       $('.reject-password').css('display', 'inline');
                    //       $('.loader').css('display', 'none');
                    //     $('#btn-save-user').text('Save');
                    //     console.log('aaa');
                    //   }

                  },
                  error: function (data) {
                    if (data.status == 404) {
                        var pass = password.trim().length;
                        var con = contact_no.trim().length;
                        if(password.trim() == '')
                        {
                            $('.empty-reject-password').css('display', 'inline');
                            $('.loader').css('display', 'none');
                            $('#btn-save-user').text('Save');
                        }
                        else if(pass <= 7)
                        {
                            $('.reject-password').css('display', 'inline');
                            $('.loader').css('display', 'none');
                            $('#btn-save-user').text('Save');
                        }
                        if(name.trim() == '')
                        {
                            $('.empty-reject-name').css('display', 'inline');
                            $('.loader').css('display', 'none');
                            $('#btn-save-user').text('Save');
                        }if(age.trim() == '')
                        {
                            $('.empty-reject-age').css('display', 'inline');
                            $('.loader').css('display', 'none');
                            $('#btn-save-user').text('Save');
                        }
                        if(birthdate.trim() == '')
                        {
                            $('.empty-reject-birthday').css('display', 'inline');
                            $('.loader').css('display', 'none');
                            $('#btn-save-user').text('Save');
                        }
                        if(email.trim() == '')
                        {
                            $('.empty-reject-email').css('display', 'inline');
                            $('.loader').css('display', 'none');
                            $('#btn-save-user').text('Save');
                        }
                        if(username.trim() == '')
                        {
                            $('.empty-reject-username').css('display', 'inline');
                            $('.loader').css('display', 'none');
                            $('#btn-save-user').text('Save');
                        }
                        if(address.trim() == '')
                        {
                            $('.empty-reject-address').css('display', 'inline');
                            $('.loader').css('display', 'none');
                            $('#btn-save-user').text('Save');
                        }
                        if(contact_no.trim() == '')
                        {
                            $('.empty-reject-contact_no').css('display', 'inline');
                            $('.loader').css('display', 'none');
                            $('#btn-save-user').text('Save');
                        }
                        if(specialization.trim() == ''){
                          $('.empty-reject-specialization').css('display', 'inline');
                            $('.loader').css('display', 'none');
                            $('#btn-save-user').text('Save');
                        }
                        else if(con <= 10)
                        {
                            $('.reject-contact_no').css('display', 'inline');
                            $('.loader').css('display', 'none');
                            $('#btn-save-user').text('Save');
                        }

                    }
                }

                 });
              }

        });
});
