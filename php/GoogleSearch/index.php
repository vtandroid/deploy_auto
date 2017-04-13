<?php
require "vendor/autoload.php";
require "DAO/utils.php";
require "DAO/process.php";
if (isset($_POST['query']) && isset($_POST['tld']) && isset($_POST['tbm']) ) {
    try {
        $query = $_POST['query'];
        $tld=$_POST['tld'];
        $tbm=$_POST['tbm'];
        Process::search($query,$tld,$tbm);
    } catch (Exception $ex) {
        error_log($ex->getTraceAsString());
    }
}
?>