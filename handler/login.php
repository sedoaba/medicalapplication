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
	
$username = clean($_GET['username']);
$password = clean($_GET['password']);

$result = $conn->query("SELECT * FROM employee where username='$username' and password =md5('$password')");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"username":"'  . $rs["username"] . '",';
    $outp .= '"name":"'   . $rs["name"]        . '",';
	$outp .= '"surname":"'   . $rs["surname"]        . '",';
	$outp .= '"buildinglink":"'   . $rs["buildinglink"]        . '",';
    $outp .= '"role":"'. $rs["role"]     . '"}'; 
}
if($outp == "")
{
	$outp ='{"userinfo":"nouserfound"}';
}
else
{

	$outp ='{"userinfo":'.$outp.'}';

}

$conn->close();

echo($outp);
?>