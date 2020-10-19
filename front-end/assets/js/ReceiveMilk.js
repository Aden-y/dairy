function receiveMilk () {
    const farmer_id = $('#farmer_id').val().trim();
    if(farmer_id == '') {
        $('#farmer_idhelp').text('Please enter the farmer national id');
        $('#farmer_id').addClass('is-invalid');
        return false;
    }
    $('#farmer_idhelp').text('');
    $('#farmer_id').removeClass('is-invalid');


    const quantity = $('#quantity').val().trim();
    if(quantity == '') {
        $('#quantityhelp').text('Please enter milk quantity');
        $('#quantity').addClass('is-invalid');
        return false;
    }
    $('#quantityhelp').text('');
    $('#quantity').removeClass('is-invalid');

    const data = {
        farmer_id : farmer_id,
        quantity: quantity
    }
    url  = 'http://localhost/dairy/api/controllers/ReceiveMilkController.php?'
    const http = new XMLHttpRequest();
    http.open('post', url)
    http.send(JSON.stringify(data))
    http.onreadystatechange = function(e) {
        if(http.readyState == 4) {
            const response = JSON.parse(http.responseText)
            if(http.status == 200) {
                alert(response.message)
                $('#form')[0].reset();
            }else {
                alert(response.error);
            }
        }
    }
    return false;
}