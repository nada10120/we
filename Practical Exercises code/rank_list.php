<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "Rank List";
require "./components/head.php"

    ?>


<body class="d-flex flex-column">

    <?php require "./components/navbar.php" ?>
    <?php
    require_once './database/connection.php';
    require_once './database/participateQuery.php';

    $participate = new Participate($conn);

    $data = $participate->getAllParticipates($_GET['id']);
    ?>
    <main class="content container py-4">
        <h1><span class="text-primary"><?php echo $data[0]['title'] ?></span> : Ranks</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Points</th>
                    <th scope="col">Date of submission</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $r) {
                    echo '<tr>';
                    echo '<th>' . $r['username'] . '</th>';
                    echo '<td>' . $r['points'] . '</td>';
                    echo '<td>' . $r['created_at'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </main>

    <?php require "./components/footer.php" ?>

</body>

</html>