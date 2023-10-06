<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>

        .result {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
        }

        /* Success style */
        .success {
            background-color: #28a745;
            color: white;
        }

        /* Error style */
        .error {
            background-color: #dc3545;
            color: white;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        

        h1 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<?php
if (isset($_POST['signup'])) {
    // Handle form submission
    require_once 'library.php';

    $user = new Books();

    // Set book properties based on user input
    $user->setusername($_POST['username']);
    $user->setemail($_POST['email']);
    $user->setpassword($_POST['password']);
    

    if (!$user->existsInDatabaseUser()) {
        // If it doesn't exist, insert the new user into the database
        $user->signup();
        echo "<div class='result success'>Signup successful</div>";

        // Redirect to the signin page after a successful signup
        require_once 'signin.php';
        exit(); // Ensure that code execution stops after the redirect
    } else {
        echo "<div class='result error'>Signup failed. Please try again.</div>";
    }
}
?>

<div class="container">
    <h1>Signup</h1>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" name="signup" value="Signup">
    </form>
</div>

</body>

</html>

