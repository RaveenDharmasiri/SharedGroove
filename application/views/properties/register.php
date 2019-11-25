<!DOCTYPE html>

<html>

<head>
    <title>SharedGroove - Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/register-login.css'); ?>" />

</head>

<body class="text-center">
    <form class="form-signin" action='<?php echo base_url('/index.php/UserManagementController/insertUser'); ?>' method="POST">
        <h1 class="h3 mb-3 font-weight-sitename">SharedGroove</h1>
        <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>

        <label for="inputEmail" class="sr-only">First name</label>
        <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First name" required autofocus>

        <label for="inputEmail" class="sr-only">Last name</label>
        <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last name" required autofocus>

        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        
        <!-- Displaying the error message -->
        <?php
        if (isset($errorMessage)) {
            echo "<label>".$errorMessage."</label>";
        }
        ?>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

        <div class="register-link">
            <label>Already a member? <a href="<?php echo site_url('NavigationController/showLogin'); ?>"> Login </a></label>
        </div>
    </form>
</body>

</html>