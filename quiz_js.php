<?php

function loadQuestions()
{
    /**
     * Loads the quiz questions.
     */

    // Loading in questions from a PHP dictionary.
    // FIXME: you should load the initial questions from MySQL instead.
    // Also, ideally you would load question IDs rather than whole questions.
    // After all, you can load the actual question and answer text later.
    include('questions.php');

    $sessionQuestions = $allQuestions; // Change this to fetch from MySQL
    shuffle($sessionQuestions);

    return $sessionQuestions;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Quiz</title>
    <link rel="stylesheet" href="style.css">
    <script>
    // Global variables
    var sessionQuestions = [];
    var currentQuestion = "";
    var index = 0;
    var score = 0;

    // Helper function to shuffle array
    function shuffle(array) {
        array.sort(() => Math.random() - 0.5);
    }

    // Converts the question from PHP to JSON so that JS can use it
    function loadQuiz() {
        var questionsJSON = '<?php echo json_encode(loadQuestions()); ?>';
        sessionQuestions = JSON.parse(questionsJSON);
        index = 0;
        score = 0;
        updateQuestionHTML(0);
    }

    // Display the questions
    function updateQuestionHTML() {
        if (index < sessionQuestions.length) {
            currentQuestion = sessionQuestions[index];
            var questionText = currentQuestion.question;
            var answer = currentQuestion.answer;
            var wrongAnswers = currentQuestion.wrong_answers;
            var allAnswers = wrongAnswers.concat([answer]);

            document.getElementById("question_number").innerHTML = "Question #" + (index + 1);
            document.getElementById("question_text").innerHTML = questionText;

            // Create links to call the JS function
            for (i = 1; i <= 4; i++) {
                var answerText = allAnswers[i - 1];
                document.getElementById("answer" + i).innerHTML = '<a href="javascript:checkAnswer(\'' + answerText +
                    '\');">' + answerText + '</a>';
            }
        } else {
            alert("You scored " + score + "/" + sessionQuestions.length);
        }
    }

    // Check the answer and load the next question
    function checkAnswer(answer) {
        score = score + (answer == currentQuestion.answer ? 1 : 0);
        index = index + 1;
        updateQuestionHTML()
    }
    </script>
</head>

<body onload="loadQuiz();">
    <h1 id="question_number">Question #0</h1>
    <h2 id="question_text">No question loaded</h2>
    <div id="answers">
        <div id="answer1" class="answer"><a href="javascript:checkAnswer(1);">Answer Text 1</a></div>
        <div id="answer2" class="answer"><a href="javascript:checkAnswer(2);">Answer Text 2</a></div>
        <div id="answer3" class="answer"><a href="javascript:checkAnswer(3);">Answer Text 3</a></div>
        <div id="answer4" class="answer"><a href="javascript:checkAnswer(4);">Answer Text 4</a></div>
    </div>
</body>

</html>
