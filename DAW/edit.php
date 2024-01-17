<?php
include 'conectare_bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preiați datele postate
    $edit_id = $_POST['edit_id'];

    if (isset($_POST['submit_oras'])) {
        $edit_oras = $_POST['edit_oras'];
        $sql = "UPDATE info_utilizatori SET oras='$edit_oras' WHERE id='$edit_id'";
    } elseif (isset($_POST['submit_nume'])) {
        $edit_nume = $_POST['edit_nume'];
        $sql = "UPDATE info_utilizatori SET nume='$edit_nume' WHERE id='$edit_id'";
    } elseif (isset($_POST['submit_adresa'])) {
        $edit_adresa = $_POST['edit_adresa'];
        $sql = "UPDATE info_utilizatori SET adresa='$edit_adresa' WHERE id='$edit_id'";
    } elseif (isset($_POST['submit_nr_tel'])) {
        $edit_nr_tel = $_POST['edit_nr_tel'];
        $sql = "UPDATE info_utilizatori SET nr_tel='$edit_nr_tel' WHERE id='$edit_id'";
    }

    // Executați interogarea pentru actualizare
    if ($conn->query($sql) === TRUE) {
        echo "Actualizare reușită!";
    } else {
        echo "Eroare la actualizare: " . $conn->error;
    }

    // Redirecționați înapoi la pagina cu tabelul
    header("Location: detalii_cont.php");
    exit();
}
?>
