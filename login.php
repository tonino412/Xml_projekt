<?php
session_start();

// Provjera je li korisnik već prijavljen
if(isset($_SESSION['username'])) {
    // Ako je korisnik već prijavljen, preusmjeri ga na dobrodošlicu
    header("Location: welcome.php");
    exit;
}

// Provjera je li korisnik poslao prijavne podatke
if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Provjera korisničkog imena i lozinke iz XML datoteke
    $xml = simplexml_load_file('users.xml');

    foreach ($xml->user as $user) {
        if ($username == $user->username && $password == $user->password) {
            // Prijavljivanje uspješno, postavi korisničko ime u sesiju
            $_SESSION['username'] = $username;

            // Preusmjeri korisnika na dobrodošlicu
            header("Location: welcome.php");
            exit;
        }
    }

    // Pogrešno korisničko ime ili lozinka, prikaži poruku o grešci
    $error = "Pogrešno korisničko ime ili lozinka.";
}
?>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prijava</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
</head>
<body>
    <h1 class="mx-auto p-2" style="width: 200px;">Prijava</h1>

    

    <form method="POST" action="login.php" class="mx-auto p-2" style="width: 200px;">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="password" required><br>
        <br>
        <input type="submit" name="submit" value="Prijava">

    </form>
    <?php
    if(isset($error)) {
        echo '<p style="color: red; text-align:center;" ">' . $error . '</p>';
    }
    ?>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
