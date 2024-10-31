<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "MANSOURA UNIVERSITY";
require "./components/head.php"

    ?>


<body class="d-flex flex-column">

    <?php require "components/navbar.php" ?>

    <main class="content container py-4">
        <div class="hero_section">
            <h1 class="text-center">Welcome to <span class="text-primary">MANSOURA</span> UNIVERSITY</h1>
            <p class="text-center">Explore a world of competitive excitement with a variety of tournament types, from
                sports to IT challenges, history quizzes</p>
            <?php
            require_once 'database/connection.php';
            require_once 'database/tournamentQuery.php';
            if (isset($_COOKIE['participate_id'])) {
                header('Location: ' . 'questions.php');
            }
            $tournament = new Tournament($conn);

            $tournaments = $tournament->getAllTournaments();
            echo '<div class="row">';
            foreach ($tournaments as $t) {
                echo '<div class="col-12 col-md-6 col-lg-4">';
                echo '    <div class="card">';
                echo '        <div class="card-body">';
                echo '            <h5 class="card-title">' . htmlspecialchars($t['title']) . '</h5>';
                echo '            <div class="card-text d-flex gap-4 mb-2">';
                echo '                <div>';
                echo '                    <i class="bi bi-person-fill"></i> ' . htmlspecialchars($t['spaces_left']) . ' spaces left'; // Assuming you have 'individuals_left' field
                echo '                </div>';
                echo '            </div>';
                if ($t['spaces_left'] >= 1) {
                    echo '            <a href="join_tournament.php?id=' . htmlspecialchars($t['id']) . '" class="btn btn-primary">JOIN NOW !</a>';
                }
                echo '            <a href="rank_list.php?id=' . htmlspecialchars($t['id']) . '" class="btn btn-secondary">RANK LIST</a>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
            }
            echo '</div>'
                ?>

        </div>

    </main>

    <?php require "components/footer.php" ?>

</body>

</html>