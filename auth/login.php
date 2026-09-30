<?php

session_start();

include "../config/koneksi.php";

$error = "";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM admin
         WHERE username='$username'
         AND password='$password'"
    );

    if (mysqli_num_rows($query) > 0) {

        $admin = mysqli_fetch_assoc($query);

        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];

        // Setelah login langsung ke beranda
        header("Location: ../index.php");
        exit;

    } else {

        $error = "Username atau password salah.";

    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login Admin - Octarine</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            font-family: Arial, sans-serif;

            background-color: #f8f5f0;

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;
        }

        .login-container {
            width: 400px;

            background-color: white;

            padding: 40px;

            border-radius: 15px;

            box-shadow:
                0 5px 25px rgba(0,0,0,0.1);
        }

        .logo {
            text-align: center;

            font-size: 28px;

            font-weight: bold;

            letter-spacing: 4px;

            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;

            color: #777;

            margin-bottom: 30px;
        }

        label {
            display: block;

            margin-bottom: 8px;

            font-weight: bold;
        }

        input {
            width: 100%;

            padding: 13px;

            border: 1px solid #ddd;

            border-radius: 7px;

            margin-bottom: 18px;

            font-size: 14px;
        }

        .btn-login {
            width: 100%;

            padding: 13px;

            border: none;

            border-radius: 7px;

            background-color: #333;

            color: white;

            font-size: 15px;

            cursor: pointer;
        }

        .btn-login:hover {
            background-color: #555;
        }

        .error {
            background-color: #ffe5e5;

            color: #b00020;

            padding: 12px;

            border-radius: 6px;

            margin-bottom: 20px;

            text-align: center;
        }

        .back {
            display: block;

            text-align: center;

            margin-top: 20px;

            color: #666;

            text-decoration: none;

            font-size: 14px;
        }

    </style>

</head>


<body>


<div class="login-container">

    <div class="logo">
        OCTARINE
    </div>


    <div class="subtitle">
        Admin Login
    </div>


    <?php if ($error != "") { ?>

        <div class="error">
            <?php echo $error; ?>
        </div>

    <?php } ?>


    <form method="POST">

        <label>
            Username
        </label>

        <input
            type="text"
            name="username"
            placeholder="Masukkan username"
            required
        >


        <label>
            Password
        </label>

        <input
            type="password"
            name="password"
            placeholder="Masukkan password"
            required
        >


        <button
            type="submit"
            name="login"
            class="btn-login"
        >
            Login
        </button>

    </form>


    <a
        href="../index.php"
        class="back"
    >
        ← Kembali ke Website
    </a>

</div>


</body>

</html>