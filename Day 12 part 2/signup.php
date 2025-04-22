<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="signup">
        <form action="register.php" class="form-signin" method="post">
            <h1 class="h3 mb-3-weight-normal">Please sign up</h1>

            <label for="inputEmail" class="sr-only mt-3">Name</label>
            <input type="text" id="inputEmail" class="form-control" placeholder="Name" name="name" required autofocus>

            <label for="inputEmail" class="sr-only mt-3">Surname</label>
            <input type="text" id="inputPassword" class="form-control" placeholder="Name" name="surname" required autofocus>

            <label for="inputEmail" class="sr-only mt-3">Username</label>
            <input type="text" id="inputPassword" class="form-control" placeholder="Name" name="username" required autofocus>

            <label for="inputEmail" class="sr-only mt-3">Email</label>
            <input type="text" id="inputEmail" class="form-control" placeholder="Name" name="email" required autofocus>

            <label for="inputEmail" class="sr-only mt-3">Password</label>
            <input type="text" id="inputPassword" class="form-control" placeholder="Name" name="password" required autofocus>


            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="submit">Sign up</button>



            <small> have account? <a href="login.php">Log in</a></small>
            <p class="mt-5 mb-3 text-muted">Digital school &copy; 2025</p>


        </form>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>