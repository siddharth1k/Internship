<?php
	if (session_status() == PHP_SESSION_NONE) session_start();
	$domain = 'http://localhost';
	$GLOBALS['domain'] = $domain;
	date_default_timezone_set('America/New_York');

	/* DATABASE ACCESS SETUP AND BUFFERING */
	$link = mysqli_connect('localhost', 'root', '');
	if ($link) $db_selected = mysqli_select_db($link, 'testdb');
	else $db_selected = false;
	$GLOBALS['db_selected'] = $db_selected;


	/* Initialize variables */
	$shows = $network = $brand = $industry = $from = $to = '';

	if (isset($_GET['from'])) {
		$from = mysqli_escape_string($link, $_GET['from']);
	} else {
		$from = '';
	}

	if (isset($_GET['to'])) {
		$to = mysqli_escape_string($link, $_GET['to']);
	} else {
		$to = '';
	}

	if (isset($_GET['network']) and !empty(trim($_GET['network']))) {
		$network = mysqli_escape_string($link, $_GET['network']);
	} else {
		$_GET['network'] = '';
	}

	if (isset($_GET['brand']) and !empty(trim($_GET['brand']))) {
		$brand = mysqli_escape_string($link, $_GET['brand']);
	} else {
		$_GET['brand'] = '';
	}

	if (isset($_GET['industry']) and !empty(trim($_GET['industry']))) {
		$industry = mysqli_escape_string($link, $_GET['industry']);
	} else {
		$_GET['industry'] = '';
	}
		
	if (isset($_GET['shows']) and !empty(trim($_GET['shows']))) {
		$shows = mysqli_escape_string($link, $_GET['shows']);
	} else {
		$_GET['shows'] = '';
	}

	if (isset($_GET['page_number'])) {
		$page_number = mysqli_escape_string($link, $_GET['page_number']);
	} else {
		$page_number = 1;
	}
	
	/* SETUP QUERIES */
	/* If all data requested */
	if ($from == 'all' or $to == 'all') {
		$suffix = "";
	} else { /* otherwise */
		$suffix = " WHERE air_date_et BETWEEN '$from' and '$to' ";
		if (!empty(trim($_GET['network']))) $suffix = $suffix . " AND network='$network'";
		if (!empty(trim($_GET['brand']))) $suffix = $suffix . " AND brand='$brand'";
		if (!empty(trim($_GET['industry']))) $suffix = $suffix . " AND industry='$industry'";
		if (!empty(trim($_GET['shows']))) $suffix = $suffix . " AND shows='$shows'";
	}
	
	$number_of_items_per_page = 25;
	$offset = ($page_number-1)*$number_of_items_per_page;
	
	$query_total_row_count = "SELECT COUNT(*) AS num_count FROM fb_soda " . $suffix;
	$query_rows_selected = "SELECT * FROM fb_soda ". $suffix . "LIMIT $offset,25";
	
	
	$number_of_pages = 1;
	$result = mysqli_query($link,$query_total_row_count);
	if ($result && mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		$query_count = $row['num_count'];
		$number_of_pages = ceil($query_count/$number_of_items_per_page);
	}
	
	/* FUNCTION TO POPULATE OPTIONS FOR  QUERY SELECT TAG */
	function getOptions($column_name) {
		if (!$GLOBALS['db_selected']) return;
		
		$query = "SELECT DISTINCT $column_name AS items FROM fb_soda";
		$result = mysqli_query($GLOBALS['link'],$query);
		
		echo "<option value=''></option>";
		
		if ($result && mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_array($result)){
				$is_selected = '';
				if ($row['items'] == $_GET['network']) $is_selected = 'selected';
				else if ($row['items'] == $_GET['brand']) $is_selected = 'selected';
				else if ($row['items'] == $_GET['industry']) $is_selected = 'selected';
				else if ($row['items'] == $_GET['shows']) $is_selected = 'selected';
				echo "<option value='". $row['items']."'  $is_selected  >".$row['items']."</option>";
			}
		}
	}
?>

