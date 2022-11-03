const inputs = document.querySelectorAll('.input');

function focusFunc(){
    let parent = this.parentNode.parentNode;
    parent.classList.add('focus');
}

function blurFunc(){
    let parent = this.parentNode.parentNode;
    if(this.value == "")
    {
        parent.classList.remove('focus');
    }
}

inputs.forEach(input => {
    input.addEventListener('focus',focusFunc);
    input.addEventListener('blur',blurFunc);
})

var check = function() {
    if (document.getElementById('editpassword').value ==
      document.getElementById('editconfirm_password').value) {
      $('.editprofile-success').css('display', 'inline');
      $('.editprofile-fail').css('display', 'none');
    }if(document.getElementById('editpassword').value !=
    document.getElementById('editconfirm_password').value){
      $('.editprofile-fail').css('display', 'inline');
      $('.editprofile-success').css('display', 'none');
    }
  }

  var check2 = function() {
    if (document.getElementById('registerpassword').value ==
      document.getElementById('registerconfirm_password').value) {
      $('.registerprofile-success').css('display', 'inline');
      $('.registerprofile-fail').css('display', 'none');
    }if(document.getElementById('registerpassword').value !=
    document.getElementById('registerconfirm_password').value){
      $('.registerprofile-fail').css('display', 'inline');
      $('.registerprofile-success').css('display', 'none');
    }
  }

  var check3 = function() {
    if (document.getElementById('password').value ==
      document.getElementById('confirm_password').value) {
      $('.signupprofile-success').css('display', 'inline');
      $('.signupprofile-fail').css('display', 'none');
    }if(document.getElementById('password').value !=
    document.getElementById('confirm_password').value){
      $('.signupprofile-fail').css('display', 'inline');
      $('.signupprofile-success').css('display', 'none');
    }
  }


