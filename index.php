<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exo complet lecture SQL.</title>
</head>
<body>


<?php
$host = 'localhost';
$user = 'root';
$dbname = 'sql_197';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    echo "<h2>Clients list :</h2>";

    $stmt = $pdo->prepare("SELECT * FROM clients");
    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $client) {
            echo "<div>" . "Name : " . $client['lastName'] . "<br>" .
                "FirstName : " . $client['firstName'] . "<br>" .
                "BirthDay : " . $client['birthDate'] . "<br>" .
                "Card : " . $client['card'] . "<br>" .
                "Card number : " . $client['cardNumber'] . "</div>" . "<br>";
        }
    }
    echo "<br>" . "<hr>" .
        "<h2>Spectacle list :</h2>";

    $stmt = $pdo->prepare("SELECT * FROM shows");
    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $show) {
            echo "<div>" . "title :" . $show['title'] . "<br>" .
                "Artiste : " . $show['performer'] . "<br>" .
                "Date : " . $show['date'] . "<br>" .
                "ShowType : " . $show['showTypesId'] . "<br>" .
                "FirstGenres : " . $show['firstGenresId'] . "<br>" .
                "SecondGenre : " . $show['secondGenreId'] . "<br>" .
                "Duration : " . $show['duration'] . "<br>" .
                "StartTime : " . $show['startTime'] . "</div>" . "<br>";

        }
    }
    echo "<br>" . "<hr>" .
        "<h2>20 first clients :</h2>";

    $stmt = $pdo->prepare("SELECT * FROM clients WHERE id <= 20");
    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $client) {
            echo "<div>" . "number : " . $client['id'] . "<br>" .
                "Name : " . $client['lastName'] . "<br>" .
                "FirstName : " . $client['firstName'] . "</div>" . "<br>";
        }
    }
    echo "<br>" . "<hr>" .
        "<h2>clients have fidelity cards :</h2>";

    $stmt = $pdo->prepare("SELECT * FROM clients WHERE card = 1 ");
    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $cards) {
            echo "<div>" . $cards['lastName'] . " " . $cards['firstName'] . "</div>" . "<br>";
        }
    }
    echo "<br>" . "<hr>" .
        "<h2>clients alphabetiq M :</h2>";

    $stmt = $pdo->prepare("SELECT * FROM clients WHERE lastName LIKE 'M%'");
    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $nameM) {
            echo "<div>" . $nameM['lastName'] . " " . $nameM['firstName'] . "</div>" . "<br>";
        }
    }
    $stmt = $pdo->prepare("SELECT * FROM shows ORDER BY title");
    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $showtime) {
            echo "<div>" . "title : " . $showtime['title'] . "<br>" .
                "Performer : " . $showtime['performer'] . "<br>" .
                $showtime['date'] . " , " . $showtime['startTime'] . "</div>" . "<br>";
        }
    }
    $stmt = $pdo->prepare("SELECT * FROM clients");
    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $client) {
            echo "<div>" . "Name : " . $client['lastName'] . "<br>" .
                "Prénom : " . $client['firstName'] . "<br>" .
                "BirthDay : " . $client['birthDate'] . "<br>";
            if ($client['card'] === "1") {
                echo "Fidelity card : Yes" . "<br>" . "card number : " . $client['cardNumber'] . "</div>" . "<br>";
            } else {
                echo "Fidelity card : No" . "</div>" . "<br>";
            }
        }
    }
}

catch (Exception $error) {
    echo $error->getMessage();
}

    ?>

</body>
</html>
