<!-- ITS62304 - Assignment #1 PART D -->
<!-- Web Database Applications -->
<!-- Student Name: <Mohammad Bashitul Islam> -->
<!-- Student ID: <0326576> -->

<html>

<title>Search Form - Lavinia Paris Part D</title>
<head>
 <title>Winestore A1 Part D</title>


<link rel="stylesheet" type="text/css" href="a1.css">

</head>
<section>

<header>
		<h1 align="center">Welcome to Lavinia Paris</h1>
	</header>
			<h1>FIND WINES</h1>
			<p>The LAVINIA project was created by Thierry Servant and Pascal Chevrot, two passionate wine lovers,
                   whose personal experiences led them to imagine a new concept in the world of wine distribution.
               LAVINIA is based on two fundamentals: respect for the product and the customer, and added value. From store to store,
               real or virtual, the importance of the LAVINIA group has expanded to make our company the leader in wine distribution in Europe.
                <br><h4>We have the one of the finest selection of wine in Europe.</h4>

                </p>

		<a href="form4.php">
                    <IMG STYLE="position:absolute; TOP:300px; RIGHT:300px; WIDTH:200px; HEIGHT:200px" SRC="wine logo.png">

</a>
		<!-- Contact form -->
		</section>

</head>
<body  bgcolor="#87CEFA" , style="width: 100%; height: 100%;">

 <form action="searchwinepd1.php" method=get>

  <table style="width:100%;">
   <tr>
    <th>Wine Name: </th>
    <td><input type="text" name="wineName" size="50"></td>
   </tr>

   <tr>
    <th>Region: </th>
    <td>
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

     /*Enter query for displaying region name*/
     $result = $connect->query("SELECT DISTINCT region_name FROM region ORDER BY region_name ASC");
     if (DB::isError($result))
     die ($result->getMessage());
     echo '<select name="region">';

     /*Stay in loop while query still returns rows*/
     while($row = $result->fetchRow(DB_FETCHMODE_ASSOC)){
      $rowOption = $row["region_name"];
      echo '<option value = "' . htmlspecialchars($rowOption) . '">' . htmlspecialchars($rowOption) . '</option>';
     }
     echo '</select>';
     /*Close connection*/
     mysql_close($connect);
     ?>
    </td>
   </tr>

   <tr>
    <th>Winery Name: </th>
    <td><input type="text" name="wineryName" size="50"></td>
   </tr>

   <tr>
    <th>Year: </th>
    <td><input type="text" name="minYear" size="20">&nbsp;&nbsp;to&nbsp;&nbsp;<input type="text" name="maxYear" size="20"></td>
   </tr>

   <tr>
    <th>Minimum Stock: </th>
    <td><input type="text" name="minStock" size="50"></td>
   </tr>

   <tr>
    <th>Quantity Purchased: </th>
    <td><input type="text" name="minPurchased" size="50"></td>
   </tr>

   <tr>
    <th>Price: </th>
    <td> ($)&nbsp;<input type="text" name="minPrice" size="15">&nbsp;to  ($)&nbsp;<input type="text" name="maxPrice" size="15"></td>
   </tr>
  </table>
  <div style="text-align:center;margin-bottom:50px;">
   <input type="submit" value="Search">
  </div>
 </form>

 <footer class="site-footer" >
		<p class="copy">&copy;Lavinia Paris ALL RIGHTS RESERVED</p>
                 <p class="copy">&copy; Developed by Mohammad Bashitul Islam </p>
                   <p class="copy">&copy; LAVINIA Madeleine (3, Bd de la Madeleine, Paris 1st )<br>
                                         The store: 01 42 97 20 20 or laviniafrance@lavinia.com<br>
                                         The restaurant: 01 42 97 20 27  </p>






	</footer>
</body>
</html>
