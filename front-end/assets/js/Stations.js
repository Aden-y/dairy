$(document).ready(function () {
    loadstations();
});
url  = 'http://localhost/dairy/api/controllers/CollectionPointController.php?'

function displayStations(stations) {
    $('#stations').empty();
    $('#stations').append(' <div class="text-center mt-5">Loading ...</div>')
    $('#stations').empty();
    if(stations == null || stations.length == 0) {
        $('#stations').append(' <div class="text-center mt-5">No stations found</div>')
        return;
    }
    var head = '<table><tr><th>Name</th><th>Attendant</th><th>Address</th><th>Status</th><th>Total Collections</th><th>Registered on</th></tr>';
 
    var data = ''
    stations.forEach(station => {
        var row = '<tr>';
        row+= '<td>'+station.name+'</td>';
        row+= '<td>'+station.attendant+'</td>';
        row+= '<td>'+station.county+', '+station.subcounty+' '+station.ward+'</td>';
        row+= '<td>'+station.status+'</td>';
        row+= '<td>'+station.total+'</td>';
        row+= '<td>'+station.registered_on+'</td>';
        row+='</tr>';

        data+=row;
    });
    
    var foot = '</table>';
    $('#stations').append(head+data+foot);
}

function loadstations() {
    // stations = null;
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    // alert('Sending request..')
    http.send(JSON.stringify({action: 'all'}));
    http.onreadystatechange = function (e) {
        if(http.readyState == 4) {
            console.log(http.responseText)
            const response = JSON.parse(http.responseText);
            if(http.status == 200) {
                stations = response.stations;
                console.log(stations)
                displayStations(stations)
            }else {
                alert(response.error);
            }
        }
    }
}

