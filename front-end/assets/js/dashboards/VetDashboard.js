load();
function load() {
    $.ajax({
        url: 'http://localhost/dairy/api/controllers/VetHomeController.php?',
        type: 'GET',
        success: function (data) {
            data= data.data;
            $('#pending').text(data.pending);
            $('#total').text(data.total);
            $('#complete').text(data.complete);

            const requests = data.requests;
            let output = `
                <tr>
                    <th>Problem Category</th>
                    <th>Problem Description</th>
                    <th>Farmer Name</th>
                    <th>Contact</th>
                    <th>Update</th>
                </tr>
            `;
            requests.forEach(req => {
                output+=`
                <tr>
                    <td>${req.category}</td>
                    <td>${req.description}</td>
                    <td>${req.farmer}</td>
                    <td>${req.contact}</td>
                    <td>
                        <button onclick="showFeedbackModal(this)" id="${req.id}" 
                        class="btn-sm btn _btn-primary"
                        description="${req.description}" data-toggle="modal" 
                        data-target="#feedbackModal">
                         Complete
                        </button>
                    </td>
                </tr>
                `;
            });
            $('#pending-appointments').html(output);
        },
        error: function (error) {
            alert('Could not load dashboard');
            console.log(error);
        }
    })
}

function showFeedbackModal(e) {
    $('#_id').val(e.getAttribute('id'));
    $('#_d').val(e.getAttribute('description').trim());
}

function submitFeedback() {
    const feedback = $('#_f').val().trim();
    if(feedback === '') {
        alert('Please provide feedback');
        return;
    }
    let $feedback = {
        problem: $('#_d').val(),
        feedback: feedback,
        id: parseInt($('#_id').val())
    }
    $.ajax({
        url: 'http://localhost/dairy/api/controllers/VetFeedbackController.php?',
        type: 'post',
        data: JSON.stringify($feedback),
        success: function (res) {
            alert(res.message);
            $('#_id').val('');
            $('#_d').val('');
            $('#_f').val('');
            load();
        },
        error: function (error) {
            alert('Could not submit feedback');
            console.log(error);
        }
    });
    document.getElementById('_dismiss').click();
}
