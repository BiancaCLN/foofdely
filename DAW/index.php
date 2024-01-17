
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma de Transport</title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>

    <header>
        <h1>Firma de Transport</h1>
        <nav>
            <ul>
                <li><a href="#home">Acasă</a></li>
                <li><a href="#menu">Meniu</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="register.html">Register</a></li>
            </ul>
        </nav>
    </header>

    <section id="home">
        <h2>Bine ați venit la serviciul nostru de livrare a mâncărurilor</h2>
        <p>Bucurați-vă de mâncăruri delicioase livrate la ușa dvs.!</p>
        <a href="#menu" class="btn">Explorează Meniul</a>
    </section>
    <section id="menu">
        <h2>Meniul Nostru</h2>
        <div class="menu-item">
            <img src="https://2mnu.com/nicaragua/kiopos/public/images/slider/1697729000.jpg" alt="Articol alimentar 1">
            <h3>Pizza Hut</h3>
            <span>45 lei</span>
        </div>

        <div class="menu-item">
            <img src="https://tazzcdn.akamaized.net/uploads/cover/coverburgr_2_1_1.jpg" alt="Articol alimentar 2">
            <h3>Burger Factory</h3>
            <span>35 lei</span>
        </div>

    <section id="contact" class="centered-section">
    <h2>Contactează-ne</h2>
    <form action="mailer/process_form.php" method="post">
        <label for="nume">Nume:</label>
        <input type="text" id="nume" name="nume" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="mesaj">Mesaj:</label>
        <textarea id="mesaj" name="mesaj" required></textarea>

        <input type="submit" value="Trimite Mesaj">
    </form>
</section>
    </section>

    </section>

    

    <?php
    include('conectare_bd.php');
    // Începe sesiunea
    session_start();
    ?>

    <footer>
        <p>&copy; 2024 Firma de Transport</p>
    </footer>

</body>
</html>