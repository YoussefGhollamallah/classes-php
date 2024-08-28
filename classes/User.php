<?php 

class User {

    private int $id;
    public string $login;
    private string $password;
    public string $email;
    public string $firstname;
    public string $lastname;
    private mysqli $db;

    public function __construct(mysqli $db, $login, $password, $email, $firstname, $lastname)
    {
        $this->db = $db;
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
        
        public function register(): bool
        {
            // Préparer la requête SQL pour insérer l'utilisateur
            $stmt = $this->db->prepare("INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)");
            
            if ($stmt === false) {
                die('Erreur de préparation de la requête : ' . $this->db->error);
            }
    
            // Lier les paramètres de la requête avec les propriétés de l'objet
            $stmt->bind_param("sssss", $this->login, $this->password, $this->email, $this->firstname, $this->lastname);
    
            // Exécuter la requête
            if ($stmt->execute()) {
                // Si l'insertion a réussi, retourner true
                return true;
            } else {
                // Sinon, afficher une erreur et retourner false
                echo "Erreur lors de l'inscription de l'utilisateur : " . $stmt->error;
                return false;
            }
        }
        

}


?>