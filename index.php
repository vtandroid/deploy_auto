<?php
echo "<h1>Hello</h1>";
$q="start";
if(isset($_GET['q'])){
	$q = $_GET['q'];
}

echo shell_exec("./kettleRun.sh $q");

?>
