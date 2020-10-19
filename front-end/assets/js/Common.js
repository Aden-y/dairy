const logoutbtn = document.getElementById('logoutbtn')
if(logoutbtn != null) { 
    logoutbtn.onclick = function (e) {
        e.preventDefault()
        const http = new XMLHttpRequest()
        const url='http://localhost/dairy/api/controllers/LogoutController.php';
        http.open('POST',url )
        http.send()
        http.onreadystatechange = function (e) {
            console.log(http.responseText)
            window.location.href = './index.php'
        }
    }
}