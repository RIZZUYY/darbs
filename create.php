<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Izveidot jaunu jautājumu</title>
</head>
<body>
    <h1>Izveidot jaunu jautājumu</h1>

    <form action="create.php" method="post">
        <label for="question">Jautājuma teksts:</label>
        <input type="text" id="question" name="question" required>

        <label for="answer1">Atbilde 1:</label>
        <input type="text" id="answer1" name="answer1" required>

        <label for="answer2">Atbilde 2:</label>
        <input type="text" id="answer2" name="answer2" required>

        <label for="correctAnswer">Pareizā atbilde (1 vai 2):</label>
        <input type="number" id="correctAnswer" name="correctAnswer" min="1" max="2" required>

        <button type="submit">Izveidot jautājumu</button>
    </form>
</body>
</html>

<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $questionText = $_POST["question"];
    $answer1 = $_POST["answer1"];
    $answer2 = $_POST["answer2"];
    $correctAnswer = $_POST["correctAnswer"];


    $sql = "INSERT INTO questions (text) VALUES ('$questionText')";

    if ($conn->query($sql) === TRUE) {
        echo "Jautājums veiksmīgi pievienots!";

        $questionId = $conn->insert_id;


        $sqlAnswers = "INSERT INTO answers (text, question_id, is_correct) VALUES ";
        $sqlAnswers .= "('$answer1', $questionId, " . ($correctAnswer == 1 ? 1 : 0) . "), ";
        $sqlAnswers .= "('$answer2', $questionId, " . ($correctAnswer == 2 ? 1 : 0) . ")";

        if ($conn->query($sqlAnswers) === TRUE) {
            echo " Atbildes veiksmīgi pievienotas!";
        } else {
            echo "Kļūda pievienojot atbildes: " . $conn->error;
        }
    } else {
        echo "Kļūda pievienojot jautājumu: " . $conn->error;
    }
}

$conn->close();
?>
