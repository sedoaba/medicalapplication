<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require("config.php");

function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	

$buildinglink = clean($_GET['buildinglink']);

$result = $conn->query("SELECT * FROM units where buildinglink='$buildinglink'");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":"'  . $rs["id"] . '",';
    $outp .= '"rooms":"'   . $rs["rooms"]        . '",';
	$outp .= '"unitnumber":"'   . $rs["unitnumber"]        . '",';
	$outp .= '"linktotype":"'   . $rs["linktotype"]        . '",';
    $outp .= '"io":"'. $rs["io"]     . '"}'; 
}
$outp ='{"units":['.$outp.']}';
$conn->close();

echo($outp);
?>

