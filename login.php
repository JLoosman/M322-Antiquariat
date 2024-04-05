<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/login.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <div class="hero">
        <?php include("header.php") ?>
        <div class="center">
            <div class="login-form">
                <h1>Login</h1>
                <form action="">
                    <input placeholder="Benutzername..." type="text">
                    <input placeholder="Passwort..."type="text">
                    <button>Login</button>
                </form>
                <div class="options">
                    <a href="">Passwort vergessen?</a>
                    <a href="register.php">Registrieren</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>