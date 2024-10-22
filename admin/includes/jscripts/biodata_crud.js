
    $(document).ready(function () {
        function loadTable() {
            var query = $('#search').val();
            $.ajax({
                url: "ajax/load_biodata.php",
                type: "POST",
                data: { query: query },
                success: function (data) {
                    $('#biodataTable').html(data);
                }
            });
        }

        loadTable();

        $('#search').on('keyup', function () {
            loadTable();
        });

        $('#addForm').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "ajax/add.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#addModal').modal('hide');
                    loadTable();
                }
            });
        });

        $(document).on('click', '.edit-btn', function () {
            const id = $(this).data('id');
            $.ajax({
                url: "ajax/get.php",
                type: "POST",
                data: { id: id },
                success: function (data) {
                    const biodata = JSON.parse(data);
                    $('#edit_id').val(biodata.id);
                    $('#edit_name').val(biodata.name);
                    $('#edit_date_of_birth').val(biodata.date_of_birth);
                    $('#edit_gender').val(biodata.gender);
                    $('#edit_date_of_admission').val(biodata.date_of_admission);
                    $('#edit_county').val(biodata.county);
                    $('#edit_home_address').val(biodata.home_address);
                    $('#edit_phone').val(biodata.phone);
                    $('#edit_email').val(biodata.email);
                    $('#existing_photo').val(biodata.upload_photo);
                    if (biodata.upload_photo) {
                        $('#photo_preview').attr('src', 'uploads/' + biodata.upload_photo).show();
                    } else {
                        $('#photo_preview').hide();
                    }
                    $('#editModal').modal('show');
                }
            });
        });

        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "ajax/edit.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#editModal').modal('hide');
                    loadTable();
                }
            });
        });

        $(document).on('click', '.delete-btn', function () {
            if (confirm('Are you sure you want to delete this record?')) {
                const id = $(this).data('id');
                $.ajax({
                    url: "ajax/delete.php",
                    type: "POST",
                    data: { id: id },
                    success: function (data) {
                        loadTable();
                    }
                });
            }
        });
    });
