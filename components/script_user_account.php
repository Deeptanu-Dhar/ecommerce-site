<?php 

	include('connect.php');


	//setting start value

	$start = 0;

	//setting the numbe of rows to displat in a page

	$rows_per_page = 10;


	//get total no. of rows


	$records = $conn->prepare("SELECT * FROM users");

	$records->execute();

	$nr_of_rows = $records->rowCount();

	//calculating no. pages

	$pages = ceil($nr_of_rows/$rows_per_page);

	// if the user clicks on the pagination buttons we set a new starting point


	if(isset($_GET['page-nr'])){
		$page = $_GET['page-nr'] - 1 ;
		$start = $page * $rows_per_page;
	}


	$result = $conn->prepare("SELECT * FROM users LIMIT $start, $rows_per_page");
	$result->execute();

 ?>


