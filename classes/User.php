<?php 

class User {

    private int $id;
    public string $login;
    private string $password;
    public string $email;
    public string $firstname;
    public string $lastname;


    public function __construct($login, $password, $email, $firstname, $lastname)
    {
        $this->login = $login;
        $this->setPassword($password);
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

        // Setter method for password to hash it before storing
        public function setPassword(string $password): void
        {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }
    
        // Getter method for password (optional, usually not needed)
        public function getPassword(): string
        {
            return $this->password;
        }

        

}


?>