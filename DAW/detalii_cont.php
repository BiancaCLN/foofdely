<?php
include 'conectare_bd.php';
session_start();
$email=$_SESSION['customer'];
$sql = "SELECT * FROM info_utilizatori WHERE email='$email'ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="styless.css">
</head>
<body><header>
<h1>User Information</h1>
</header>
<table>
    <tr>
        <th>Email</th>
        <th>Oras</th>
        <th>Nume</th>
        <th>Adresa</th>
        <th>Numar de telefon</th>
    </tr>
    

    <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td><form action='edit.php' method='post'>
                    <input type='text' name='edit_oras' value='" . $row["oras"] . "'>
                    <input type='hidden' name='edit_id' value='" . $row["id"] . "'>
                    <button type='submit' name='submit_oras'>Edit</button>
                </form>
            </td>";
        echo "<td><form action='edit.php' method='post'>
                    <input type='text' name='edit_nume' value='" . $row["nume"] . "'>
                    <input type='hidden' name='edit_id' value='" . $row["id"] . "'>
                    <button type='submit' name='submit_nume'>Edit</button>
                </form>
            </td>";
        echo "<td><form action='edit.php' method='post'>
                    <input type='text' name='edit_adresa' value='" . $row["adresa"] . "'>
                    <input type='hidden' name='edit_id' value='" . $row["id"] . "'>
                    <button type='submit' name='submit_adresa'>Edit</button>
                </form>
            </td>";
        echo "<td><form action='edit.php' method='post'>
                    <input type='text' name='edit_nr_tel' value='" . $row["nr_tel"] . "'>
                    <input type='hidden' name='edit_id' value='" . $row["id"] . "'>
                    <button type='submit' name='submit_nr_tel'>Edit</button>
                </form>
            </td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}
?>


</table>
<section id="centered-section" class="centered-section">
    <form method="post" action="FirmaTransport.php">
        <input type="submit" value="Inapoi la site">
    </form>
</section>
</body>

    <footer>
        <p>&copy; 2024 Firma de Transport</p>
    </footer>
</html>