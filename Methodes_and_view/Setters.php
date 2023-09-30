<?php
trait BookSetters {
    
    // id is primary key

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function setPublishedDate($published_date) {
        $this->published_date = $published_date;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setusername($username) {
        $this->username = $username;
    }
    public function setemail($email) {
        $this->email = $email;
    }
    public function setpassword($password) {
        $this->password = $password;
    }


}
?>
