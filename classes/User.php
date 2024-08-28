<?php

class User {

    private int $id;
    public string $login;
    private string $password;
    public string $email;
    public string $firstname;
    public string $lastname;
    private mysqli $db;

    public function __construct(mysqli $db,  $login = '', $password = '', $email = '', $firstname = '', $lastname = '')
    {
        $this->db = $db;
        $this->login = $login;
        $this->password = $password;  // Ne pas hacher le mot de passe ici
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
        // Hacher le mot de passe avant l'enregistrement
        $this->setPassword($this->password);
        
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
    
    public function connect(): bool
    {
        // Préparer la requête pour récupérer l'utilisateur avec prénom et nom
        $stmt = $this->db->prepare("SELECT id, password, firstname, lastname FROM utilisateurs WHERE login = ?");
        if ($stmt === false) {
            die('Erreur de préparation de la requête : ' . $this->db->error);
        }
        $stmt->bind_param('s', $this->login);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            // L'utilisateur existe, vérifier le mot de passe
            $stmt->bind_result($user_id, $hashed_password, $firstname, $lastname);
            $stmt->fetch();

            // Utiliser le mot de passe en clair pour vérifier le hachage
            if (password_verify($this->password, $hashed_password)) {
                // Connexion réussie
                $_SESSION['user_id'] = $user_id;           
                $_SESSION['login'] = $this->login;         
                $_SESSION['firstname'] = $firstname;       
                $_SESSION['lastname'] = $lastname;       
                
                return true;
            } else {
                return false; // Mot de passe incorrect
            }
        } else {
            return false; // Utilisateur non trouvé
        }
    }

    // Méthode pour mettre à jour les informations de l'utilisateur
    public function update($newLogin, $newPassword, $newEmail, $newFirstname, $newLastname): bool
    {
        // Vérifier si un nouveau mot de passe est fourni et le hacher si c'est le cas
        if (!empty($newPassword)) {
            $this->setPassword($newPassword);
        } else {
            $this->password = $this->getPassword(); // Garder l'ancien mot de passe si aucun nouveau mot de passe n'est fourni
        }

        // Préparer la requête SQL pour mettre à jour l'utilisateur
        $stmt = $this->db->prepare("UPDATE utilisateurs SET login = ?, password = ?, email = ?, firstname = ?, lastname = ? WHERE id = ?");
        
        if ($stmt === false) {
            die('Erreur de préparation de la requête : ' . $this->db->error);
        }

        // Lier les paramètres de la requête avec les nouvelles valeurs
        $stmt->bind_param("sssssi", $newLogin, $this->password, $newEmail, $newFirstname, $newLastname, $this->id);

        // Exécuter la requête
        if ($stmt->execute()) {
            // Si la mise à jour a réussi, mettre à jour les propriétés de l'objet
            $this->login = $newLogin;
            $this->email = $newEmail;
            $this->firstname = $newFirstname;
            $this->lastname = $newLastname;

            return true;
        } else {
            echo "Erreur lors de la mise à jour de l'utilisateur : " . $stmt->error;
            return false;
        }
    }
}
?>
