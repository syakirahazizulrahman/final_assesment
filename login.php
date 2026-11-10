<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($email == "admin@gmail.com" && $password == "admin123") {

        $_SESSION["admin"] = true;

        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: Arial;
        }

        .login-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            border: 1px solid black;
            padding: 30px;
            width: 300px;
            text-align: center;
        }

        input {
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
        }

        footer {
            width: 100%;
        }

        footer hr {
            border: 0;
            border-top: 1px solid black;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="login-box">

            <h2>Admin Login</h2>

            <?php
            if ($error != "") {
                echo "<p>$error</p>";
            }
            ?>

            <form method="POST" action="">

                <label>Email:</label><br><br>
                <input type="email" name="email" required><br><br>

                <label>Password:</label><br><br>
                <input type="password" name="password" required><br><br>

                <button type="submit">Login</button>

            </form>

        </div>

    </div>

    <?php include 'footer.php'; ?>

</body>

</html>