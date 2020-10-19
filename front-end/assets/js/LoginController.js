    /*
        submit the form to the server
     */
    document.getElementById('loginbtn').onclick  = function (e) {
        e.preventDefault();
        this.innerHTML = 'Please wait ...'
        this.disabled = true
        $('#servermessage').empty()
        submit()
        this.disabled = false
        this.innerHTML = 'Login'
    }

    /**
     * Sumit validate and submit use data to the server
     */
    function submit(){        
        const email = document.getElementById('email').value.trim()
        const password = document.getElementById('password').value
        if(email == '') {
            document.getElementById('email')
            document.getElementById('email').innerHTML = 'Please enter your email.' 
        }

        const object = {
            email : email,
            password : password
        }
        const http = new XMLHttpRequest();
        const url='http://localhost/dairy/api/controllers/LoginController.php';
        http.open("POST", url);
        http.send(JSON.stringify(object));
        http.onreadystatechange = (e) => {
            const stringResponse = http.responseText;
            try{
                const response = JSON.parse(stringResponse)
                if(response.status != 200 && response.status != 500) {
                    $('#servermessage').append('<div class="text-center alert alert-danger">'+response.error+'</div>')
                }else if(response.status == 500) {
                    $('#servermessage').append('<div class="text-center alert alert-danger">Internal server error</div>')
                }else if(response.status == 200) {
                    sessionStorage.setItem('token', response.token)
                    window.location = "./dashboard.php";
                }
            }catch(e) {
                console.log(stringResponse)
            }
        }  
    }
