
<?php
	require_once('form_processing.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title> DEMO TABLE </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style>
			h1 {color: #FF5733}
			h2 {color: #000033}
			h4 {color: #9E4D22}
			body{
				text-align: center;
			}
			#container-main{
				display: inline-block;
			}
			table {
				border-collapse: collapse;
				border-spacing: 0;
				border: 1px solid #DCDCDC;
			}

			th, td {
				border: none;
				text-align: center;
				padding: 7px;
			}
			
			tr:nth-child(even){
				background-color: #F1F1F1;
			}	
			
			.boxed{
				height: 250px;
				width: 250px;
				margin: 10px;
				overflow: auto;
				float: right;
				background-color: lavender;
				border: solid 2px silver;
			}
			
		</style>

	</head>
	
	<body>

		<h1> I-spot.tv Data</h1>
	
		<hr>
		<h4> Enter a date between Jan 1st , 2016 to Dec 31st, 2016 </h4> <br>
		
		<div class="boxed">
			This text is enclosed in a box.
		</div>
		<style>
		
		</style>
	
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="get">
			<label>From Date: </label>
			<input name="from" id="from" type="text" value="<?php if(isset($_GET['from'])) echo $_GET['from']; ?>" placeholder="Enter Date"  required /> 
			<label>To Date : </label>
			<input name="to" id="to" type="text" value="<?php if(isset($_GET['to'])) echo $_GET['to']; ?>" placeholder="Enter Date"  required />
			<br>
			<label>Brand</label><select name='brand'><?php getOptions('brand') ?></select><br>
			<label>Industry</label><select name='industry'><?php getOptions('industry') ?></select><br>
			<label>Network</label><select name='network'><?php getOptions('network') ?></select><br>
			<label>Show</label><select name='shows'><?php getOptions('shows') ?></select><br>
			<input type="submit" value="Get Data" />
		</form>
		

	<?php
		if (session_status() == PHP_SESSION_NONE) session_start();
	
			$domain = 'http://localhost';
			$GLOBALS['domain'] = $domain;
	
			date_default_timezone_set('America/New_York'); 
	
			$link = mysqli_connect('localhost', 'root', '');	
		if ($link){
			$db_selected = mysqli_select_db($link, 'testdb');
			if (!$db_selected) mysqli_close($link);
			else {
				if(isset($_GET['from'])){
		?>
		<div id='container-main'>
			<table border = '2'>
				<tr>
					<th>Brand</th>
					<th>Duration</th>
					<th>Air Date ET</th>
					<th>Air Time ET</th>
					<th>Network</th>
					<th>Show</th>
					<th>Industry</th>
				</tr>
		


		<?php	
		
		$query_spend_sums = "SELECT SUM(`estimated_spend`) AS value_sum FROM fb_soda ". $suffix;
		$result = mysqli_query($link,$query_spend_sums);
		if ($result && mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		$number = $row['value_sum'];
		$english_format_number = number_format($number);
		echo '<br>';
		echo '<b>The total value of estimated spend is: </b>';
		echo '<span style="color:green;font-weight:bold">$'.$english_format_number.'</span>';
		echo '<br>';
		echo '<br>';
		}
				$result = mysqli_query($link,$query_rows_selected);
				if($result && mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" . $row['brand'] ."</td>";
						echo "<td>" . $row['duration'] . "</td>";
						echo "<td>" . $row['air_date_et'] . "</td>";
						echo "<td>" . $row['air_time_et'] . "</td>";
						echo "<td>" . $row['network'] . "</td>";
						echo "<td>" . $row['shows'] . "</td>";
						echo "<td>" . $row['industry'] . "</td>";
						echo "</tr>";
					}
				}
			
		?>
			</table>
			<br>
					
	
			<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="get">
				<input name="from" type="hidden" value="<?=$from?>" />
				<input name="to" type="hidden" value="<?=$to?>" />	
				<input name="brand" type="hidden" value="<?=$brand?>" />
				<input name="network" type="hidden" value="<?=$network?>" />	
				<input name="industry" type="hidden" value="<?=$industry?>" />
				<input name="shows" type="hidden" value="<?=$shows?>" />	
				<label> Go to Page #   </label>
				<select name="page_number">
					<?php for ($i=1; $i<=$number_of_pages; $i++) { ?>
						<option value="<?php echo $i;?>"><?php echo $i;?></option> 
					<?php } ?>
				</select>
				<input id="page_number" type="submit" value="GO" />
			</form>	
		</div>
		<?php	
			}
		}
	}
	?>

	</body>
	</html>