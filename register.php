<!DOCTYPE html>
<html lang="en">
<head>
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
include "tools/db.php";


class User {
    public $firstName;
    public $lastName;
    public $email;
    public $password;

    public function __construct($firstName, $lastName, $email, $password) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }

    public function hashPassword() {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }
}

class UserRepository {
    private $db;

    public function __construct(mysqli $db) {
        $this->db = $db;
    }

    public function emailExists($email) {
        $stmt = $this->db->prepare("SELECT id FROM hráči WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function save(User $user) {
        $stmt = $this->db->prepare("INSERT INTO hráči (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $hashedPassword = $user->hashPassword();
        $stmt->bind_param("ssss", $user->firstName, $user->lastName, $user->email, $hashedPassword);
        $stmt->execute();
        return $this->db->insert_id;
    }
}

class RegistrationController {
    private $userRepo;

    public function __construct(UserRepository $repo) {
        $this->userRepo = $repo;
    }

    public function register($post) {
        $errors = [];

        $firstName = $post['first_name'] ?? '';
        $lastName = $post['last_name'] ?? '';
        $email = $post['email'] ?? '';
        $password = $post['password'] ?? '';

        if ($this->userRepo->emailExists($email)) {
            $errors['email'] = "Email existuje";
            return ['errors' => $errors, 'data' => compact('firstName', 'lastName', 'email')];
        }

        $user = new User($firstName, $lastName, $email, $password);
        $id = $this->userRepo->save($user);

        $_SESSION["id"] = $id;
        $_SESSION["first_name"] = $user->firstName;
        $_SESSION["last_name"] = $user->lastName;
        $_SESSION["email"] = $user->email;

        header("Location: /Cyborg_gaming-main/index.php");
        exit;
    }
}


$first_name = $last_name = $email = "";
$first_name_error = $last_name_error = $email_error = $password_error = "";

$db = getDatabaseCennection();
$controller = new RegistrationController(new UserRepository($db));

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $result = $controller->register($_POST);

    if (isset($result['errors'])) {
        $email_error = $result['errors']['email'] ?? '';
        $first_name = $result['data']['firstName'];
        $last_name = $result['data']['lastName'];
        $email = $result['data']['email'];
    }
}
?>


    <div class="registration-form">
        <h2>Registrácia</h2>
        <form action="register.php" method="post">
            <label for="firstname">Meno:</label>
            <input type="text" id="first_name" name="first_name" required value="<?php echo $first_name ?>">
            <span class ="text-danger"><?php echo $first_name_error ?></span>

            <label for="lastname">Priezvisko:</label>
            <input type="text" id="last_name" name="last_name" required value="<?php echo $last_name ?>">
            <span class ="text-danger"><?php echo $last_name_error ?></span>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?php echo $email ?>">
            <span class ="text-danger"><?php echo $email_error ?></span>

            <label for="password">Heslo:</label>
            <input type="password" id="password" name="password" required>
            <span class="text-danger"><?php echo $password_error ?></span>


            <button type="submit">Zaregistrovať sa</button>
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
