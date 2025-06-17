<?php
class Auth {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public function isAdmin(): bool {
    return isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'admin';
}




    public function logout() {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    public function isLoggedIn(): bool {
        return isset($_SESSION['user_id']);
    }

    public function getUserId(): ?int {
        return $_SESSION['user_id'] ?? null;
    }

}