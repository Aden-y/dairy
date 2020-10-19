window.onload = function (e) {
    loadDetails()
    loadSubmissions()
}
const url = 'http://localhost/dairy/api/controllers/FarmerAccountController.php?'
function loadDetails() {
    const http = new XMLHttpRequest()
    http.open('POST', url)
    http.send(JSON.stringify({action:'details'}))
    http.onreadystatechange = function(e) {
        if (http.readyState === 4) {
            const response = JSON.parse(http.responseText);
              if (http.status === 200) {
                 document.getElementById('submission').innerText = response.details.submission
                 document.getElementById('earnings').innerText = Math.round((response.details.earnings + Number.EPSILON) * 100) / 100 ;
                 document.getElementById('divident').innerText = response.details.divident
                 document.getElementById('balance').innerText = response.details.balance
              } else {
                 console.log('failed');
                 console.log(response)
              }
          }
    }
}

function loadSubmissions() {
    const http = new XMLHttpRequest()
    http.open('POST', url)
    http.send(JSON.stringify({action:'submissions'}))
    http.onreadystatechange = function(e) {
        if (http.readyState === 4) {
            const response = JSON.parse(http.responseText);
              if (http.status === 200) {
                 $('#my-submissions').empty()
                 $('#my-submissions').append('<tr><th>Date</th><th>Station</th><th>Received by</th><th>Unit Price</th><th>Quantity</th><th>Total Amount</th></tr>')
                 const submissions = response.submissions
                 submissions.forEach(element => {
                    $('#my-submissions').append('<tr><td>'+element.date+'</td><td>'+element.station.name+'</td><td>'+element.received_by+'</td><td>'+element.unit_price+'</td><td>'+element.quantity+'</td><td>'+element.amount+'</td></tr>')
                     console.log(element)
                 });
                } else {
                 console.log('failed');
                 console.log(response)
              }
          }
    }
}
