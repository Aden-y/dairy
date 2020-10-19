$(document).ready(function () {
    if(document.getElementById('appointments')) {
        loadAppointments();
    }
});

function bookAppointment () {
 
    const category = $('#category').val().trim();
    if(category == '') {
        $('#categoryhelp').text('Please enter the category of the item');
        $('#category').addClass('is-invalid');
        return false;
    }
    $('#categoryhelp').text('');
    $('#category').removeClass('is-invalid');

    const description = $('#description').val().trim();
    if(description == '') {
        $('#descriptionhelp').text('Please enter the description of the item');
        $('#description').addClass('is-invalid');
        return false;
    }
    $('#descriptionhelp').text('');
    $('#description').removeClass('is-invalid');

   
    const date = $('#date').val().trim();
    if(date == '') {
        $('#datehelp').text('Please enter the date of the item');
        $('#date').addClass('is-invalid');
        return false;
    }
    $('#datehelp').text('');
    $('#date').removeClass('is-invalid');


    const data = {
        category: category,
        description: description,
        date: date,
        vet_id: $('#vet_id').val()
    }
    url  = 'http://localhost/dairy/api/controllers/CreateVetAppointmentController.php?'
    const http = new XMLHttpRequest();
    http.open('post', url)
    http.send(JSON.stringify(data))
    http.onreadystatechange = function(e) {
        if(http.readyState == 4) {
            console.log(http.responseText)
            const response = JSON.parse(http.responseText)
            if(http.status == 200) {
                $('#form')[0].reset();
                alert(response.message)
            }else {
                alert(response.error)
            }
        }
    }
    return false;

}


function loadAppointments() {
    $('#appointments').empty();
    $('#appointments').append('<div>Loading...</div>');
    const data = {
        action: 'farmer',
    }
    url  = 'http://localhost/dairy/api/controllers/VetAppointmentController.php?'
    const http = new XMLHttpRequest();
    http.open('post', url)
    http.send(JSON.stringify(data))
    http.onreadystatechange = function(e) {
        if(http.readyState == 4) {
            console.log(http.responseText)
            const response = JSON.parse(http.responseText)
            if(http.status == 200) {
                $('#appointments').empty();
                const appointments = response.appointments;
                var head = '<table> <tr><th>Problem</th><th>Vet</th> <th>Appontment date</th><th>Requested on</th><th>Status</th></tr>'
                var body = '';
                appointments.forEach(appointment => {
                    var row = '<tr><td>'+appointment.category+'</td><td>'+appointment.vet+'</td><td>'+appointment.date+'</td><td>'+appointment.created_on+'</td><td>'+appointment.status+'</td></tr>';
                    body+= row;
                });
                var foot = '</table>';
                $('#appointments').append(head+body+foot);
                console.log(response)
            }else {
                alert(response.error)
            }
        }
    }

}