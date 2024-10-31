<?php

require_once 'connection.php';

class Participate
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function joinTournament($username, $created_at, $tournament_id)
    {
        $sql = "INSERT INTO participates (username, created_at, tournament_id) VALUES (?, ? , ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('ssi', $username, $created_at, $tournament_id);
        $result = $stmt->execute();
        $insertedId = $this->mysqli->insert_id;
        $stmt->close();
        return $insertedId;
    }

    public function setUserPoints($points, $id)
    {
        $sql = "UPDATE participates SET points = ? WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('ii', $points, $id);
        $stmt->execute();
        $stmt->close();
        return;
    }

    public function getAllParticipates($id)
    {
        $sql = "SELECT p.*, t.title
        FROM participates p
        INNER JOIN tournaments t ON p.tournament_id = t.id
        WHERE p.tournament_id = ?
        ORDER BY p.points DESC";
        $stmt = $this->mysqli->prepare($sql);

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        $stmt->close();
        return $data;
    }



}
