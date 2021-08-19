<?php

// Connect to the database.
$dbc = mysqli_connect("localhost", "matuadoc_demo", 'demo', "matuadoc_quiz_demo");

// Check for a connection error. If there is one, print it and abort.
if ($error = mysqli_error($dbc)) {
    print_r($error);
    exit();
} else {
    echo "</p>Connection successful.</p>";
}

// Switch to UTF-8 to ensure macrons work.
mysqli_set_charset($dbc, "utf8");

// Get 3 (out of 5) question IDs — we will use these to get the questions and answers.
// ORDER BY RAND() ensures they are randomly selected.
// LIMIT 3 ensures we only get as many as we need.
$idQuery = "SELECT Questions.QuestionID FROM Questions WHERE Questions.QuizID = 1 ORDER BY RAND() LIMIT 3";
$idResult = mysqli_query($dbc, $idQuery);

// Empty questions array/list
$questions = [];

// For each row returned from executing the ID query (each row contains a QuestionID),
// fetch the question text from the Question table, fetch the correct answer from the
// Answer table, and then separately fetch the wrong answers from the Answer table
foreach ($idResult as $row) {
    $questionID = $row["QuestionID"];

    $questionQuery = "SELECT Questions.QuestionText FROM Questions WHERE Questions.QuestionID = " . $questionID;
    $questionResult = mysqli_query($dbc, $questionQuery);
    $questionText = mysqli_fetch_assoc($questionResult)["QuestionText"];

    $correctAnswerQuery = "SELECT Answers.AnswerText FROM Answers WHERE Answers.AnswerIsCorrect = 1 AND Answers.QuestionID = " . $questionID;
    $correctAnswerResult = mysqli_query($dbc, $correctAnswerQuery);
    $correctAnswerText = mysqli_fetch_assoc($correctAnswerResult)["AnswerText"];

    $wrongAnswerQuery = "SELECT Answers.AnswerText FROM Answers WHERE Answers.AnswerIsCorrect = 0 AND Answers.QuestionID = " . $questionID;
    $wrongAnswersResult = mysqli_query($dbc, $wrongAnswerQuery);

    // Empty wrong answers array/list
    $wrongAnswers = [];
    // For each row returned from executing the wrong answers query (each row contains
    // the text of each wrong answer), add them to the empty wrong answers array.
    foreach ($wrongAnswersResult as $answer) {
        array_push($wrongAnswers, $answer["AnswerText"]);
    }

    // Once all of this information has been obtained from the database, put it all into
    // a dictionary, then add the dictionary to the empty questions array.
    array_push($questions, [
        "question" => $questionText,
        "answer" => $correctAnswerText,
        "wrong_answers" => $wrongAnswers
    ]);
}

// Print all the fetched questions and answers
foreach ($questions as $question) {
    echo "<h1>" . $question["question"] . "</h1>";
    echo "<h2>Answer is: " . $question["answer"] . "</h2>";
    echo "<ul>";
    foreach ($question["wrong_answers"] as $wrongAnswer) {
        echo "<li>" . $wrongAnswer . "</li>";
    }
    echo "</ul>";
}