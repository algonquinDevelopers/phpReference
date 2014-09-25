<?php
$dbhost = 'localhost';
$dbname = 'systemtracker';
$dbuname = 'root';
$pass = '';
$db = mysqli_connect($dbhost,$dbuname,$pass,$dbname)
or die('<div align="center">Warning: Could not connect to the database</div>');
if (!$db) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
?>