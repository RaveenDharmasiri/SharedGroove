<!DOCTYPE html>

<html>

<head>
    <title>SharedGroove - Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/register-login.css'); ?>" />

</head>

<body class="text-center">
    <form class="form-signin" action="/SharedGroove/index.php/UserManagementController/findUser" action="GET">
        <h1 class="h3 mb-3 font-weight-sitename">SharedGroove</h1>
        <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
        
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

        <?php
        if (isset($errorMessage)) {
            echo "<label>".$errorMessage."</label>";
        }
        ?>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        
        <div class="register-link">
            <label>Not a member? <a href="<?php echo site_url('NavigationController/showRegister'); ?>"> Register </a></label>
        </div>
    </form>
</body>

</html>