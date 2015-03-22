<html>
<head>
    <!-- 
            Programmer: Phil Graham-->
	<title>Warehouse Manager </title>
    <?php
		include("headerWarehouseManager.html");
	?>
        <h1>
            Quantity Level Report
        </h1>
        <br />
        <?php
		
		DEFINE ('DB_USER', 'cs56712');
		DEFINE ('DB_PASSWORD', 'hr1S2dLXu');
		DEFINE ('DB_HOST','courses');
		DEFINE ('DB_NAME','cs56712');
		
		//make connection
		$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
		or die ('Could not connect to MySql:' .mysqli_connect_error() );
		
		//set encoding
		mysqli_set_charset($dbc, 'utf8');
		$q = "SELECT * FROM Parts AS p, QuantityLevel AS q 
			WHERE p.Part_ID = q.Part_ID
			ORDER BY WarehouseName";
			
		$r = mysqli_query($dbc,$q);	 //result
		echo "<center><table border='1'>
		<tr>
		<th>Warehouse Name</th>
		<th>Warehouse Manger</th>
		<th>Part Number</th>
		<th>Part Description</th>
		<th>Quantity Level</th>
		</tr>";
		
		while($row = mysqli_fetch_assoc($r))	 
		{
			
		echo "<tr class='table'>";
		echo "<td>{$row['WarehouseName']}</td>";
		echo "<td>&nbsp;&nbsp;WarehouseManager1&nbsp;&nbsp;</td>";			//this is hard coded need to fix
		echo "<td>{$row['Part_ID']}</td>";
		echo "<td>{$row['Description']}</td>";
		if($row['Quantity'] < 20)
		{
			echo "<td style='color:Red;'>{$row['Quantity']}</td>";
		}
		else
		{
			echo "<td>{$row['Quantity']}</td>";
		}
		echo "</tr>\n";
		}
		echo "</table></center><br>";
		echo "<form action='SetQuantity.php'><input type='submit' value='Back'></form>";
		
		mysqli_free_result($r);
		mysqli_close($dbc);
		?>
		<center><button onclick="myFunction()"> Print this page </button></center>

		<script>
		function myFunction()
		{
		window.print();
		}
		</script>
    </div>
</body>
</html>
