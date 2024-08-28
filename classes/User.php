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

        // Setter pour l'ID
        public function setId(int $id): void
        {
            $this->id = $id;
        }
    
        // Getter pour l'ID
        public function getId(): int
        {
            return $this->id;
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


    // Charger les informations utilisateur
    public function loadUserData(): void
    {
        $stmt = $this->db->prepare("SELECT login, email, firstname, lastname FROM utilisateurs WHERE id = ?");
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        $stmt->bind_result($this->login, $this->email, $this->firstname, $this->lastname);
        $stmt->fetch();
        $stmt->close();
    }

    public function update(int $userId, $newLogin, $newPassword, $newEmail, $newFirstname, $newLastname): bool
    {
        // Si un nouveau mot de passe est fourni, le hacher
        if (!empty($newPassword)) {
            $this->setPassword($newPassword);
        } else {
            // Si aucun nouveau mot de passe n'est fourni, conserver l'ancien mot de passe
            $stmt = $this->db->prepare("SELECT password FROM utilisateurs WHERE id = ?");
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $stmt->bind_result($oldPassword);
            $stmt->fetch();
            $this->password = $oldPassword;
            $stmt->close();
        }
        $sql = "UPDATE utilisateurs SET login = ?, email = ?, firstname = ?, lastname = ?";

        // Ajouter la mise à jour du mot de passe si fourni
        if (!empty($newPassword)) {
            $this->setPassword($newPassword);
            $sql .= ", password = ?";
        }
    
        $sql .= " WHERE id = ?";
    
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            die('Erreur de préparation de la requête : ' . $this->db->error);
        }
    
        // Définir les types de paramètres pour la requête
        $types = "ssss";
        if (!empty($newPassword)) {
            $types .= "s";
        }
        $types .= "i";
    
        // Préparer les paramètres pour la requête
        $params = [$newLogin, $newEmail, $newFirstname, $newLastname];
        if (!empty($newPassword)) {
            $params[] = $this->password;
        }
        $params[] = $userId;
    
        // Lier les paramètres de la requête
        $stmt->bind_param($types, ...$params);
    
        // Exécuter la requête
        if ($stmt->execute()) {
            // Mettre à jour les propriétés de l'objet
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
