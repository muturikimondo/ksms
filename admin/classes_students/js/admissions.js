$(document).ready(function () {
                // Initialize Select2 on the select inputs
                $('#email').select2();
            $('#class').select2();
            $('#searchClass').select2();  // Initialize searchable select for class filter

            // Load email data via AJAX
            $.ajax({
                url: 'ajax/fetch_data.php',
            type: 'POST',
            data: {type: 'email' },
            success: function (response) {
                $('#email').html(response);
            }
        });

            // Load class data via AJAX
            $.ajax({
                url: 'ajax/fetch_data.php',
            type: 'POST',
            data: {type: 'class' },
            success: function (response) {
                $('#class').html(response);
            $('#searchClass').html(response);  // Populate the search filter for class
            }
        });

            // Submit form data to insert or update a record in the database
            $('#biodataForm').on('submit', function (e) {
                e.preventDefault();

            $.ajax({
                url: 'ajax/submit_or_update_admission.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                alert(response);
            loadAdmissions();  // Reload the admissions table
            $('#biodataForm')[0].reset();  // Reset the form
            $('#student_id').val('');
            $('#submitBtn').text('Submit');
                }
            });
        });

            // Function to load admissions data with optional search criteria and page number
            function loadAdmissions(query = '', className = '', page = 1) {
                $.ajax({
                    url: 'ajax/load_admissions-1.php',
                    type: 'GET',
                    data: { search: query, className: className, page: page },
                    success: function (data) {
                        $('#admissionsTable tbody').html(data);
                    }
                });
        }

            // Initial load of admissions data
            loadAdmissions();

            // Search function by admission number/email
            $('#search').on('keyup', function () {
            var query = $(this).val();
            var className = $('#searchClass').val();
            loadAdmissions(query, className);
        });

            // Filter by class
            $('#searchClass').on('change', function () {
            var className = $(this).val();
            var query = $('#search').val();
            loadAdmissions(query, className);
        });

            // Function to delete admission
            $(document).on('click', '.delete-btn', function () {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    url: 'ajax/delete_admission.php',
                    type: 'POST',
                    data: { id: id },
                    success: function (response) {
                        alert(response);
                        loadAdmissions();  // Reload the admissions table
                    }
                });
            }
        });

            // Function to populate the form for updating
            $(document).on('click', '.update-btn', function () {
            var id = $(this).data('id');
            $.ajax({
                url: 'ajax/get_admission.php',
            type: 'POST',
            data: {id: id },
            success: function (data) {
                    var admission = JSON.parse(data);
            $('#student_id').val(admission.id);
            $('#email').val(admission.student_email).trigger('change');
            $('#adm_no').val(admission.admission_number);
            $('#class').val(admission.class_admitted).trigger('change');
            $('#submitBtn').text('Update');
                }
            });
        });

            // Pagination button click handler
            $(document).on('click', '.pagination-btn', function () {
            var page = $(this).data('page');
            var query = $('#search').val();
            var className = $('#searchClass').val();
            loadAdmissions(query, className, page);
        });
    });
   
