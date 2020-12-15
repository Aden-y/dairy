const url = 'http://localhost/dairy/api/controllers/AgrovetItemsController.php?';
let cart = [];

$(document).ready(function () {
    // loadItems()
    if($('#my-store') != null) {
        loadMyStore();
    }
});

function loadMyStore() {
    const http = new XMLHttpRequest()
    http.open('POST', url)
    http.send(JSON.stringify({action:'all'}))
    http.onreadystatechange = function(e) {
        const response = JSON.parse(http.responseText)
        if(http.readyState === 4) {
            $('#agrovets').empty();
            if(http.status == 200) {
                const items = response.items
                var output = ``;
                items.forEach(element => {
                    console.log(element)
                    output+=`
                    <tr>
                        <td>${element.name}</td>
                       <td>${element.description}</td>
                       <td>Ksh. ${element.unit_price}</td>
                       <td><button id="${element.id}" data-toggle="modal" data-target="#addToCart"  name="${element.name}" price="${element.unit_price}" onclick="addToCart(this)">Add To Cart</button></td>
                    </tr>
                    `;
                });

                $('#agrovets').append(output);
            }else{
                console.log(response)
            }
        }
    }
}

function loadItems() {
    const http = new XMLHttpRequest()
    http.open('POST', url)
    http.send(JSON.stringify({action:'all'}))
    http.onreadystatechange = function(e) {
        const response = JSON.parse(http.responseText)
        if(http.readyState === 4) {
            let output =``;
            if(http.status == 200) {
                const items = response.items
                items.forEach(element => {
                    console.log(element)
                    output+=`
                    <tr>
                        <td>${element.name}</td>
                       <td>${element.description}</td>
                       <td>Ksh .${element.unit_price}</td>
                       <td><button id="${element.id}"  name="${element.name}" price="${element.unit_price}" onclick="addToCart(this)">Add To Cart</button></td>
                    </tr>
                    `;
                });
                $('#agrovets').html(output);
            }else{
                console.log(response)
            }
        }
    }
}

function addToCart(e) {
    const name = e.getAttribute('name');
    const id = e.getAttribute('id');
    const price = e.getAttribute('price');
    $('#_n').val(name);
    $('#_p').val(price);
    $('#_id').val(id);
}

function _addToCart() {
    if ($('#_q').val().trim() === '' || parseInt($('#_q').val().trim()) < 1) {
        alert('Invalid quantity');
        return;
    }
    let data = {
        name : $('#_n').val(),
        price: parseFloat($('#_p').val()),
        id: parseInt($('#_id').val()),
        quantity: parseInt($('#_q').val())
    };
    document.getElementById('_dismiss').click();
    cart.push(data);
}

function showCart() {
    if (cart.length == 0) {
        $('#_cart').html('No items in cart.');
        return;
    }
    let output = `
        <table>
        <tr>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Amount</th>
        </tr>
    `;
    let amt = 0.0;
    cart.forEach(item =>{
        output+=`
            <tr>
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>${item.quantity * item.price}</td>
            </tr>
        `;
        amt+=(item.quantity * item.price);
    });


    output+=`
        </table>
        <p style="font-weight: bold">Total Amount : Ksh.${amt}</p>
        <div class="mb-2 mt-2">
            <button class="btn btn-sm btn-danger" onclick="clearCart()">Clear Cart</button>
        </div>
    `;
    $('#_cart').html(output);
}

function clearCart() {
    cart = [];
    showCart();
}

function submitOrder() {
    if (cart.length == 0) {
        alert('Please add some items to cart first.');
        return;
    }
    let data=[];
    cart.forEach(item =>{
        data.push({
            item_id: item.id,
            quantity: item.quantity
        });
    });

    $.ajax({
        url: 'http://localhost/dairy/api/controllers/NewOrderController.php?',
        type: 'POST',
        data: JSON.stringify(data),
        success: function (res) {
            alert('Order placed successfully. The respective agro vets will have been notified and you will be contacted.');
            document.getElementById('__dismiss').click();
            clearCart();
        },
        error: function (err) {
            alert('Could not submit your order.');
            console.log(err);
        }
    });
}
//
