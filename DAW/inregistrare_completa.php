<?php
session_start();
// Includerea fișierului de conexiune la baza de date
require_once 'conectare_bd.php';
    // Verificarea datelor trimise prin POST și procesarea lor
    $email = $_SESSION['mail'];
    if (isset($_POST) && !empty($_POST)) {
        // Verificarea dacă utilizatorul a bifat opțiunea de acord


        if ($_POST['agree'] == "on") {
            $oras = filter_var($_POST['oras'], FILTER_SANITIZE_STRING);
            $nume = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
            $adresa = filter_var($_POST['addresa'], FILTER_SANITIZE_STRING);
            $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
            
   // var_dump($oras,$nume, $adresa);
            // Use prepared statement for INSERT
            $isql = "INSERT INTO info_utilizatori (email, oras, nume, adresa, nr_tel) VALUES (?, ?, ?, ?,?)";echo 1;
            $stmt = mysqli_prepare($conn, $isql);echo 2;
            mysqli_stmt_bind_param($stmt, "sssss", $email, $oras, $nume, $adresa,$phone);echo 3;
            $ires = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($ires) {
                header('location: FirmaTransport.php');
			}
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>info_utilizatori</title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>

<section id="register-section" class="centered-section">
    <h2>Cont realizat cu succes!</h2>
	<h3>Completati datele de mai jos pentru a plasa o comanda</h3>
    <form method="post" >

        <label for="oras">Oras:</label>
			<select name="oras" id="oras" required>
            <option value="" disabled selected>Selecteaza un oras</option>
            <option value="Bucuresti">Bucuresti</option>
            <option value="Cluj-Napoca">Cluj-Napoca</option>
            <option value="Craiova">Craiova</option>
            <option value="Pitesti">Pitesti</option>
            <option value="Timisoara">Timisoara</option>
        </select><br>

        <label for="fname">Prenume:</label>
        <input type="text" name="fname" id="fname" required><br>

        <label for="lname">Nume:</label>
        <input type="text" name="lname" id="lname" required><br>

        <label for="addresa">Adresa:</label>
        <input type="text" name="addresa" id="addresa" required><br>

        <label for="phone">Numar de telefon:</label>
        <input type="tel" name="phone" id="phone" required><br>

        <label for="agree">Accept Termeni si conditii <input type="checkbox" name="agree" id="agree" value="on" required></label><br>

        <input type="submit" name="register_btn" >
    </form>
</section>

</body>
</html>
