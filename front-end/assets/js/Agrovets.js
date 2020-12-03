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
                    output += `<div class="col-lg-3 col-md-4"><div class="card _b-primary agrovet"><div class="_card-head"><h6> ${element.name} </h6>
                    </div><img src="./public/img/bg.jpg" class="card-img-top" alt="...">
                    <div class="card-body"><strong>Category</strong><br><small>${element.category}</small><br>
                    <strong>Description</strong><br><small>${element.description }</small><br>
                    <div class="text-center agrovet-price">Ksh. ${element.unit_price}</div><div class="text-center">
                    <a href="my-store.php?del=${element.id}"
                                    class="btn btn-sm _btn-primary m-2">
                                    <i class="fas fa-trash"></i></a>
                    </div></div></div></div>
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
                     output += `<div class="m-2 col-lg-4 col-md-6"><div class="card _b-primary agrovet">
                        <div class="_card-head"><h6>${element.name}</h6>
                    </div><img src="./public/img/bg.jpg" class="card-img-top" alt="...">
                    <div class="card-body"><strong>Category</strong><br><small>${element.category}</small><br>
                    <strong>Description</strong><br><small>${element.description}</small><br><strong>Seller</strong><br>
                    <small>${element.store.name}<br>(<i class="fas fa-map-marker-alt"></i>&nbsp;${element.store.address.county}, 
                    ${element.store.address.subcounty}, ${element.store.address.ward} - ${element.store.address.place})</small><br>
                    <div class="text-center agrovet-price">Ksh. ${element.unit_price}</div><div class="text-center"><button class="btn btn-sm _btn-primary m-2">
                    <i class="fas fa-phone-square"></i><span style="display:none">${element.store.owner.phone}</span></button><button class="btn btn-sm _btn-primary m-2">
                    <i class="fas fa-edit"></i></button></div></div></div></div>`
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
    }
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
