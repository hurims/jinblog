<?php
    header('Content-Type: application/json; charset=utf-8');

    $score = $_POST[ 'score' ];
    $name = $_POST[ 'name' ];
    $expression = $_POST[ 'expression' ];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if ( is_null( $score ) ) {
        echo '<h1>Fail!</h1>';
    } else {
        require_once("../db_connection.php");
        $sql = "INSERT INTO records ( score, name, expression, browser ) VALUES ( '$score', '$name', '$expression', '$browser' );";
        $mysqli->query($sql);

        $sql = "SELECT * from records where score > '$score' order by score desc;";
        $result = $mysqli->query($sql);
        $total_rank = $result->num_rows;

        $sql = "SELECT COUNT(*) from records;";
        $result = $mysqli->query($sql);
        $res = $result->fetch_array();
        $num_of_total_records = $res[0];
        
        $data = array("total_count"=>$num_of_total_records, "total_rank"=>$total_rank);

        echo json_encode($data);
    }
?>