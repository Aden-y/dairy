document.getElementById('registerbtn').onclick = function (e) {
    e.preventDefault()
    submit()
}



/**
 * Validates and submits  
 */
function submit () {
    const name = document.getElementById('name').value.trim()
    if(name == '') {
        document.getElementById('namehelp').innerHTML = 'Please enter station name'
        document.getElementById('name').classList.add('is-invalid')
        document.getElementById('name').focus()
        return
    }
    document.getElementById('namehelp').innerHTML = ''
    document.getElementById('name').classList.remove('is-invalid')


   

    const county = document.getElementById('county').value.trim()
    if(county == '') {
        document.getElementById('countyhelp').innerHTML = 'Please enter station county'
        document.getElementById('county').classList.add('is-invalid')
        document.getElementById('county').focus()
        return
    }
    document.getElementById('countyhelp').innerHTML = ''
    document.getElementById('county').classList.remove('is-invalid')

    const subcounty = document.getElementById('subcounty').value.trim()
    if(subcounty == '') {
        document.getElementById('subcountyhelp').innerHTML = 'Please enter station subcounty'
        document.getElementById('subcounty').classList.add('is-invalid')
        document.getElementById('subcounty').focus()
        return

    }
    document.getElementById('subcountyhelp').innerHTML = ''
    document.getElementById('subcounty').classList.remove('is-invalid')

    const ward = document.getElementById('ward').value.trim()
    if(ward == '') {
        document.getElementById('wardhelp').innerHTML = 'Please enter station ward'
        document.getElementById('ward').classList.add('is-invalid')
        document.getElementById('ward').focus()
        return
    }
    document.getElementById('wardhelp').innerHTML = ''
    document.getElementById('ward').classList.remove('is-invalid')



    const unit_price = document.getElementById('unit_price').value.trim()
    if(unit_price == '') {
        document.getElementById('unit_pricehelp').innerHTML = 'Please enter unit_price'
        document.getElementById('unit_price').classList.add('is-invalid')
        document.getElementById('unit_price').focus()
        return
    }
    document.getElementById('unit_pricehelp').innerHTML = ''
    document.getElementById('unit_price').classList.remove('is-invalid')


    


    
    /**
     * Prepare to submit data to the server
     */
    const url = 'http://localhost/dairy/api/controllers/RegisterCollectionPointController.php?'
    const object = {
        name: name,
        county: county,
        subcounty:subcounty,
        ward: ward,
        unit_price: unit_price,
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
                $('#server-response').append('<div class="alert alert-success text-center">'+response.message+'</div>')
            }else {
                $('#server-response').append('<div class="alert alert-danger text-center">'+response.error+'</div>')
            }
        }
    }

    
}

