<!DOCTYPE html>
<html>
<head>
    <title>Delete Book</title>
    <style>
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

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #dc3545;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #c82333;
        }

        .result {
            text-align: center;
            margin-top: 20px;
        }

        .success {
            color: #28a745;
        }

        .error {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Book by ISBN</h1>
        <form method="post">
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="Disbn" required>
            <input type="submit" name="submit" value="Delete Book">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Handle form submission
            require_once 'library.php';

            $isbnToDelete = $_POST['Disbn'];

            $book = new Books();
            $book->setIsbn($isbnToDelete);

            if ($book->existsInDatabase()) {
                $book->delete();
                echo "<div class='result success'>Book with ISBN {$book->getIsbn()} has been deleted successfully.</div>";
                // // Use PHP to set the refresh header
                // header("refresh: 2; url=yourpage.php");
                // require_once 'refresh.php';
            } else {
                echo "<div class='result error'>Book with ISBN {$isbnToDelete} not found.</div>";
            }
        }
    
        ?>
    </div>
</body>
</html>
