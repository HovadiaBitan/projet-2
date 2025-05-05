<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$user = "root";
$pass = " ";
$db = "newsletter";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) die("Erreur: " . $conn->connect_error);

$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$email = strtolower(trim($_POST['email']));
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$check = $conn->prepare("SELECT id FROM comptes WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "❌ Cet email est déjà utilisé.";
    exit;
}

$sql = "INSERT INTO comptes (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $lastname, $firstname, $email, $password);
$stmt->execute();

$subject = "Bienvenue chez Bijouterie GM";
$message = "Bonjour $firstname,\nVotre compte client a été créé avec succès.";
$headers = "From: contact@bijouterie-gm.com";
mail($email, $subject, $message, $headers);

echo "✅ Compte créé avec succès, vous êtes maintenant connecté.";
?>
