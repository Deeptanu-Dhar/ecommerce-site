<?php 

	$mysqli = new mysqli('localhost', 'root','', 'artsite_db');

	if($mysqli->connect_errno != 0){
		echo $mysqli->connect_error;
		exit();
	}


	//setting start value

	$start = 0;

	//setting the numbe of rows to displat in a page

	$rows_per_page = 10;


	//get total no. of rows


	$records = $mysqli->query("SELECT * FROM wishlist where user_id = $user_id");

	$nr_of_rows = $records->num_rows;

	//calculating no. pages

	$pages = ceil($nr_of_rows/$rows_per_page);

	// if the user clicks on the pagination buttons we set a new starting point


	if(isset($_GET['page-nr'])){
		$page = $_GET['page-nr'] - 1 ;
		$start = $page * $rows_per_page;
	}

	

	$result = $mysqli->query("SELECT * FROM wishlist where user_id = $user_id LIMIT $start, $rows_per_page");

 ?>


