<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css" />
    </head>
<body>

<?php
require_once("../db_connection.php");
$sql = "SELECT * FROM records ORDER BY `score` DESC LIMIT 10;";
$result = $mysqli->query($sql);
?>
<h1>TOP 10</h1>
<table width='80%' border=0>
    <tr bgcolor='#DDDDDD'>
        <td><strong>SCORE</strong></td>
        <td><strong>NAME</strong></td>
        <td><strong>EXPR</strong></td>
        <td><strong>TIME</strong></td>
    </tr>
    <?php
    while ($res = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$res['score']."</td>";
        echo "<td>".$res['name']."</td>";
        echo "<td>".$res['expression']."</td>";
        echo "<td>".$res['timestamp']."</td>";
        echo "</tr>";
    }
    ?>
</table>
<br><br><br><br><br><br>

<?php
require_once("../db_connection.php");
$sql = "SELECT * FROM records WHERE DATE(`timestamp`) = CURDATE() ORDER BY `score` DESC LIMIT 10;";
$result = $mysqli->query($sql);
?>
<h1>Today Top 10</h1>
<table width='80%' border=0>
    <tr bgcolor='#DDDDDD'>
        <td><strong>SCORE</strong></td>
        <td><strong>NAME</strong></td>
        <td><strong>EXPR</strong></td>
        <td><strong>TIME</strong></td>
    </tr>
    <?php
    while ($res = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$res['score']."</td>";
        echo "<td>".$res['name']."</td>";
        echo "<td>".$res['expression']."</td>";        
        echo "<td>".$res['timestamp']."</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>