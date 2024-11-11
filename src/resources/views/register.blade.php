<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Funanga registration</title>
</head>
<body style="background-image: url({{ asset('/images/3459424.jpg') }})">
<div class="container align-content-center vh-100">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    Register
                </div>
                <div class="card-body">
                    <form id="loginForm">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name and Surname">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                        <small id="emailHelp" class="form-text text-muted">Already have an account? Login <a href="/login">here</a> .</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Handles form submission
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            var email = $('#email').val();
            var password = $('#password').val();
            var rememberMe = $('#rememberMe').prop('checked');

            // Set data accordingly
            var data = {
                email: email,
                password: password,
                remember_me: rememberMe
            };

            // Send data via AJAX - relative route since in the same laravel project
            $.ajax({
                url: '/api/register',
                method: 'POST',
                data: data,
                success: function(response) {
                    // Use sweet alerts because they're more aesthetically pleasing
                    swal.fire({
                        title: 'Success',
                        text: `Hello, ${response.user.email} You are registered!`,
                        icon: 'success',
                    }).then(() => {
                        // After promise, redirect to login
                        window.location.href = '/login';
                    });
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        // Use the error message from the backend to show what went wrong
                        swal.fire({
                            title: 'Error',
                            text: xhr.responseJSON.message,
                            icon: 'error',
                        });
                    } else {
                        // Unexpected error
                        swal.fire({
                            title: 'Error',
                            text: 'Something has gone wrong. Please try again',
                            icon: 'error',
                        });
                    }
                }
            });
        });
    });
</script>
</body>
</html>
