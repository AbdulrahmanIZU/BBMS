<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Book</h1>
        <form method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="Ititle" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="Iauthor" required>

            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="Iisbn" required>

            <label for="published_date">Published Date:</label>
            <input type="date" id="published_date" name="Ipublished_date" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="Iprice" step="0.01" required>

            <input type="submit" name="Isubmit" value="Add Book">
        </form>

        <?php
        if (isset($_POST['Isubmit'])) {
            // Handle form submission
            require_once 'library.php';

            $newBook = new Books();

            // Set book properties based on user input
            $newBook->setTitle($_POST['Ititle']);
            $newBook->setAuthor($_POST['Iauthor']);
            $newBook->setIsbn($_POST['Iisbn']);
            $newBook->setPublishedDate($_POST['Ipublished_date']);
            $newBook->setPrice($_POST['Iprice']);

            if (!$newBook->existsInDatabase()) {
                // If it doesn't exist, insert the new book into the database
                $newBook->insert();
                echo "<p>New book has been inserted successfully with ID: " . $newBook->getIsbn() . "</p>";
                // Use PHP to set the refresh header
                
                // require_once 'refresh.php';
            } else {
                echo "<p class='error'>A book with the same ISBN already exists. No insertion performed.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
