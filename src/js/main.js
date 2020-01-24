$('.user-form').on('submit', function (event) {

  $('.string-input').each(function () {
    /*Check our input (are they empty)*/
    if ($(this).val() == '') {
      $(this).addClass('bg')//make our input red
      let parent = $(this).closest('li')
      event.preventDefault()
      /*Add warning block*/
      parent.append(`<div class="warning"> 
                      <p>You enter wrong value</p>
                      <div class="registration-arrow"></div>
                      </div>`)
    } else {
      $(this).removeClass('bg')//if everything ok,delete red background in input
      $(this).closest('li').children('.warning').remove()
    }
  })
  if ($('#male').prop('checked') == true && $('#female').prop('checked') == true) {
    /*Check if user choose two variants*/
    let genderParent = $('#male').parent()
    genderParent.append(`<div class="gender-warning"> 
                      <p>You enter wrong gender value</p>
                      <div class="registration-arrow"></div>
                      </div>`)
    event.preventDefault()
  }
})

$('#UserpasswordAgain').on('blur', function () {
  /*Check if our passwords are not the same*/
  if ($(this).val() != $('#Userpassword').val()) {
    let parent = $(this).parent()
    parent.append(`<div class="warning"> 
                      <p>Passwords are not the same</p>
                      <div class="registration-arrow"></div>
                      </div>`)
  } else {
    $(this).parent().children('.warning').remove()
  }
})

/*Check our "sign in" form*/
$('.sign-form').on('submit', function (event) {
  $('.sign-inputs').each(function () {

    if ((this).value == '') {//if input is empty
      event.preventDefault()
      let parent = $(this).closest('li')
      if (parent.hasClass('name-input')) {
        /*Add warning massage for input "User name"*/
        parent.append(`<div class="sign-in-warning name-input-css"> 
                      <p>You don't enter any value</p>
                      <div class="arrow"></div>
                      </div>`)
      } else {
        /*Add warning massage for "password input"*/
        parent.append(`<div class="sign-in-warning"> 
                      <p>You don't enter any value</p>
                      <div class="arrow"></div>
                      </div>`)
      }
    }
  })
})

