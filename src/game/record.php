<?php
    $score = $_POST[ 'score' ];
    $browser = $_SERVER['HTTP_USER_AGENT'];
if ( is_null( $score ) ) {
    echo '<h1>Fail!</h1>';
} else {
    $jb_conn = mysqli_connect( 'localhost', 'hurims', 'zhkxmfh!@cf', 'hurims' );
    $jb_sql = "INSERT INTO records ( score, browser ) VALUES ( '$score', '$browser' );";
    mysqli_query( $jb_conn, $jb_sql );
    echo '<h1>Success!</h1>';
}
?>