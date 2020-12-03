$(document).ready(function () {
    loadVets()
});
function loadVets() {
    const url = 'http://localhost/dairy/api/controllers/VetsController.php?'
    const http = new XMLHttpRequest()
    http.open('POST', url)
    http.send(JSON.stringify({action: 'all'}))
    http.onreadystatechange = function (e) {
        if(http.readyState === 4) {
            const response = JSON.parse(http.responseText)
            if(http.status === 200)  {
                const vets = response.vets
                //$('#vets').empty()
                if(vets.length == 0) {
                    $('#vets').append('<div>No vets have registered yet.</div>');
                }else {
                    $('#vets').empty()
                    vets.forEach(element => {
                        var output = '<div class="col-md-4 col-lg-3">'
                        output += '<div class="card _b-primary">'
                        output += '<div class="_card-head">'
                        output+=' <h6>'+element.name+'</h6></div>'
                        output+='<div class="card-body text-center row"><div class="col-10">'
                        output+='<p>'+element.specialization+'</p><div><small><i class="fas fa-map-marker-alt"></i>'
                        output+=element.address.county+','+element.address.subcounty+','+element.address.ward+' - '+element.address.place
                        output+=' </small></div></div>'
                        if(element.verified == 0) {
                            output+='<div class="col-2 verified">'
                        }else {
                            output+='<div class="col-2 verified tp">'
                        }
                        output+='<i class="fas fa-award"></i></div><div class="col-12">'
                        output+='<button id="'+element.id+'" class="btn btn-sm m-2 _btn-primary"><i class="fas fa-phone-square"></i> &nbsp;'+element.phone
                        output+='<span style="display:none">'+element.phone
                        output+='</span></button><a class="btn btn-sm m-2 _btn-primary" href="mailto:'+element.email+'"><i class="fas fa-envelope-square"></i></a>'
                        output+='<a class="btn btn-sm m-2 _btn-primary" href="./book-appointment.php?vet='+element.id+'">'
                        output+='<i class="fas fa-calendar-alt"></i>&nbsp; Book Appointment</a></div></div></div></div>'
                        $('#vets').append(output)
                    });
                }
            }else {
                alert("Error")
                console.log(response)
            }
        }
    }
}
