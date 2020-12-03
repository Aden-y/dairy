document.getElementById('registerbtn').onclick = function (e) {
    e.preventDefault()
    submit()
}


/**
 * Handles change on the type selection
 * to determine other input fields
 */
document.getElementById('type').onchange = function (e) {
    const type = this.value.trim()
    if(type == 'Farmer') {
        document.getElementById('agrovetname').style.display = 'none';
        document.getElementById('vetspecialization').style.display = 'none';
    }else if(type == 'Agrovet') {
        document.getElementById('agrovetname').style.display = 'block';
        document.getElementById('vetspecialization').style.display = 'none';
    }else if( type == 'Vet') {
        document.getElementById('agrovetname').style.display = 'none';
        document.getElementById('vetspecialization').style.display = 'block ';
    }
}

/**
 * Validates and submits login details
 */
function submit () {
    const firstname = document.getElementById('firstname').value.trim()
    if(firstname == '') {
        document.getElementById('firstnamehelp').innerHTML = 'Please enter first name'
        document.getElementById('firstname').classList.add('is-invalid')
        document.getElementById('firstname').focus()
        return
    }
    document.getElementById('firstnamehelp').innerHTML = ''
    document.getElementById('firstname').classList.remove('is-invalid')


    const lastname = document.getElementById('lastname').value.trim()
    if(lastname == '') {
        document.getElementById('lastnamehelp').innerHTML = 'Please enter last name'
        document.getElementById('lastname').classList.add('is-invalid')
        document.getElementById('lastname').focus()
        return
    }
    document.getElementById('lastnamehelp').innerHTML = ''
    document.getElementById('lastname').classList.remove('is-invalid')


    const id = document.getElementById('id').value.trim()
    if(id == '' || id.length < 6 || id.length > 8 || isNaN(id)) {
        document.getElementById('idhelp').innerHTML = 'Please enter a valid ID number'
        document.getElementById('id').classList.add('is-invalid')
        document.getElementById('id').focus()
        return
    }
    document.getElementById('idhelp').innerHTML = ''
    document.getElementById('id').classList.remove('is-invalid')



    const email = document.getElementById('email').value.trim();
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if(email == '' || !re.test(email) ) {
        document.getElementById('emailhelp').innerHTML = 'Please enter a valid email address'
        document.getElementById('email').classList.add('is-invalid')
        document.getElementById('email').focus()
        return
    }
    document.getElementById('emailhelp').innerHTML = ''
    document.getElementById('email').classList.remove('is-invalid')


    const phone = document.getElementById('phone').value.trim()
    if(phone == '' || phone.length != 10 || isNaN(phone)) {
        document.getElementById('phonehelp').innerHTML = 'Please enter a 10 digit phone number'
        document.getElementById('phone').classList.add('is-invalid')
        document.getElementById('phone').focus()
        return
    }
    document.getElementById('phonehelp').innerHTML = ''
    document.getElementById('phone').classList.remove('is-invalid')


   

    const county = document.getElementById('county').value.trim()
    if(county == '') {
        document.getElementById('countyhelp').innerHTML = 'Please enter county of residence'
        document.getElementById('county').classList.add('is-invalid')
        document.getElementById('county').focus()
        return
    }
    document.getElementById('countyhelp').innerHTML = ''
    document.getElementById('county').classList.remove('is-invalid')

    const subcounty = document.getElementById('subcounty').value.trim()
    if(subcounty == '') {
        document.getElementById('subcountyhelp').innerHTML = 'Please enter subcounty of residance'
        document.getElementById('subcounty').classList.add('is-invalid')
        document.getElementById('subcounty').focus()
        return

    }
    document.getElementById('subcountyhelp').innerHTML = ''
    document.getElementById('subcounty').classList.remove('is-invalid')

    const ward = document.getElementById('ward').value.trim()
    if(ward == '') {
        document.getElementById('wardhelp').innerHTML = 'Please enter ward'
        document.getElementById('ward').classList.add('is-invalid')
        document.getElementById('ward').focus()
        return
    }
    document.getElementById('wardhelp').innerHTML = ''
    document.getElementById('ward').classList.remove('is-invalid')


    const place = document.getElementById('place').value.trim()
    if(place == '') {
        document.getElementById('placehelp').innerHTML = 'Please enter place name'
        document.getElementById('place').classList.add('is-invalid')
        document.getElementById('place').focus()
        return
    }
    document.getElementById('placehelp').innerHTML = ''
    document.getElementById('place').classList.remove('is-invalid')

    const type = document.getElementById('type').value.trim()
    if(type == '') {
        document.getElementById('typehelp').innerHTML = 'Please select a role'
        document.getElementById('type').classList.add('is-invalid')
        document.getElementById('type').focus()
        return
    }
    document.getElementById('typehelp').innerHTML = ''
    document.getElementById('type').classList.remove('is-invalid')

    var agrovet = null
    var specialization = null
    if(type == 'Agrovet') {
         agrovet = document.getElementById('agrovet').value.trim()        
        if(agrovet == '') {
            document.getElementById('agrovethelp').innerHTML = 'Please enter the name of your agrovet'
            document.getElementById('agrovet').classList.add('is-invalid')
            document.getElementById('agrovet').focus()
            return
        }
        document.getElementById('agrovethelp').innerHTML = ''
        document.getElementById('agrovet').classList.remove('is-invalid')
    }else if(type == 'Vet') {
         specialization = document.getElementById('specialization').value.trim()
        if(specialization == '') {
            document.getElementById('specializationhelp').innerHTML = 'Please enter your specialization'
            document.getElementById('specialization').classList.add('is-invalid')
            document.getElementById('specialization').focus()
            return
        }
        document.getElementById('specializationhelp').innerHTML = ''
        document.getElementById('specialization').classList.remove('is-invalid')
    }

    const pwdRegx =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
    const password = document.getElementById('password').value.trim()
    if(password == '' || pwdRegx.test(password)) {
        document.getElementById('passwordhelp').innerHTML = 'Please enter  strong password.'
        document.getElementById('password').classList.add('is-invalid')
        document.getElementById('password').focus()
        return
    }
    document.getElementById('passwordhelp').innerHTML = ''
    document.getElementById('password').classList.remove('is-invalid')

    const conpassword = document.getElementById('conpassword').value.trim()
    if(conpassword != password) {
        document.getElementById('conpasswordhelp').innerHTML = 'Passwords do not match'
        document.getElementById('conpassword').classList.add('is-invalid')
        document.getElementById('conpassword').focus()
        return
    }
    document.getElementById('conpasswordhelp').innerHTML = ''
    document.getElementById('conpassword').classList.remove('is-invalid');



    /**
     * Prepare to submit data to the server
     */
    const url = 'http://localhost/dairy/api/controllers/RegisterController.php'
    const object = {
        firstname: firstname,
        lastname: lastname,
        national_id: id,
        email: email,
        phone: phone,
        county: county,
        subcounty:subcounty,
        ward: ward,
        place: place,
        type: type,
        specialization:specialization,
        agrovet:agrovet,
        password:password
    }
    $('#server-response').empty();
    const http = new XMLHttpRequest();
    http.open('POST', url)
    http.send(JSON.stringify(object))
    http.onreadystatechange = (e) => {
        if(http.readyState == 4) {
            const responseText = http.responseText;
            const response = JSON.parse(responseText)
            if(http.status   == 200) {
                $('#register-form')[0].reset();
                $('#server-response').append('<div class="alert alert-success text-center">'+response.message+'</div>')
            }else {
                $('#server-response').append('<div class="alert alert-danger text-center">'+response.error+'</div>')
            }
        }
    }
}
