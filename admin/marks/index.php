



<?php
// File: admin/index.php

// Start session and check if user is an admin
session_start();
require '../admin_auth.php';  // Ensure this path is correct based on your file structure
?>










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KSMS | Examination Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../includes/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>

.btn {
    padding: 0.25rem 0.5rem;
    border: none; /* Optional: remove border */
    background: transparent; /* Optional: remove background */
    color: inherit; /* Make icon color inherit from parent */
}

.btn:hover {
    color: #0056b3; /* Example hover color */
}



        .pagination {
            display: flex;
            list-style-type: none;
            padding: 0;
            justify-content: center;
            /* Center pagination links */
        }

        .pagination .page-link {
            margin: 0 5px;
            padding: 8px 12px;
            border: 1px solid #007bff;
            color: #007bff;
            text-decoration: none;
        }

        .pagination .page-link.active {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container mt-4">


    <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal" title="Logout">
                <i class="bi bi-power"></i>
            </button>
        </div>





        <div>
            <h4>Students' Marks Entry</h4>
            <form id="crudForm" class="form-horizontal">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="examination">Examination</label>
                        <select id="examination" class="form-control select2" style="width: 100%;">
                            <option value="">Select Examination</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="class_entered">Class Entered</label>
                        <select id="class_entered" class="form-control select2" style="width: 100%;">
                            <option value="">Select Class</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="subject_entered">Subject Entered</label>
                        <select id="subject_entered" class="form-control select2" style="width: 100%;">
                            <option value="">Select Subject</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="Student_regno">Student Reg No</label>
                        <select id="Student_regno" class="form-control select2" style="width: 100%;">
                            <option value="">Select Student</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="student_marks">Student Marks</label>
                        <input type="number" id="student_marks" class="form-control" min="0">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                </button>
                <input type="hidden" id="record_id"> <!-- Hidden input for ID -->
            </form>
        </div>

        <!-- Search Form -->
        <div class="mt-4">
            <h4>Search Marks Entered</h4>
            <form id="searchForm" class="form-inline">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="searchClass" class="sr-only">Class</label>
                            <select id="searchClass" class="form-control select2" style="width: 100%;">
                                <option value="">Select Class</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="searchStudent" class="sr-only">Student Number</label>
                            <select id="searchStudent" class="form-control select2" style="width: 100%;">
                                <option value="">Select Student</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="searchSubject" class="sr-only">Subject</label>
                            <select id="searchSubject" class="form-control select2" style="width: 100%;">
                                <option value="">Select Subject</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary mb-2">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="mt-4">
            <h4>List of Marks Entered</h4>
            <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Examination</th>
                        <th>Class Entered</th>
                        <th>Subject Entered</th>
                        <th>Student Reg No</th>
                        <th>Student Marks</th>
                        <th>Date Entered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div class="row mb-2">
            <div class="col-12">
                <div id="pagination" class="pagination"></div>
            </div>
        </div>
    </div>



<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="../../logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>





    <script>
        $(document).ready(function () {
            // Initialize Select2
            $('.select2').select2();

            // Load options for select inputs
            loadOptions();

            // Load initial records
            loadTableData();

            // CRUD form submission
            $('#crudForm').on('submit', function (e) {
                e.preventDefault();
                submitForm();
            });

            // Event handler for class_entered change
            $('#class_entered').on('change', function () {
                loadStudentNumbers(); // Load student numbers when class is selected
            });

            // Event handler for search class change
            $('#searchClass').on('change', function () {
                loadSearchStudentNumbers(); // Load student numbers for search
                loadSearchSubjects(); // Load subjects for search
            });

            // Search form submission
            $('#searchForm').on('submit', function (e) {
                e.preventDefault();
                searchRecords();
            });
        });

        // Load options for examinations, classes, and subjects
        function loadOptions() {
            $.ajax({
                url: 'ajax/getOptions.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    populateSelect('#examination', data.examinations);
                    populateSelect('#class_entered', data.classes);
                    populateSelect('#subject_entered', data.subjects);
                    populateSelect('#searchClass', data.classes);
                },
                error: function () {
                    console.log('Failed to load options');
                }
            });
        }

        // Load student numbers based on selected class for the main form
        function loadStudentNumbers(selectedStudent) {
            var classEntered = $('#class_entered').val();
            $.ajax({
                url: 'ajax/getStudentNumbersByClass.php',
                method: 'GET',
                data: { class_entered: classEntered },
                dataType: 'json',
                success: function (data) {
                    populateSelect('#Student_regno', data.students, selectedStudent);
                },
                error: function () {
                    console.log('Failed to load student numbers');
                }
            });
        }

        // Load student numbers for search based on selected class
        function loadSearchStudentNumbers() {
            var classEntered = $('#searchClass').val();
            $.ajax({
                url: 'ajax/getStudentNumbersForSearch.php',
                method: 'GET',
                data: { class_entered: classEntered },
                dataType: 'json',
                success: function (data) {
                    populateSelect('#searchStudent', data.students);
                },
                error: function () {
                    console.log('Failed to load student numbers for search');
                }
            });
        }

        // Load subjects for search based on selected class
        function loadSearchSubjects() {
            var classEntered = $('#searchClass').val();
            $.ajax({
                url: 'ajax/getSubjects.php',
                method: 'GET',
                data: { class_entered: classEntered },
                dataType: 'json',
                success: function (data) {
                    if (data && Array.isArray(data.subjects)) {
                        populateSelect('#searchSubject', data.subjects);
                    } else {
                        console.log('Subjects data not in expected format', data);
                    }
                },
                error: function (xhr) {
                    console.log('Failed to load subjects for search:', xhr.responseText);
                }
            });
        }

        let currentPage = 1;
        const limit = 10; // Set the number of records per page

        // Load all records to display in the table
        function loadTableData(page = 1) {
            $.ajax({
                url: 'ajax/getAllRecords.php',
                method: 'GET',
                data: { page: page, limit: limit },
                dataType: 'json',
                success: function (data) {
                    populateTable(data.records);
                    setupPagination(data.total, data.page, data.limit);
                },
                error: function () {
                    console.log('Failed to load records');
                }
            });
        }

        function setupPagination(totalRecords, currentPage, limit) {
            const totalPages = Math.ceil(totalRecords / limit);
            const $pagination = $('#pagination');
            $pagination.empty();

            for (let i = 1; i <= totalPages; i++) {
                const $pageLink = $(`<a href="#" class="page-link">${i}</a>`);
                if (i === currentPage) {
                    $pageLink.addClass('active'); // Highlight current page
                }
                $pageLink.on('click', function (e) {
                    e.preventDefault();
                    loadTableData(i); // Load records for the selected page
                });
                $pagination.append($pageLink);
            }
        }

        // Submit the form for creating or updating records
        

