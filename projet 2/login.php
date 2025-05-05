<?php
session_start();
$host = "localhost";
$user = "root";
$pass = " ";
$db = "newsletter";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) die("Erreur: " . $conn->connect_error);

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM comptes WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['mot_de_passe'])) {
    $_SESSION['user'] = $user['email'];
    echo "Connexion réussie";
} else {
    echo "Email ou mot de passe incorrect";
}
?>