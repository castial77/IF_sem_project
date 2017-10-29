<!-- ITS62304 - Assignment #1 PART B -->
<!-- Web Database Applications -->
<!-- Student Name: <Mohammad Bashitul Islam> -->
<!-- Student ID: <0326576> -->

<?php
require_once "DB.php";
require_once "HTML/Template/IT.php";
$username = "0326576";
$password = "basit061";
$hostName = "localhost:3306";
$databaseName = "winestore";
$dsn = "mysql://{$username}:{$password}@{$hostName}/{$databaseName}";

//Open a connection to the DBMS
$connect = DB::connect($dsn);
if(DB::isError($connect))
die($connect->getMessage());

 /*Retrieve values from form.php*/
 $wineName = $_GET["wineName"];
 $region = $_GET["region"];
 $wineryName = $_GET["wineryName"];
 $minYear = $_GET["minYear"];
 $maxYear = $_GET["maxYear"];
 $minStock = $_GET["minStock"];
 $minPurchased = $_GET["minPurchased"];
 $minPrice = $_GET["minPrice"];
 $maxPrice = $_GET["maxPrice"];

 /*Capitalize first character, make string lowercase, remove whitespaces from front and back, and remove non-alphabetical character*/
 $wineName = ucwords(strtolower(trim(preg_replace("/[^A-Za-z ]/", '', $wineName))));
 $wineryName = ucwords(strtolower(trim(preg_replace("/[^A-Za-z ]/", '', $wineryName))));
 /*Remove whitespaces from front and back, and remove non-numerical character*/
 $minYear = trim(preg_replace("/[^0-9 ]/", '', $minYear));
 $maxYear = trim(preg_replace("/[^0-9 ]/", '', $maxYear));
 $minStock = trim(preg_replace("/[^0-9 ]/", '', $minStock));
 $minPurchased	= trim(preg_replace("/[^0-9 ]/", '', $minPurchased));
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
 if(!empty($minYear)) {
  switch ($first) {
   case true:
    $myStatement .= "WHERE year >= '$minYear'";
    $first = false;
    break;
   case false:
    $myStatement .= " AND year >= '$minYear'";
    break;
   default:
    return;
  }
 }
 if(!empty($maxYear)) {
  switch ($first) {
   case true:
    $myStatement .= "WHERE year <= '$maxYear'";
    $first = false;
    break;
   case false:
    $myStatement .= " AND year <= '$maxYear'";
    break;
   default:
    return;
  }
 }
 if(!empty($minStock)) {
  switch ($first) {
   case true:
    $myStatement .= "WHERE on_hand >= '$minStock'";
    $first = false;
    break;
   case false:
    $myStatement .= " AND on_hand >= '$minStock'";
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
 if(!empty($minPurchased)) {
  $myStatement .= " HAVING purcQty >= '$minPurchased'";
 }

 //(Run the query on the winestore through the connection
 $result = $connect->query($myStatement);
 if(DB::isError($result))
 die($result->getMessage());

 /*Enter query for displaying search results*/
 $myQuery = mysql_query ($myStatement);
 /*Count number of rows returned*/
 $row = mysql_num_rows($myQuery);

/*Display rows if returned*/
if($row > 0) {
 //Create a new template, and specify that the template files are
 //in the subdirectory "templates"
 $template = new HTML_Template_IT("./templates");
 //Load the customer template file
 $template->loadTemplatefile("searchwinepd.tpl", true, true);
 while ($row = $result->fetchRow(DB_FETCHMODE_ASSOC))
 {
 //Work with the customer block
 $template->setCurrentBlock("result");
 //Assign the row data to the template placeholders
 $template->setVariable("WineName", $row["wine_name"]);
 $template->setVariable("WineVariety", $row["variety_id"]);
 $template->setVariable("Year", $row["year"]);
 $template->setVariable("Winery", $row["winery_name"]);
 $template->setVariable("Region", $row["region_name"]);
 $template->setVariable("Price", $row["cost"]);
 $template->setVariable("SDP", $row["on_hand"]);
 $template->setVariable("TotalStock", $row["on_hand"]);
 $template->setVariable("OrderQuantity", $row["purcQty"]);
 //Parse the current block
 $template->parseCurrentBlock();
 }
 //Output the web page
 $template->show();
}

/*Informs user if no rows are returned*/
else {
 //echo "<h2>ERROR: No records match your search criteria.</h2>";
 die("ERROR: No records match your search criteria.");
}
/*Close connection*/
mysql_close($connect);
?>
