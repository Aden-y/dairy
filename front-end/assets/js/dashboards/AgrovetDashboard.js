load();
function load() {
    $.ajax({
        url:'http://localhost/dairy/api/controllers/AgrovetHomeController.php?',
        method: 'GET',
        success: function (data) {
            data = data.data;
            $('#complete').text(data.complete);
            $('#items').text(data.items);
            $('#active').text(data.active);
            $('#orders').text(data.orders);

            const orders = data.pending_orders;
            let output = `
                <tr>
                    <th>Customer Name</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Customer contact</th>
                    <th>Action</th>
                </tr>
            `;

            orders.forEach(i =>{
                output+=`
                    <tr>
                        <td>${i.farmer_name}</td>
                        <td>${i.item}</td>
                        <td>${i.quantity}</td>
                        <td>${i.contact}</td>
                        <td>
                            <button onclick="complete(this.id)" class="btn btn-sm _btn-primary" id="${i.id}">Mark Complete</button>
                        </td>
                    </tr>
                `;
            });
            $('#active-orders').html(output);
        },
        error: function (err) {
            alert('Could not load dashboard');
            console.log(err);
        }
    })
}


function complete(id) {
    $.ajax({
        url: 'http://localhost/dairy/api/controllers/CompleteOrderController.php?',
        type: 'POST',
        data: JSON.stringify({id: id}),
        success: function (data) {
            alert(data.message);
            load();
        },
        error: function (error) {
            alert('Could not update order status');
            console.log(error);
        }
    });
}
