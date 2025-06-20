<!DOCTYPE html>
<html>
<head><title>PHP Web Tier</title></head>
<body>
<h1>Users From Flask App</h1>
<ul>
<?php
$flask_url = "http://flask-service"; // Internal K8s service
$response = file_get_contents("$flask_url/");
$data = json_decode($response, true);

foreach ($data as $user) {
    echo "<li>ID: {$user[0]}, Name: {$user[1]}</li>";
}
?>
</ul>
</body>
</html>
