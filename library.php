<?php 
require 'database_connection/DB.php';
require 'Methodes_and_view/Getters.php';
require 'Methodes_and_view/Setters.php';


class Books
{
    use BookGetters;
    use BookSetters;

    public $id;
    public $title;
    public $author;
    public $isbn;
    public $published_date;
    public $price;
    
    public $username;
    public $email;
    public $password;

    public function __construct($id = null)
    {
        if ($id) {
            $this->id = $id;
            $this->find();
        }
    }

    public function find()
    {
        $pdo = DB::connect();
        $stmt = $pdo->prepare('SELECT * FROM books WHERE id =?');
        $stmt->execute([$this->id]);
        $bookData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($bookData) {
            return new Books(
                $bookData[0]['title'],
                $bookData[0]['author'],
                $bookData[0]['isbn'],
                $bookData[0]['published_date'],
                $bookData[0]['price']
            );
        } 
        else {
            // Book not found
            return null; 
        }
    }

    public function existsInDatabase()
    {
        $pdo = DB::connect();
        $stmt = $pdo->prepare('SELECT id FROM books WHERE isbn = ? LIMIT 1');
        $stmt->execute([$this->isbn]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // If a record with the same isbn exists, return true; otherwise, return false.
        return $result !== false;
    }

    public function existsInDatabaseUser()
    {
        $pdo = DB::connect();
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ? or email = ? LIMIT 1');
        $stmt->execute([$this->username , $this->email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // If a record with the same isbn exists, return true; otherwise, return false.
        return $result !== false;
    }

    public static function getAll()
    {
        $pdo = DB::connect();
        $stmt = $pdo->prepare("SELECT * FROM books");
        $stmt->execute();
        

        // foreach ($stmt as $book) {
        //     echo '<tr>';
        //     echo '<td>' . $book['title'] . '</td>';
        //     echo '<td>' . $book['author'] . '</td>';
        //     echo '<td>' . $book['isbn'] . '</td>';
        //     echo '<td>' . $book['published_date'] . '</td>';
        //     echo '<td>' . $book['price'] . '</td>';
        //     echo '</tr>';
        // }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function searchBooks($searchTerm) {
        // Minimum length for search term (adjust as needed)
        $minSearchTermLength = 2;
    
        if (strlen($searchTerm) < $minSearchTermLength) {
            return []; // Return an empty array if search term length is less than the minimum
        }
    
        $pdo = DB::connect();
        $stmt = $pdo->prepare("SELECT * FROM books WHERE title LIKE ? OR author LIKE ? OR isbn LIKE ?");
        $searchTerm = "%$searchTerm%"; // Adding wildcards for partial search
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

    public function insert()
    {
        $pdo = DB::connect();
        $stmt = $pdo->prepare("INSERT INTO books (title, author, isbn, published_date, price) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$this->title, $this->author, $this->isbn, $this->published_date, $this->price]);

    }

    public function update()
    {
        $pdo = DB::connect();    
        $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ?, published_date = ?, price = ? WHERE isbn = ?");
        $stmt->execute([$this->title, $this->author, $this->published_date, $this->price, $this->isbn]);
    }


    public function delete()
    {
        $pdo = DB::connect();
        $stmt = $pdo->prepare("DELETE FROM books WHERE isbn = ?");
        $stmt->execute([$this->isbn]);
    }
    
    public function signup()
    {
        $pdo = DB::connect();
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$this->username, $this->email, $this->password]);

    }

    public function signin()
    {
        $pdo = DB::connect();
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$this->username, $this->email, $this->password]);

        if ($stmt->rowCount() > 0) {
            // User exists with the provided username or email and password
            return true;
        } else {
            // No matching user found
            return false;
        }

    }

}

?>