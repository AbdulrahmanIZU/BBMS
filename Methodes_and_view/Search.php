<!DOCTYPE html>
<html>
<head>
    <title>Search Books</title>
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
            color: #dc3545;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Search Books</h1>
        <form method="post">
            <label for="searchTerm">Search by Title, Author, or ISBN:</label>
            <input type="text" id="searchTerm" name="searchTerm" required>
            <input type="submit" name="searchSubmit" value="Search">
        </form>

        <?php
if (isset($_POST['searchSubmit'])) {
    require_once 'library.php';

    $searchTerm = $_POST['searchTerm'];
    
    // Check if the search term is empty
    if (isset($_POST['searchSubmit'])) {
        require_once 'library.php';
    
        $searchTerm = $_POST['searchTerm'];
        
        // Check if the search term is empty
        if (empty($searchTerm)) {
            echo "<div class='result' style='color: red;'>Please fill the search bar.</div>";
        } else {
            $books = Books::searchBooks($searchTerm);
    
            if (empty($books)) {
                echo "<div class='result' style='color: red;'>No books found matching your search term: $searchTerm</div>";
            } else {
                echo "<h2>Search Results:</h2>";
                echo "<table>";
                echo "<tr><th>Title</th><th>Author</th><th>ISBN</th><th>Published Date</th><th>Price</th></tr>";
    
                foreach ($books as $book) {
                    echo "<tr>";
                    echo "<td>{$book['title']}</td>";
                    echo "<td>{$book['author']}</td>";
                    echo "<td>{$book['isbn']}</td>";
                    echo "<td>{$book['published_date']}</td>";
                    echo "<td>{$book['price']}</td>";
                    echo "</tr>";
                }
    
                echo "</table>";
            }
        }
    }
    
}
?>

    </div>
</body>
</html>
