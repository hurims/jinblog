<?php
    $score = $_POST[ 'score' ];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if ( is_null( $score ) ) {
        echo '<h1>Fail!</h1>';
    } else {
        require_once("../db_connection.php");
        $sql = "INSERT INTO records ( score, browser ) VALUES ( '$score', '$browser' );";
        mysqli_query( $mysqli, $sql );
        echo '<h1>Success!</h1>';
    }
?>