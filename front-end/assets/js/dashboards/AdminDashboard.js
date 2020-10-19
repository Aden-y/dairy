function loadDashboard() {
    $.ajax({
        url: 'http://localhost/dairy/api/controllers/AdminHomeController.php?',
        type: 'POST',
        data: {},
        success: function (data) {
            const details = data.data.dashboard;
            $('#collection_total').text(details.collection_total);
            $('#collection_amount').text(details.collection_amount);
            $('#employees').text(details.employees);
            $('#vets').text(details.vets);
            $('#farmers').text(details.farmers);
            $('#agrovets').text(details.agrovets);
            $('#payout').text(details.payout);
            $('#stations').text(details.stations);

            const collections = data.data.collections;
            let output = `
                <tr>
                    <th>Station</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Amount</th>
                    <th>Farmer Name</th>
                    <th>Received By</th>
                </tr>
            `;
            for (let i=0; i<collections.length; i++) {
                output+=`
                    <tr>
                        <td>${collections[i].station}</td>
                        <td>${collections[i].date}</td>
                        <td>${collections[i].quantity}</td>
                        <td>${collections[i].price}</td>
                        <td>${collections[i].amount}</td>
                        <td>${collections[i].farmer}</td>
                        <td>${collections[i].attendant}</td>
                    </tr>
                `;
            }

            $('#all-submissions').html(output);

        },
        error: function (err) {
            console.log(err);
        }
    });
}

loadDashboard();
