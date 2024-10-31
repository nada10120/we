<?php

require_once 'connection.php';

class Questions
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function getAllQuestions()
    {
        $sql = "SELECT * FROM questions WHERE tournament_id = " . $_COOKIE['tournament_id'];
        $result = $this->mysqli->query($sql);
        $questions = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        return $questions;
    }



}
