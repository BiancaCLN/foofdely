<?php
session_start();
// Verifică dacă este o cerere POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once 'conectare_bd.php';
         // Interogare pentru a verifica dacă adresa de email există deja în baza de date
        // Preluarea adresei de email din formular
        $email = $_POST["email"];
    $checkEmailSql = "SELECT * FROM utilizatori WHERE email=?";
    $stmtCheckEmail = mysqli_prepare($conn, $checkEmailSql);
    mysqli_stmt_bind_param($stmtCheckEmail, "s", $email);
    mysqli_stmt_execute($stmtCheckEmail);
    $emailResult = mysqli_stmt_get_result($stmtCheckEmail);

    if ($emailResult && mysqli_num_rows($emailResult) > 0) {
        // Dacă emailul există deja, redirecționează către index cu un mesaj de eroare
        
        ?>
        <h2>Acest mail exista deja!</h2>
        <?php
    }
    else{
        // Generează un cod unic pentru link
        $resetCode = md5(uniqid(rand(), true));

        // Construiește link-ul de resetare
        $resetLink = "http://localhost/daw/registerpass.php?etoken=" . urlencode($resetCode);


        // În acest punct, ar trebui să stochezi $resetCode și $email în baza de date
         // Inserează tokenul și timestamp-ul în baza de date
        $insertTokenSql = "INSERT INTO token (email, token, timestamp) VALUES (?, ?, now())";
        $stmtInsertToken = mysqli_prepare($conn, $insertTokenSql);
    
        $x = mysqli_stmt_bind_param($stmtInsertToken, "ss", $email, $resetCode);
    //var_dump($x);
        $resultInsertToken = mysqli_stmt_execute($stmtInsertToken);
    //var_dump($resultInsertToken);
    if (!$resultInsertToken) {
        // Dacă există erori la inserarea tokenului, afișează eroarea
        die("Error inserting token: " . mysqli_error($conn));
    }
        // Trimite emailul cu link-ul de resetare
          // Închide statement-ul de inserare
        mysqli_stmt_close($stmtInsertToken);

    // Setează adresa de email în sesiune
        $_SESSION['mail'] = $email;


        require_once('mailer/mail_cod.php'); 
        
        //var_dump(function_exists("send_mail"));

        // Înlocuiește cu calea corectă către fișierul care conține funcția send_mail
        send_mail($email, $resetLink);
        // Poți adăuga o redirecționare către o pagină de succes sau afișa un mesaj
        header("Location: success.html");
}
}

