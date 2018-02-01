<?php
// print_r($_POST);


$results = array();
$results['name'] = $_POST['email'];
$results['age'] = $_POST['age'] + 10;


print json_encode($_SERVER);
// echo json_encode($_SERVER);
exit();

