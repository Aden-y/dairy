document.getElementById('registerbtn').onclick = function (e) {
    e.preventDefault()
    submit()
}

$(document).ready(function () {
    getStations();
});


/**
 * Handles change on the type selection
 * to determine other input fields
 */
document.getElementById('type').onchange = function (e) {
    const type = this.value.trim()
    if(type == 'Employee') {
        document.getElementById('_stations').style.display = 'block';
        
    }else {
        document.getElementById('_stations').style.display = 'none';
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
    if(id == '') {
        document.getElementById('idhelp').innerHTML = 'Please enter ID number'
        document.getElementById('id').classList.add('is-invalid')
        document.getElementById('id').focus()
        return
    }
    document.getElementById('idhelp').innerHTML = ''
    document.getElementById('id').classList.remove('is-invalid')



    const email = document.getElementById('email').value.trim()
    if(email == '') {
        document.getElementById('emailhelp').innerHTML = 'Please enter email'
        document.getElementById('email').classList.add('is-invalid')
        document.getElementById('email').focus()
        return
    }
    document.getElementById('emailhelp').innerHTML = ''
    document.getElementById('email').classList.remove('is-invalid')


    const phone = document.getElementById('phone').value.trim()
    if(phone == '') {
        document.getElementById('phonehelp').innerHTML = 'Please enter phone number'
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

    var station = null

    if(type == 'Employee') {
        station = $('#station').val();
        if(station == null || station == undefined || station == '') {
            $('#station').addClass('is-invalid');
            $('#stationhelp').text('Please select a station');
            $('#station').focus();
            return false;
        }
        $('#station').removeClass('is-invalid');
        $('#stationhelp').text('');

    }
    
    /**
     * Prepare to submit data to the server
     */
    const url = 'http://localhost/dairy/api/controllers/AdminUserController.php'
    const object = {
        firstname: firstname,
        action : 'register',
        lastname: lastname,
        national_id: id,
        email: email,
        phone: phone,
        county: county,
        subcounty:subcounty,
        ward: ward,
        place: place,
        type: type,
        station_id:station,
        password:id
    }
    $('#server-response').empty();
    const http = new XMLHttpRequest();
    http.open('POST', url)
    http.send(JSON.stringify(object))
    http.onreadystatechange = (e) => {
        if(http.readyState == 4) {
            const responseText = http.responseText;
            console.log(responseText)
            const response = JSON.parse(responseText)
            if(http.status   == 200) {
                $('#register-form')[0].reset();
                $('#server-response').append('<div class="alert alert-success text-center">'+response.message+'. Ths user can login using their national id as password</div>')
            }else {
                $('#server-response').append('<div class="alert alert-danger text-center">'+response.error+'</div>')
            }
        }
    }

    
}

function getStations() {
    const url = 'http://localhost/dairy/api/controllers/CollectionPointController.php';
    const http = new XMLHttpRequest();
    http.open('POST', url);
    http.send(JSON.stringify({action:'nameid'}));
    http.onreadystatechange = function (e) {
        if(http.readyState == 4) {
            const response = JSON.parse(http.responseText);
            if(http.status == 200) {
                $('#station').empty();
                $('#station').append('<option></option>');
                response.stations.forEach(station => {
                    $('#station').append('<option value="'+station.id+'">'+station.name+'</option>');

                });
            }else {
                alert(response.error)
            }
        }
    }

}

