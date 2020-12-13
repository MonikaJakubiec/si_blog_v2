<?php
try {
	$db = new PDO('mysql:host=localhost;dbname=si-blog;port=3306', 'root');
} catch (PDOException $e) {
	echo 'Database connection error: '.$e->getMessage();
}
?>