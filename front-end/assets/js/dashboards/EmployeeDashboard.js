function load() {
    $.ajax({
        url : 'http://localhost/dairy/api/controllers/EmployeeHomeController.php?',
        type: 'GET',
        success: function (data) {
            data = data.data;
            //console.log(data)
            $('#today').text(data.today);
            $('#station').text(data.station);
            $('#total').text(data.total);
            $('#price').text(data.price);

            $collections = data.collections;
            let output = `
                <tr>
                    <th>Date</th>
                    <th>Farmer Name</th>
                    <th>Quantity</th>
                    <th>Price Per Litre</th>
                    <th>Amount</th>
                </tr>
            `;
            for (let i=0; i<$collections.length; i++) {
                output+= `
                    <tr>
                    <td>${$collections[i].date}</td>
                    <td>${$collections[i].farmer}</td>
                    <td>${$collections[i].quantity}</td>
                    <td>${$collections[i].price}</td>
                    <td>${$collections[i].amount}</td>
                </tr>
                `;
            }

            $('#station-submissions').html(output);
        },
        error: function (err) {
            console.log(err);
        }
    });
}

load();