function submitForm() {
    var examination = $('#examination').val();
    var class_entered = $('#class_entered').val();
    var subject_entered = $('#subject_entered').val();
    var Student_regno = $('#Student_regno').val();
    var student_marks = $('#student_marks').val();

    // Log the values to the console
    console.log('examination:', examination);
    console.log('class_entered:', class_entered);
    console.log('subject_entered:', subject_entered);
    console.log('Student_regno:', Student_regno);
    console.log('student_marks:', student_marks);

    // Check if required fields are filled
    if (!examination || !class_entered || !subject_entered || !Student_regno || !student_marks) {
        alert('Please fill all required fields.');
        return;
    }

    var formData = {
        examination: examination,
        class_entered: class_entered,
        subject_entered: subject_entered,
        Student_regno: Student_regno,
        student_marks: student_marks,
        record_id: $('#record_id').val()
    };

    var url = formData.record_id ? 'ajax/updateRecord.php' : 'ajax/insertRecord.php';

    $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            alert(response.message || 'Operation successful');
            loadTableData(currentPage);

            // Retain selected values in examination, class_entered, subject_entered
            $('#examination').val(examination).trigger('change');
            $('#class_entered').val(class_entered).trigger('change');
            $('#subject_entered').val(subject_entered).trigger('change');

            // Change Student_regno to the next option
            var $studentRegnoSelect = $('#Student_regno');
            var selectedIndex = $studentRegnoSelect.prop('selectedIndex');
            var nextIndex = selectedIndex + 1;

            // If there's a next option, select it; otherwise, reset to the first option
            if (nextIndex < $studentRegnoSelect.find('option').length) {
                $studentRegnoSelect.prop('selectedIndex', nextIndex).trigger('change');
            } else {
                $studentRegnoSelect.prop('selectedIndex', 0).trigger('change');
            }

            resetForm(); // If needed
        },
        error: function (xhr) {
            console.log('Error:', xhr.responseText);
            alert('Error occurred: ' + xhr.responseText);
        }
    });
}











        

