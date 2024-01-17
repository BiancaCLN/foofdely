<?php
// Verifică dacă emailul este setat în sesiune și nu este gol
session_start();
if (!isset($_SESSION['mail']) || empty($_SESSION['mail'])) {
    header("location: registerprocess.php");
} else {
    // Încarcă fișierele necesare
    require_once 'conectare_bd.php';
    // Verifică dacă formularul a fost trimis
    if (isset($_POST) && !empty($_POST)) {
        // Hash parola primită din formular
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_SESSION['mail'];
        $token = $_GET['etoken'];
        //var_dump($token);
        // Interogare pentru a verifica validitatea tokenului
        $checkTokenSql = "SELECT timestamp FROM token WHERE email=? AND token=?";
        $stmt = mysqli_prepare($conn, $checkTokenSql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $token);
        mysqli_stmt_execute($stmt);
        $tokenResult = mysqli_stmt_get_result($stmt);
        
        if ($tokenResult && mysqli_num_rows($tokenResult) > 0) {
            // Dacă tokenul este valid, verifică timpul de valabilitate
            
            $row = mysqli_fetch_assoc($tokenResult);
            $timestampFromDB = $row['timestamp'];
            $dbDateTime = new DateTime($timestampFromDB);
            $currentDateTime = new DateTime();
            $interval = $currentDateTime->getTimestamp() - $dbDateTime->getTimestamp();
            $validityPeriod = 600; // 10 minute în secunde
            
            if ($interval <= $validityPeriod) {
                // Dacă tokenul este încă valid, inserează parola în baza de date
                $usql = "INSERT INTO utilizatori (email, parola, active, rol) VALUES (?, ?, ?, 'user')";
                $active = 1;
                $stmt = mysqli_prepare($conn, $usql);
                mysqli_stmt_bind_param($stmt, "ssi", $email, $password, $active);  // Ordinea parametrilor a fost schimbată aici
                
                $ures = mysqli_stmt_execute($stmt);echo 232;
                if ($ures) {
                    // Dacă inserarea a reușit, obține ID-ul și setează-l în sesiune
                    $id = mysqli_insert_id($conn);
                    header("location: inregistrare_completa.php");
                } else {
                    die("Error inserting password: " . mysqli_error($conn));
                }
            } else {
                die("Reset token has expired");
            }
        } else {
            die("Invalid reset token");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>

<section id="register-section" class="centered-section">
    <h2>Register</h2>
    <form method="post" id="register" >

        <label for="register-email">Parola:</label>
        <input type="password" name="password" id="register-pass" required><br>

        <input type="submit" form="register" name="register_btn" value="Register">
    </form>
</section>

</body>
</html>




