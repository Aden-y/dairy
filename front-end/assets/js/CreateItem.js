function createItem () {
    const name = $('#name').val().trim();
    if(name == '') {
        $('#namehelp').text('Please enter the name of the item');
        $('#name').addClass('is-invalid');
        return false;
    }
    $('#namehelp').text('');
    $('#name').removeClass('is-invalid');


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

    const price = $('#price').val().trim();
    if(price == '') {
        $('#pricehelp').text('Please enter the price of the item');
        $('#price').addClass('is-invalid');
        return false;
    }
    $('#pricehelp').text('');
    $('#price').removeClass('is-invalid');

    const quantity = $('#quantity').val().trim();
    if(quantity == '') {
        $('#quantityhelp').text('Please enter the quantity of the item');
        $('#quantity').addClass('is-invalid');
        return false;
    }
    $('#quantityhelp').text('');
    $('#quantity').removeClass('is-invalid');


    const data = {
        name : name,
        category: category,
        description: description,
        unit_price: price,
        quantity: quantity
    }
    url  = 'http://localhost/dairy/api/controllers/NewAgrovetItemController.php?'
    const http = new XMLHttpRequest();
    http.open('post', url)
    http.send(JSON.stringify(data))
    http.onreadystatechange = function(e) {
        if(http.readyState == 4) {
            const response = JSON.parse(http.responseText)
            if(http.status == 200) {
                alert(response.message)
            }else {
                alert(response.error)
            }
        }
    }
    return false;

}