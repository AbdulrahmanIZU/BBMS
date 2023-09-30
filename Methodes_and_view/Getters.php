<?php 

trait BookGetters {

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getPublishedDate() {
        return $this->published_date;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getusername($username) {
        $this->username = $username;
    }
    public function getemail($email) {
        $this->email = $email;
    }
    public function getpassword($password) {
        $this->password = $password;
    }
}

?>
