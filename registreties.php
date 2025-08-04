<?php
ob_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
ini_set('display_errors', 1);
error_reporting(E_ALL);
// PHP mailer nestrādā, bet var uztaisīt kontu tāpat.
include("database.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$registration_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = strtolower(trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL)));
    $password = $_POST["password"];

    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        echo "All fields are required.";
    } else {
        $check_stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE TRIM(LOWER(email)) = ?");
        mysqli_stmt_bind_param($check_stmt, "s", $email);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            echo "Error: That email is already registered.";
            mysqli_stmt_close($check_stmt);
        } else {
            mysqli_stmt_close($check_stmt);

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $registration_date = date("Y-m-d H:i:s");
            $verification_code = bin2hex(random_bytes(16));

            $stmt = mysqli_prepare($conn, "INSERT INTO users (first_name, last_name, email, password, registration_date, verification_code) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssss", $first_name, $last_name, $email, $hash, $registration_date, $verification_code);

                if (mysqli_stmt_execute($stmt)) {
                    $mail = new PHPMailer(false);
                    try {
    /*
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'yourgmail@gmail.com';
    $mail->Password = 'your_app_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('yourgmail@gmail.com', 'REDVI Registration');
    $mail->addAddress($email, $first_name);
    $mail->Subject = 'Verify your REDVI account';
    $mail->Body = "Hello $first_name,\n\nVerify your account:\nhttp://localhost/redvi-main/verify.php?code=$verification_code&email=" . urlencode($email);

    $mail->send();
    */
                    } catch (Exception $e) {
                        error_log("Mailer error: " . $mail->ErrorInfo);
                    }

                    header("Location: register.php?success=1");
                    exit();
                } else {
                    echo "Error during registration: " . mysqli_stmt_error($stmt);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Database error: Unable to prepare statement.";
            }
        }
        mysqli_close($conn);
    }
}

ob_end_flush(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
<?php if (isset($_GET['success'])): ?>
    <script>alert("Registration successful! Please check your email.");</script>
<?php endif; ?>

<div class="registration-form-container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h2>REDVI Registration</h2>
      First Name:<br>
      <input type="text" name="first_name" required><br>
      Last Name:<br>
      <input type="text" name="last_name" required><br>
      Email:<br>
      <input type="email" name="email" required><br>
      Password:<br>
      <input type="password" name="password" required><br>
      <button type="submit" name="submit">Register</button>
  </form>
</div>

<script>
  document.querySelector("form").addEventListener("submit", function () {
    document.querySelector("button[type='submit']").disabled = true;
  });
</script>
</body>
</html>
