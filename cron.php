<?php
$conn = mysqli_connect('localhost', 'tbm348se_laravel', 'p6fx3L^x#&5N', 'tbm348se_laravel');

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'promocodes'){
	$sql = "UPDATE promocodes SET status = '0' WHERE end_date < '" . date('Y-m-d') . "'";
	mysqli_query($conn, $sql);
}
