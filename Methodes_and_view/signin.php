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
    <div class="container">
        <h1>Signup</h1>
        

        <?php 
        if (isset($_POST['signin'])) {
            // Handle form submission
            require_once 'library.php';

            $user = new Books();

            // Set book properties based on user input
            $user->getusername($_POST['username']);
            $user->getemail($_POST['email']);
            $user->getpassword($_POST['password']);

            if (!$user->existsInDatabaseUser()) {
                // If it doesn't exist, insert the new book into the database
                $user->signin();
                echo "<div class='result success'>Signin successful</div>";
                // Use PHP to set the refresh header
                require_once 'home.php';
                // require_once 'refresh.php';
            } else {
                echo "<div class='result error'>Signin failed. Please try again.</div>";
            }
        }


        ?>

        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="password">Password again:</label>
            <input type="password" id="password" name="2password" required><br>

            <input type="submit" name="signin" value="signin">
        </form>
    </div>
</body>

</html>