// Function to reset the form (customize as needed)
function resetForm() {
    $('#student_marks').val(''); // Reset marks field or add others as necessary
    // Do not reset the select boxes to keep their values
}


        // Populate the select elements with data and pre-select a specific option if provided
        function populateSelect(selector, data, selectedValue) {
            var $select = $(selector);
            $select.empty();
            $select.append('<option value="">Select</option>');
            $.each(data, function (index, item) {
                // Adjust this line if your data structure differs
                $select.append('<option value="' + item.id + '">' + item.name + '</option>');
            });

            if (selectedValue) {
                $select.val(selectedValue).trigger('change');
            }
        }

        // Populate the table with records
        function populateTable(records) {
            var $tbody = $('#dataTable tbody');
            $tbody.empty();
            $.each(records, function (index, record) {
                $tbody.append(`
                    <tr>
                        <td>${record.examination}</td>
                        <td>${record.class_entered}</td>
                        <td>${record.subject_entered}</td>
                        <td>${record.Student_regno || 'N/A'}</td>
                        <td>${record.student_marks}</td>
                        <td>${record.date_entered}</td>
                        <td>
                            <i class="fas fa-edit btn btn-warning btn-sm" onclick="editRecord('${record.examination}', '${record.class_entered}', '${record.subject_entered}', '${record.Student_regno}', '${record.id}')"></i>
                            <i class="fas fa-trash btn btn-danger btn-sm" onclick="deleteRecord('${record.examination}', '${record.class_entered}', '${record.subject_entered}', '${record.Student_regno}')"></i>
                        </td>
                    </tr>
                `);
            });
        }

        // Edit a record and populate the form
        function editRecord(examination, class_entered, subject_entered, Student_regno, record_id) {
            $.ajax({
                url: 'ajax/getRecord.php',
                method: 'GET',
                data: {
                    examination: examination,
                    class_entered: class_entered,
                    subject_entered: subject_entered,
                    Student_regno: Student_regno
                },
                dataType: 'json',
                success: function (data) {
                    if (data.success && data.record) {
                        $('#examination').val(data.record.examination).trigger('change');
                        $('#class_entered').val(data.record.class_entered).trigger('change');
                        loadStudentNumbers(data.record.Student_regno);
                        $('#subject_entered').val(data.record.subject_entered).trigger('change');
                        $('#student_marks').val(data.record.student_marks);
                        $('#record_id').val(data.record.id);
                        $('#crudForm button[type="submit"]').html('<i class="fas fa-edit"></i>'); // Change button text to icon
                    } else {
                        alert('Failed to retrieve record: ' + (data.message || 'Unknown error'));
                    }
                },
                error: function () {
                    alert('Error retrieving record. Please try again.');
                }
            });
        }

        // Delete a record
        function deleteRecord(examination, class_entered, subject_entered, Student_regno) {
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    url: 'ajax/deleteRecords.php',
                    method: 'POST',
                    data: {
                        examination: examination,
                        class_entered: class_entered,
                        subject_entered: subject_entered,
                        Student_regno: Student_regno
                    },
                    dataType: 'json',
                    success: function (response) {
                        alert(response.message || 'Record deleted successfully');
                        loadTableData(currentPage); // Reload current page
                    },
                    error: function () {
                        console.log('Failed to delete record');
                        alert('Error deleting record. Please try again.');
                    }
                });
            }
        }

        // Reset form fields
        function resetForm() {
            $('#crudForm')[0].reset();
            $('#record_id').val('');
            $('#crudForm button[type="submit"]').html('<i class="fas fa-save"></i>'); // Reset button to save icon
        }

        // Search for records based on input
        function searchRecords() {
            var searchCriteria = {
                class_entered: $('#searchClass').val(),
                Student_regno: $('#searchStudent').val(),
                subject_entered: $('#searchSubject').val()
            };

            $.ajax({
                url: 'ajax/searchRecords.php',
                method: 'GET',
                data: searchCriteria,
                dataType: 'json',
                success: function (data) {
                    populateTable(data.records);
                },
                error: function () {
                    console.log('Failed to search records');
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
