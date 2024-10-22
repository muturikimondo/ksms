$(document).ready(function () {
    $('#student_email').select2({
        placeholder: 'Select or type email',
        ajax: {
            url: 'ajax/fetch_emails.php',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    term: params.term // Search term from Select2
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    // Form submission with AJAX
    $('#admissionForm').submit(function (event) {
        event.preventDefault();

        var formData = $(this).serialize(); // Serialize all form fields

        $.ajax({
            url: 'ajax/handle_form.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    alert(res.message);
                    // Optionally refresh data or clear the form
                } else {
                    alert('Error: ' + res.message);
                }
            },
            error: function () {
                alert('Form submission failed.');
            }
        });
    });
});
