$(document).ready(function () {
    if(document.getElementById('appointments')) {
        loadAppointments('all', 'appointments');
        return;
    }
    if(document.getElementById('pending-appointments')) {
        loadAppointments('pending', 'pending-appointments');
        return;
    }
    
});

function displayAppointments(appointments, outputid) {
    $('#'+outputid).empty();
                var head = '<table> <tr><th>Problem</th><th>Description</th><th>Farmer</th> <th>Appontment date</th><th>Requested on</th><th>Status</th></tr>'
                var body = '';
                appointments.forEach(appointment => {
                    var row = '<tr><td>'+appointment.category+'</td><td>'+appointment.description+'</td><td>'+appointment.farmer+'</td><td>'+appointment.date+'</td><td>'+appointment.created_on+'</td><td>'+appointment.status+'</td></tr>';
                    body+= row;
                });
                var foot = '</table>';
    $('#'+outputid).append(head+body+foot);
}


function loadAppointments(status, outputid) {
    $('#'+outputid).empty();
    $('#'+outputid).append('<div>Loading...</div>');
    const data = {
        action: 'vet',
        status: status
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
                const appointments = response.appointments;
                displayAppointments(appointments, outputid);
              
            }else {
                alert(response.error)
            }
        }
    }

}