url  = 'http://localhost/dairy/api/controllers/AdminUserController.php?'
var selected =  null;
const options = document.Userstodisplay.role;
options.forEach(option => {
    option.addEventListener('change', function (e) {
        if(this != selected) {
            selected = this;
            loadUsers(selected.value);
        }
    })
});



function displayUsers(role, users) {
    $('#users').empty();
    $('#users').append(' <div class="text-center mt-5">Loading ...</div>')
    $('#users').empty();
    if(users == null || users.length == 0) {
        $('#users').append(' <div class="text-center mt-5">No users found</div>')
        return;
    }
    var head = '<table><tr><th>Name</th><th>Phone</th><th>Address</th>';
    if(role == 'Vet') {
        head +='<th>Specialization</th><th>Verified</th>';
    }else if(role == 'Agrovet') {
        head+= '<th>Store</th><th>Verified</th>';
    }else if(role == 'Employee') {
        head+= '<th>Station</th>';
    }
    head+='<th>Registered on</th></tr>';
    var data = ''
    users.forEach(user => {
        var row = '<tr><td>'+user.firstname+' '+user.lastname+'</td><td>'+user.phone+'</td><td>'+user.address.county+','+user.address.subcounty+'</td>'
        if(role == 'Vet') {
            row +='<td>'+user.specialization+'</td><td>'+user.verified+'</td>';
        }else if(role == 'Agrovet') {
            row+= '<td>'+user.store+'</td><td>'+user.verified+'</td>';
        }else if(role == 'Employee') {
            row+= '<td>'+user.station+'</td>';
        }
        row += '<td>'+user.registered_on+'</td></tr>';
        data+=row;
    });
    
    var foot = '</table>';
    $('#users').append(head+data+foot);
}

function loadUsers(role) {
    // users = null;
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    // alert('Sending request..')
    http.send(JSON.stringify({action: 'users', role:role}));
    http.onreadystatechange = function (e) {
        if(http.readyState == 4) {
            const response = JSON.parse(http.responseText);
            if(http.status == 200) {
                const users = response.users;
                displayUsers(role, users)
            }else {
                alert(response.error);
            }
        }
    }
}

