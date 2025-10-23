<?php
session_start();
require_once 'db.php'; // Ensure this file correctly establishes a PDO connection as $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);

    if (empty($username)) {
        echo "<script>alert('Username is required.');</script>";
    } else {
        try {
            $query = "SELECT id, username FROM users WHERE username = :username LIMIT 1";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                echo "<script>
                        alert('Login successful! Redirecting to the home page...');
                        window.location.href = 'home/index.html';
                      </script>";
                exit;
            } else {
                echo "<script>alert('No user found with the provided username.');</script>";
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            echo "<script>alert('Something went wrong. Please try again later.');</script>";
        }
    }
}
?>
