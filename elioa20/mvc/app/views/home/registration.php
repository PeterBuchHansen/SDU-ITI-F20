<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Odin's Blog | Register</title>
    <link rel="stylesheet" type="text/css" href="/elioa20/mvc/public/css/registerStylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<form class="register-form" method="post">
    <div class="register-form-container">

        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>

        <ul id="register-messages">

        </ul>

        <label for="username"><b>Username</b>
            <input type="text" id="username" name="username" placeholder="Username...">
        </label>

        <label for="password"><b>Password</b>
            <input type="password" id="password" name="password1" placeholder="Password...">
        </label>


        <label for="password2"><b>Repeat Password</b>
            <input type="password" id="password2" name="password2" placeholder="Repeat password...">
        </label>

        <div class="register-button-container">
            <a href="/elioa20/mvc/public/home/index"><input type="button" id="login" name="login" value="Log In"></a>
            <input type="button" id="register" name="register" value="Register">
        </div>
    </div>
</form>

<script type="text/javascript" src="/elioa20/mvc/public/js/register.js"></script>
</body>
</html>