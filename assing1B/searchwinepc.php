<!-- ITS62304 - Assignment #1 PART C -->
<!-- Web Database Applications -->
<!-- Student Name: <Mohammad Bashitul Islam> -->
<!-- Student ID: <0326576> -->
<!-- Description: Search page for users to enter search criterias --><html lang="utf-8">
<!-- Head element -->

			<!-- Retrieve and display search results from database -->
			<?php

                    require_once "HTML/Template/IT.php";

                        


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
				
				/*Retrieve values from form2.php*/
				$wineName = $_GET["wineName"];
				$region = $_GET["region"];
				$wineryName = $_GET["wineryName"];
				$startYear = $_GET["startYear"];
				$endYear = $_GET["endYear"];
				$minWine = $_GET["minWine"];
				$minOrdered = $_GET["minOrdered"];
				$minPrice = $_GET["minPrice"];
				$maxPrice = $_GET["maxPrice"];
				
				/*Capitalize first character, make string lowercase, remove whitespaces from front and back, and remove non-alphabetical character*/
				$wineName = ucwords(strtolower(trim(preg_replace("/[^A-Za-z ]/", '', $wineName))));
				$wineryName = ucwords(strtolower(trim(preg_replace("/[^A-Za-z ]/", '', $wineryName))));
				/*Remove whitespaces from front and back, and remove non-numerical character*/
				$startYear = trim(preg_replace("/[^0-9 ]/", '', $startYear));
				$endYear = trim(preg_replace("/[^0-9 ]/", '', $endYear));
				$minWine = trim(preg_replace("/[^0-9 ]/", '', $minWine));
				$minOrdered	= trim(preg_replace("/[^0-9 ]/", '', $minOrdered));
				/*Remove whitespaces from front and back, and remove non-numerical character but allow '.' for decimal value*/
				$minPrice = trim(preg_replace("/[^0-9\. ]/", '', $minPrice));
				$maxPrice = trim(preg_replace("/[^0-9\. ]/", '', $maxPrice));
				
				
				/*Creating query for displaying search results*/
				$myStatement = "
					SELECT a.wine_name, c.variety_id, a.year, f.winery_name, g.region_name, b.cost, b.on_hand, (COUNT(e.cust_id)) AS purcQty 
					FROM wine a
					JOIN inventory b
					ON a.wine_id = b.wine_id
						JOIN wine_variety c
						ON a.wine_id = c.wine_id
							JOIN items d
							ON a.wine_id = d.wine_id
								JOIN orders e
								ON d.cust_id = e.cust_id
									JOIN winery f
									ON f.winery_id= a.winery_id
										JOIN region g  
										ON g.region_id = f.region_id
				";
					
				/*Indicates the first condition to be appended*/
				$first = true;
				
				/*Appends conditions to query*/
				if(!empty($wineName)) {
					$myStatement .= "WHERE wine_name LIKE '%$wineName%'";
					$first = false;
				}
				if($region != "All") {
					switch ($first) {
						case true:
							$myStatement .= "WHERE region_name = '$region'";
							$first = false;
							break;
						case false:
							$myStatement .= " AND region_name = '$region'";
							break;
						default:
							return;
					}
				}
				if(!empty($wineryName)) {
					switch ($first) {
    					case true:
							$myStatement .= "WHERE winery_name LIKE '%$wineryName%'";
							$first = false;
							break;
    					case false:
        					$myStatement .= " AND winery_name LIKE '%$wineryName%'";
							break;
						default:
							return;
					}
				}
				if(!empty($startYear)) {
					switch ($first) {
    					case true:
							$myStatement .= "WHERE year >= '$startYear'";
							$first = false;
							break;
    					case false:
        					$myStatement .= " AND year >= '$startYear'";
							break;
						default:
							return;
					}
				}
				if(!empty($endYear)) {
					switch ($first) {
    					case true:
							$myStatement .= "WHERE year <= '$endYear'";
							$first = false;
							break;
    					case false:
							$myStatement .= " AND year <= '$endYear'";
							break;
						default:
							return;
					}
				}
				if(!empty($minWine)) {
					switch ($first) {
						case true:
							$myStatement .= "WHERE on_hand >= '$minWine'";
							$first = false;
							break;
    					case false:
        					$myStatement .= " AND on_hand >= '$minWine'";
							break;
						default:
							return;
					}
				}
				if(!empty($minPrice)) {
					switch ($first) {
    					case true:
							$myStatement .= "WHERE cost >= '$minPrice'";
							$first = false;
							break;
    					case false:
        					$myStatement .= " AND cost >= '$minPrice'";
							break;
						default:
							return;
					}
				}
				if(!empty($maxPrice)) {
					switch ($first) {
    					case true:
							$myStatement .= "WHERE cost <= '$maxPrice'";
							$first = false;
							break;
    					case false:
        					$myStatement .= " AND cost <= '$maxPrice'";
							break;
						default:
							return;
					}
				}
				$myStatement .= " GROUP BY wine_name, variety_id, year, winery_name, region_name, cost";
				if(!empty($minOrdered)) {
					$myStatement .= " HAVING purcQty >= '$minOrdered'";
				}
				
				/*Enter query for displaying search results*/
				$myQuery = mysql_query ($myStatement);
				/*Count number of rows returned*/
				$row = mysql_num_rows($myQuery);
				
				/*Display rows if returned*/
				if($row > 0) {
					/*Stay in loop while query still returns rows*/
                                $template = new HTML_Template_IT("./templates");
                                $template->loadTemplatefile("searchwinepc.tpl", true ,true);
					while($row = mysql_fetch_array($myQuery)) {
                                   $template -> setCurrentBlock("result");
                                    $template->setVariable("WineName" , $row["wine_name"]);
                                    $template->setVariable("WineVariety" , $row["variety_id"]);
                                    $template->setVariable("Year" , $row["year"]);
                                    $template->setVariable("Winery" , $row["winery_name"]);
                                    $template->setVariable("Region" , $row["region_name"]);
                                    $template->setVariable("Price" , $row["cost"]);
                                    $template->setVariable("SDP" , $row["on_hand"]);
                                    $template->setVariable("TotalStock" , $row["on_hand"]);
                                    $template->setVariable("OrderQuantity" , $row["purcQty"]);

                                     $template->parseCurrentBlock();
                                     
					}
                                      $template->show();
                                      
                                   //  <p>All the price are shown in USD</p>
		              }
                                     // <p>All the price are shown in USD</p>

				/*Prompt user to return and re-enter criteria if no rows are returned*/
				else {
					echo "<p>I'm sorry but it seems like we can't find what you're looking for.</p>";
					echo '<p>Please try again by returning to the search form <a href="#" onclick="history.go(-1)">page</a> and re-enter your search criteria.</p>';
				}
				/*Close connection*/
				mysql_close($connection);
			?>