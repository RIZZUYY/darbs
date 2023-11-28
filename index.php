<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Jautājumu saraksts</title>
</head>
<body>
    <h1>Jautājumu saraksts</h1>

    <?php
    include 'db.php'; 


    $sql = "SELECT * FROM questions";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "<p>Jautājums: " . $row["text"] . "</p>";


            $questionId = $row["id"];
            $sqlAnswers = "SELECT * FROM answers WHERE question_id = $questionId";
            $resultAnswers = $conn->query($sqlAnswers);

            if ($resultAnswers->num_rows > 0) {
                echo "<ul>";
                while ($rowAnswer = $resultAnswers->fetch_assoc()) {
                    $isCorrect = ($rowAnswer["is_correct"] == 1) ? " (Pareiza atbilde)" : "";
                    echo "<li>Atbilde: " . $rowAnswer["text"] . $isCorrect . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Nav atbilžu šim jautājumam.</p>";
            }
        }
    } else {
        echo "<p>Nav pievienoti jautājumi.</p>";
    }

    $conn->close();
    ?>
</body>
</html>