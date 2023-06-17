<?php
    $score = $_POST[ 'score' ];
    $name = $_POST[ 'name' ];
    $expression = $_POST[ 'expression' ];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if ( is_null( $score ) ) {
        echo '<h1>Fail!</h1>';
    } else {
        require_once("../db_connection.php");
        $sql = "INSERT INTO records ( score, name, expression, browser ) VALUES ( '$score', '$name', '$expression', '$browser' );";
        mysqli_query( $mysqli, $sql );
        echo '<h1>Success!</h1>';
    }
?>