<!DOCTYPE html>
<html lang="en">
<title>RENTIX</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="assets/css/main.css" />

<link rel="shortcut icon" type="image/png" href="assets/img/P.png">
<link rel="stylesheet" href="assets/css/user.css">
<link rel="stylesheet" href="assets/w3css/w3.css">
</head>
<body class="is-preload">
        <nav class="navbar navbar-custom" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="index.php">
                        RENTIX </a>
                </div>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br>
        <footer id="footer">
            <div class="inner">
                <div class="container">
                    <h2>Admin SIGN IN</h2>
                    <form method="POST" action="adminsignin_process.php" onsubmit="return validateForm()" name="signin-form">

                        <br>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" id="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <form action='#' method='post' onsubmit="return do_login();" id="form1">
                            <input type='submit' name='submit' class="btn btn-success" value='Log in' />
                        </form>
                    </form>
                </div>
            </div>

            <script>
                function validateForm() {
                    let x = document.forms["signin-form"]["email"].value;
                    let y = document.forms["signin-form"]["password"].value;
                    if (x == "" && y == "") {
                        alert("fill out the form");
                        return false;
                    } else if (x == "") {
                        alert("email must be filled out");
                        return false;
                    } else if (y == "") {
                        alert("password must be filled out");
                        return false;
                    }
                    return true;
                }
            </script>
        <footer/>
</body>


</html>