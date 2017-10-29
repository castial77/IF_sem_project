<!-- ITS62304 - Assignment #1 PART B -->
<!-- Web Database Applications -->
<!-- Student Name: <Mohammad Bashitul Islam> -->
<!-- Student ID: <0326576> -->
<!-- Description: Search page for users to enter search criterias -->


<html lang="utf-8">
<!-- Head element -->
<head>
	<!-- Page title -->
	<title>Search Form - Lavinia Paris</title>
	<meta charset="utf-8">
	<!-- Internal CSS -->
	

      <link rel="stylesheet" type="text/css" href="a1.css">


		
	
</head>

<!-- Body element -->
<body bgcolor="#87CEFA">
	<!-- Header section -->
	<header>
		<h1 align="center">Welcome to Lavinia Paris</h1>
	</header>
	
	<!-- Main section -->
	<main>
		<section>
			<h1>FIND WINES</h1>
			<p>The LAVINIA project was created by Thierry Servant and Pascal Chevrot, two passionate wine lovers, 
                   whose personal experiences led them to imagine a new concept in the world of wine distribution.
               LAVINIA is based on two fundamentals: respect for the product and the customer, and added value. From store to store,
               real or virtual, the importance of the LAVINIA group has expanded to make our company the leader in wine distribution in Europe.
                <br><h4>We have the one of the finest selection of wine in Europe.</h4>

                </p>
		</section>
		<!-- Contact form -->
		<section>
			<h3>SEARCH FORM</h3>
<a href="form1.php">
                    <IMG STYLE="position:absolute; TOP:300px; RIGHT:300px; WIDTH:200px; HEIGHT:200px" SRC="wine logo.png">

</a>

			<!-- Form handling using GET, send to searchwine.php to display search result -->
			<form action="searchwine1.php" method="get">
				<table style="width:100%;">
					<tr>
						<th>WINE NAME</th>
						<td><input type="text" name="wineName" size="50"></td>
					</tr>
					<tr>
						<th>REGION</th>
						<td>
							<!-- Retrieve values for options dynamically from database -->
							<?php
								/*Open connection*/
								$connection = mysql_connect("localhost","0326576","basit061");
								/*Exit script if cannot connect*/
								if(!$connection) {
									die ('Could not connect: '. mysql_error());
								}
								
								/*Select database*/
								$selectedDB = mysql_select_db("winestore0326576", $connection);
								/*Exit script if cannot select database*/
								if(!$selectedDB) {
									die ('Could not find database: '. mysql_error());
								}
								
								/*Enter query for displaying region name*/
								$searchQuery = mysql_query ("SELECT DISTINCT region_name FROM region ORDER BY region_name ASC");
								echo '<select name="region">';
								
								/*Stay in loop while query still returns rows*/
								while($row = mysql_fetch_array($searchQuery)) {
									$rOpt = $row["region_name"];
									echo '<option value = "' . htmlspecialchars($rOpt) . '">' . htmlspecialchars($rOpt) . '</option>';
								}
								echo '</select>';
								
								/*Close connection*/
								mysql_close($connection);
							?>
						</td>
					</tr>
					<tr>
						<th>WINERY NAME</th>
						<td><input type="text" name="wineryName" size="50"></td>
					</tr>
					<tr>
						<th>YEAR</th>
						<td>FROM: <input type="text" name="startYear" size="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TO: <input type="text" name="endYear" size="13"></td>
					</tr>
					<tr>
						<th>MINIMUM QUANTITY</th>
						<td><input type="text" name="minWine" size="50"></td>
					</tr>
					<tr>
						<th>QUANTITY PURCHASED</th>
						<td><input type="text" name="minOrdered" size="50"></td>
					</tr>
					<tr>
						<th>PRICE RANGE</th>
						<td>LOWEST: ($) <input type="text" name="minPrice" size="10">&nbsp;&nbsp;&nbsp;&nbsp; HIGHEST: ($) <input type="text" name="maxPrice" size="10"></td>
					</tr>
				</table>
				<!-- Search button -->
				<div style="text-align:center;margin-bottom:30px;">
					<input type="submit" value="SEARCH WINE">
				</div>
			</form>
		</section>
		<p style="clear:both;"></p>
	</main>
	
	<!-- Footer section -->
	
		<footer class="site-footer" >
		<p class="copy">&copy;Lavinia Paris ALL RIGHTS RESERVED</p>
                 <p class="copy">&copy; Developed by Mohammad Bashitul Islam </p>
                   <p class="copy">&copy; LAVINIA Madeleine (3, Bd de la Madeleine, Paris 1st )<br> 
                                         The store: 01 42 97 20 20 or laviniafrance@lavinia.com<br> 
                                         The restaurant: 01 42 97 20 27  </p>






	</footer>
</body>
</html>