<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            margin: 10px;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Book List</h1>
        <table>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Published Date</th>
                <th>Price</th>
            </tr>
            <?php
            // Include your Books class and get book data
            require 'library.php';
            $books = new Books();

            $bookData = $books->getAll();

            foreach ($bookData as $book) {
                echo '<tr>';
                echo '<td>' . $book['title'] . '</td>';
                echo '<td>' . $book['author'] . '</td>';
                echo '<td>' . $book['isbn'] . '</td>';
                echo '<td>' . $book['published_date'] . '</td>';
                echo '<td>' . $book['price'] . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</body>
</html>
