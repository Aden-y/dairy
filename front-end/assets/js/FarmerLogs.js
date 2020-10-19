$(document).ready(function () {
    if(document.getElementById('logs')) {
        loadLogs();
    }
});

function loadLogs() {
    $('#logs').empty();
    $('#logs').append('<div>Loading...</div>');
    const data = {
        action: 'farmer',
    }
    url  = 'http://localhost/dairy/api/controllers/LogsController.php?'
    const http = new XMLHttpRequest();
    http.open('post', url)
    http.send(JSON.stringify(data))
    http.onreadystatechange = function(e) {
        if(http.readyState == 4) {
            console.log(http.responseText)
            const response = JSON.parse(http.responseText)
            if(http.status == 200) {
                $('#logs').empty();
                const logs = response.logs;
                var head = '<table> <tr><th>Date</th><th>Type</th> <th>Description</th><th>Amount</th></tr>'
                var body = '';
                logs.forEach(log => {
                    var row = '<tr><td>'+log.date+'</td><td>'+log.type+'</td><td>'+log.description+'</td><td>'+log.amount+'</td></tr>';
                    body+= row;
                });
                var foot = '</table>';
                $('#logs').append(head+body+foot);
                console.log(response)
            }else {
                alert(response.error)
            }
        }
    }

}