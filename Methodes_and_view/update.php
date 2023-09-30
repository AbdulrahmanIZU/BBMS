<!DOCTYPE html>
<html>
<head>
    <title>Update Book</title>
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

        input[type="text"],
        input[type="number"],
        input[type="date"] {
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
        <h1>Update Book by ISBN</h1>
        <form method="post">
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="Uisbn" required>
            
            <label for="title">New Title:</label>
            <input type="text" id="title" name="Utitle" required>

            <label for="author">New Author:</label>
            <input type="text" id="author" name="Uauthor" required>

            <label for="published_date">New Published Date:</label>
            <input type="date" id="published_date" name="Upublished_date" required>

            <label for="price">New Price:</label>
            <input type="number" id="price" name="Uprice" step="0.01" required>

            <input type="submit" name="Usubmit" value="Update Book">
        </form>

        <?php
        if (isset($_POST['Usubmit'])) {
            // Handle form submission
            require_once 'library.php';

            $isbnToUpdate = $_POST['Uisbn'];

            $book = new Books();
            $book->setIsbn($isbnToUpdate);

            if ($book->existsInDatabase()) {
                // Update the book's properties based on user input
                $book->setTitle($_POST['Utitle']);
                $book->setAuthor($_POST['Uauthor']);
                $book->setPublishedDate($_POST['Upublished_date']);
                $book->setPrice($_POST['Uprice']);

                // Call the update method to save the changes
                $book->update();
                
                echo "<div class='result success'>Book with ISBN {$book->getIsbn()} has been updated successfully.</div>";
                // // Use PHP to set the refresh header
                // header("refresh: 2; url=yourpage.php");
                // require_once 'refresh.php';
            } else {
                echo "<div class='result error'>Book with ISBN {$isbnToUpdate} not found.</div>";
            }
        }

        ?>
    </div>
</body>
</html>
