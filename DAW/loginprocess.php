<?php
// Pornirea sesiunii PHP.
session_start();
// Verificarea dacă datele POST au fost trimise și nu sunt goale.
if(isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])){

    // Includerea fișierului de conectare la baza de date.
    require_once 'conectare_bd.php'; 

    // Filtrarea și sanitizarea adresei de email.
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Extrage parola din datele trimise prin POST.
    $password = $_POST['password'];

    // Interogarea pentru a selecta un utilizator pe baza adresei de email.
    $sql = "SELECT id, parola, active FROM utilizatori WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
	echo 25345;
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Numărul de rânduri returnate de interogare.
    $count = mysqli_num_rows($result);

    // Extrage datele utilizatorului.
    $r = mysqli_fetch_assoc($result);
	var_dump($count, $password, $r['parola'], $r['active'] );
	var_dump(password_verify($password, $r['parola']));
    // Verifică dacă parola este corectă și contul este activ.
    if(password_verify($password, $r['parola']) && $r['active'] == 1){
        // Setează variabilele de sesiune pentru utilizator.
        $_SESSION['customer'] = $email;
        $_SESSION['customerid'] = $r['id'];

        // Redirecționează utilizatorul către pagina home.php.
        header("location: FirmaTransport.php");
        exit(); // Asigură-te că oprești execuția scriptului după redirecționare.
    } else {
        // Redirecționează utilizatorul către pagina index.php cu mesaj de eroare.
		if($r['active'] == 0)
        echo "contul nu este activat.";
		else{
			echo "parola incorecta";
		}

    }

    // Închide statement-ul.
    mysqli_stmt_close($stmt);
    
    // Închide conexiunea la baza de date.
    mysqli_close($conn);

} else {
    // Redirecționează utilizatorul către pagina index.php cu mesaj de eroare.
    echo "Datele de autentificare lipsesc sau sunt incomplete.";
}

