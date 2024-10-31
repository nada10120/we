<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "Questions";
require "./components/head.php"

    ?>


<body class="d-flex flex-column">

    <?php require "./components/navbar.php" ?>

    <?php
    require_once './database/connection.php';
    require_once './database/questionsQuery.php';
    require_once './database/participateQuery.php';

    $questions = new Questions($conn);
    $participate = new Participate($conn);
    $points = 0;
    $data = $questions->getAllQuestions();
    $question_list = json_decode($data[0]['questions_list'], true);


    if (!isset($_COOKIE['participate_id'])) {
        header('Location: ' . 'index.php');
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        foreach ($question_list as $q) {
            $questionKey = preg_replace('/\s+/', '_', $q['question']);
            if (isset($_POST[$questionKey])) {
                if ($_POST[$questionKey] === $q['answer']) {
                    $points += 1;
                }
            }
        }
        $participate->setUserPoints($points, $_COOKIE['participate_id']);
        header('Location: ' . 'rank_list.php?id=' . $_COOKIE['tournament_id']);
        setcookie("participate_id", '', time() - 3600);
        setcookie("tournament_id", '', time() - 3600);

    }
    ?>
    <form method="POST" action="questions.php" class="content container py-4">
        <h1 class="mb-4">Questions</h1>
        <div class="row">

            <?php
            foreach ($question_list as $q) {
                echo '<div id="' . $q['question'] . '" class="col-12 mb-4">';
                echo '<h4 class="mb-3">' . htmlspecialchars($q['question']) . '</h4>';
                echo '<select required name="' . $q['question'] . '" class="form-select">';
                foreach ($q['options'] as $o) {
                    echo '<option>' . $o . '</option>';
                }
                echo '</select>';
                echo '</div>';
            }
            ?>

            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <?php require "./components/footer.php" ?>
    </script>
</body>

</html>