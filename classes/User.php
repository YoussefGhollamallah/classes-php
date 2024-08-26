<?php


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Connexion à la base de données
    $db = new mysqli('localhost', 'root', 'root', 'classes');

    // Vérification si la connexion a réussi
    if ($db->connect_error) {
        die("La connexion à la base de données a échoué : " . $db->connect_error);
    }

    // Récupération des données du formulaire
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    // Création de l'objet User
    $user = new User($db, $login, $password, $email, $firstname, $lastname);

    // Tentative d'inscription de l'utilisateur
    if ($user->register()) {
        header("Location: ../pages/traitement.php?status=success");
    } else {
        header("Location: ../pages/traitement.php?status=error");
    }

    // Fermeture de la connexion à la base de données
    $db->close();
}

class User {

    private int $id;
    public string $login;
    private string $password;
    public string $email;
    public string $firstname;
    public string $lastname;
    private mysqli $db;

    public function __construct(mysqli $db,string $login, string $password, string $email, string $firstname, string $lastname)
    {
        $this->db = $db;
        $this->login = $login;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function setEmail(string $email): void {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new InvalidArgumentException("Invalid email address");
        }
    }
    
    // Méthode pour enregistrer un utilisateur dans la base de données
    public function register(): bool
    {
        // Vérification si le login ou l'email existe déjà dans la base de données
        $stmt = $this->db->prepare("SELECT id FROM utilisateurs WHERE login = ? OR email = ?");
        $stmt->bind_param("ss", $this->login, $this->email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // Un utilisateur avec ce login ou email existe déjà
            $stmt->close();
            return false;
        }
        
        // Insertion de l'utilisateur dans la base de données
        $stmt = $this->db->prepare("INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $this->login, $this->password, $this->email, $this->firstname, $this->lastname);
        
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

}

?>
