<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    
</head>
<body>
    <?php
session_start();
include("partials/header.php");
include("tools/db.php");


class UserLoginDTO {
    public $id;
    public $email;
    public $hashedPassword;
    public $role;

    public function __construct($id, $email, $hashedPassword, $role) {
        $this->id = $id;
        $this->email = $email;
        $this->hashedPassword = $hashedPassword;
        $this->role = $role;
    }
}

    


class AuthRepository {
    private mysqli $db;

    public function __construct(mysqli $db) {
        $this->db = $db;
    }

    public function findUserByEmail(string $email): ?UserLoginDTO {
    $stmt = $this->db->prepare("SELECT id, password, role FROM hráči WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashedPassword, $role);
        $stmt->fetch();
        return new UserLoginDTO($id, $email, $hashedPassword, $role);
    }

    return null;
}

    
}

class AuthService {
    private AuthRepository $repo;

    public function __construct(AuthRepository $repo) {
        $this->repo = $repo;
    }

    public function login(string $email, string $password): array {
        $user = $this->repo->findUserByEmail($email);
        if (!$user) {
            return ['error' => 'Email neexistuje.'];
        }

        if (!password_verify($password, $user->hashedPassword)) {
            return ['error' => 'Nesprávne heslo.'];
        }

        $_SESSION["user_id"] = $user->id;
        $_SESSION["email"] = $user->email;
        $_SESSION["role"] = $user->role;

       if ($user->role === 'admin') {
    header("Location: /Cyborg_gaming-main/Hraci.php");
}   else {
    header("Location: /Cyborg_gaming-main/profile.php");
}
exit;

        exit;
    }
}


$dbConnection = getDatabaseCennection();
$authService = new AuthService(new AuthRepository($dbConnection));

$login_error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $result = $authService->login($email, $password);
    if (isset($result['error'])) {
        $login_error = $result['error'];
    }
}
?>


<div class="login-container">
    <h2>Prihlasovanie</h2>
    <form method="POST" action="">
  <label for="email">Email:</label>
  <input type="email" name="email" required>
  <br><br>

  <label for="password">Heslo:</label>
  <input type="password" name="password" required>
  <br><br>
<?php if (!empty($login_error)): ?>
  <div style="color: red; margin-top: 10px; text-align: center;">
    <?php echo $login_error; ?>
  </div>
<?php endif; ?>

  <button type="submit">Prihlásiť</button>
</form>



    </div>
    
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>
  
</body>
</html>