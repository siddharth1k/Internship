<?php
	if (session_status() == PHP_SESSION_NONE) session_start();
	$domain = 'http://localhost';
	$GLOBALS['domain'] = $domain;
	date_default_timezone_set('America/New_York');
	setlocale(LC_MONETARY, 'en_US.UTF-8');
	
	/* DATABASE ACCESS SETUP AND BUFFERING */
	$link = mysqli_connect('localhost', 'root', '');
	if ($link) $db_selected = mysqli_select_db($link, 'testdb');
	else $db_selected = false;
	$GLOBALS['db_selected'] = $db_selected;
	
/* SETUP QUERIES for BET*/
/* QUERY TO SELECT COUNT OF DISTINCT BRAND */	
$query_brand  = "SELECT count(Distinct brand) AS num_count from `fb_soda` where network ='BET'";
$result = mysqli_query($link,$query_brand);
if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$queryCountBET = $row['num_count'];
	}	


/* QUERY FOR NUMBER OF SPOTS */
$query_sum  = "SELECT count(*) AS num_spot from `fb_soda` where network ='BET'";
$result = mysqli_query($link,$query_sum);
if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$queryspotCountBET = number_format($row['num_spot']);
	}	


/* QUERY FOR SUM OF ESTIMATED SPEND */
$query_estspend = "SELECT SUM(`estimated_spend`) AS value_sum FROM fb_soda WHERE network ='BET'"; 
$result = mysqli_query($link,$query_estspend);
if($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$query_estspendBET = number_format($row['value_sum']);
	}

/* SETUP QUERIES for CMT*/	
/* QUERY TO SELECT COUNT OF DISTINCT BRAND */	
$query_brand  = "SELECT count(Distinct brand) AS num_count from `fb_soda` where network ='Comedy Central'";
$result = mysqli_query($link,$query_brand);
if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$queryCountCMT = $row['num_count'];
	}	


/* QUERY FOR NUMBER OF SPOTS */
$query_sum  = "SELECT count(*) AS num_spot from `fb_soda` where network ='Comedy Central'";
$result = mysqli_query($link,$query_sum);
if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$queryspotCountCMT = number_format($row['num_spot']);
	}	


/* QUERY FOR SUM OF ESTIMATED SPEND */
$query_estspend = "SELECT SUM(`estimated_spend`) AS value_sum FROM fb_soda WHERE network ='BET'"; 
$result = mysqli_query($link,$query_estspend);
if($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$query_estspendCMT = number_format($row['value_sum']);
	}
	
/* SETUP QUERIES for MTV*/
/* QUERY TO SELECT COUNT OF DISTINCT BRAND */	
$query_brand  = "SELECT count(Distinct brand) AS num_count from `fb_soda` where network ='MTV'";
$result = mysqli_query($link,$query_brand);
if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$queryCountMTV = $row['num_count'];
	}	


/* QUERY FOR NUMBER OF SPOTS */
$query_sum  = "SELECT count(*) AS num_spot from `fb_soda` where network ='MTV'";
$result = mysqli_query($link,$query_sum);
if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$queryspotCountMTV = number_format($row['num_spot']);
	}	


/* QUERY FOR SUM OF ESTIMATED SPEND */
$query_estspend = "SELECT SUM(`estimated_spend`) AS value_sum FROM fb_soda WHERE network ='MTV'"; 
$result = mysqli_query($link,$query_estspend);
if($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$query_estspendMTV = number_format($row['value_sum']);
	}

	
/* SETUP QUERIES for VH1*/
/* QUERY TO SELECT COUNT OF DISTINCT BRAND */	
$query_brand  = "SELECT count(Distinct brand) AS num_count from `fb_soda` where network ='VH1'";
$result = mysqli_query($link,$query_brand);
if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$queryCountVH1 = $row['num_count'];
	}	


/* QUERY FOR NUMBER OF SPOTS */
$query_sum  = "SELECT count(*) AS num_spot from `fb_soda` where network ='VH1'";
$result = mysqli_query($link,$query_sum);
if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$queryspotCountVH1 = number_format($row['num_spot']);
	}	


/* QUERY FOR SUM OF ESTIMATED SPEND */
$query_estspend = "SELECT SUM(`estimated_spend`) AS value_sum FROM fb_soda WHERE network ='VH1'"; 
$result = mysqli_query($link,$query_estspend);
if($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$query_estspendVH1 = number_format($row['value_sum']);
	}


/* SETUP QUERIES for SPIKE*/
/* QUERY TO SELECT COUNT OF DISTINCT BRAND */	
$query_brand  = "SELECT count(Distinct brand) AS num_count from `fb_soda` where network ='SPIKE'";
$result = mysqli_query($link,$query_brand);
if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$queryCountSPIKE = $row['num_count'];
	}	


/* QUERY FOR NUMBER OF SPOTS */
$query_sum  = "SELECT count(*) AS num_spot from `fb_soda` where network ='SPIKE'";
$result = mysqli_query($link,$query_sum);
if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$queryspotCountSPIKE = number_format($row['num_spot']);
	}	


/* QUERY FOR SUM OF ESTIMATED SPEND */
$query_estspend = "SELECT SUM(`estimated_spend`) AS value_sum FROM fb_soda WHERE network ='SPIKE'"; 
$result = mysqli_query($link,$query_estspend);
if($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$query_estspendSPIKE = number_format($row['value_sum']);
	}
	
	
/* SETUP QUERIES for TV LAND*/
/* QUERY TO SELECT COUNT OF DISTINCT BRAND */	
$query_brand  = "SELECT count(Distinct brand) AS num_count from `fb_soda` where network ='TV LAND'";
$result = mysqli_query($link,$query_brand);
if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$queryCountTVL = $row['num_count'];
	}	


/* QUERY FOR NUMBER OF SPOTS */
$query_sum  = "SELECT count(*) AS num_spot from `fb_soda` where network ='TV LAND'";
$result = mysqli_query($link,$query_sum);
if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$queryspotCountTVL = number_format($row['num_spot']);
	}	


/* QUERY FOR SUM OF ESTIMATED SPEND */
$query_estspend = "SELECT SUM(`estimated_spend`) AS value_sum FROM fb_soda WHERE network ='TV LAND'"; 
$result = mysqli_query($link,$query_estspend);
if($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$query_estspendTVL = number_format($row['value_sum']);
	}
?>
