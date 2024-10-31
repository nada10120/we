<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "Register to new tournament";
require "./components/head.php"
    ?>


<body class="d-flex flex-column">

    <?php require "./components/navbar.php" ?>

    <main class="content container py-4">
        <?php
        require './database/connection.php';
        require_once './database/participateQuery.php';
        require_once './database/tournamentQuery.php';

        if (isset($_COOKIE['participate_id'])) {
            header('Location: ' . 'questions.php');
        }

        $tournament = new Tournament($conn);
        $participate = new Participate($conn);

        $createdAt = date('Y-m-d H:i:s');
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $tournamentId = isset($_POST['tournament_id']) ? intval($_POST['tournament_id']) : 0;
        $message = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = $participate->joinTournament($username, $createdAt, $tournamentId);
            setcookie("participate_id", $result, time() + 3600 * 24, );
            setcookie("tournament_id", $tournamentId, time() + 3600 * 24, );
            if ($result) {
                $tournament->changeTournamentSpacesCount($tournamentId);
                header('Location: ' . 'questions.php');
            } else {
                $message = "Failed to join the tournament.";
            }
        }
        ?>
        <form method="POST" action="join_tournament.php" class="card p-4" style="max-width: 860px; margin: 0 auto;">
            <h1 class="mb-4">Join The Tournament</h1>

            <div class="mb-3">
                <label for="username" class="form-label">Your name</label>
                <input type="text" name="username" class="form-control" id="username" required>
            </div>

            <input type="hidden" id="tournament_id" name="tournament_id"
                value="<?php echo htmlspecialchars($_GET['id']); ?>">

            <button type="submit" class="btn btn-primary" type="submit">JOIN</button>
            <p class="text-danger"><?php echo htmlspecialchars($message); ?></p>
        </form>
    </main>

    <?php require "./components/footer.php" ?>

</body>

</html>