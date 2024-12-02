$(document).ready(function(){

    // create
    $("#addStudentForm").validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            dob: {
                required: true,
            },
            address: {
                required: true,
            },
            department_id: {
                required: true,
            },
        },
        messages: {
            first_name: {
                required: "Firstname field is required",
            },
            last_name: {
                required: "Lastname field is required",
            },
            dob: {
                required: "dob field is required",
            },
            address: {
                required: "address field is required",
            },
            department_id: {
                required: "department_id field is required",
            },
        },
    });

    $("#addStudentForm").on("submit", function (e) {
        if ($("#addStudentForm").valid()) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            var formData = new FormData(document.getElementById("addStudentForm"));

            $.ajax({
                url: $(this).attr("action"),
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == 1) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        window.location.href = "/students";
                       
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.message,
                            // footer: '<a href="#">Why do I have this issue?</a>'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = "";

                    if (errors) {
                        $.each(errors, function (key, value) {
                            errorMessage += value[0] + "<br>";
                        });
                    }

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                        footer: '<a href="#">Why do I have this issue?</a>',
                    });
                },
            });
        }
    });

    // edit
    $("#editStudentForm").validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            dob: {
                required: true,
            },
            address: {
                required: true,
            },
            department_id: {
                required: true,
            },
        },
        messages: {
            first_name: {
                required: "Firstname field is required",
            },
            last_name: {
                required: "Lastname field is required",
            },
            dob: {
                required: "dob field is required",
            },
            address: {
                required: "address field is required",
            },
            department_id: {
                required: "department_id field is required",
            },
        },
    });

    $("#editStudentForm").on("submit", function (e) {
        if ($("#editStudentForm").valid()) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            var formData = new FormData(document.getElementById("editStudentForm"));

            $.ajax({
                url: $(this).attr("action"),
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == 1) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        window.location.href = "/students";
                        // document.getElementById('rolesForm').reset();
                        // const table = $("#rolesTable").DataTable();
                        // table.clear().draw();
                        // table.destroy();

                        // getTableData("initial");
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.message,
                            // footer: '<a href="#">Why do I have this issue?</a>'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = "";

                    if (errors) {
                        $.each(errors, function (key, value) {
                            errorMessage += value[0] + "<br>";
                        });
                    }

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                        footer: '<a href="#">Why do I have this issue?</a>',
                    });
                },
            });
        }
    });
});

