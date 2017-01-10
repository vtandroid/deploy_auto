<?php
echo "<h1>Hello</h1>";
$q="start";
if(isset($_GET['q'])){
	$q = $_GET['q'];
}
if(!file_exists("kettleRun.sh")){
	shell_exec("tar -xf kettleRun.tar");
}
echo shell_exec("./kettleRun.sh $q");

?>
