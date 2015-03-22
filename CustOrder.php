<html>
<head>
    <!-- Group Project
            Programmer: Phil Graham-->
	<title>Customer Orders </title>
    <?php
		include("headerSalesPerson.html");
	?>
        <h1>
            Customer Orders
        </h1>
        <br />
		<strong><center>Select a Time Period to view Sales</strong>
		<form action="CustOrder.php" method="post">
		<select name = "time">
			<option value="0" selected="selected">- Time Period -</option>\
			<option value="1">Today</option>
			<option value="2">This Week</option>
			<option value="3">This Month</option>
		</select>
		<input type="submit" value="Submit"/>
		</form>	</center>
		<br />
		<hr>
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
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$time = trim($_POST["time"]);
			if($time == "1")
			{
				    $q = "SELECT * FROM CustOrder AS c, COItem AS i 
				    WHERE c.OrderNum = i.OrderNum AND DATE_SUB(CURDATE(),INTERVAL 1 DAY)";
			
				    $r = mysqli_query($dbc,$q);
				    echo "<center><table border='1'>
				    <tr>
				    <th>Order Number</th>
				    <th>Sales Person</th>
				    <th>Customer</th>
				    <th>Date Required</th>				   
				    <th>Date Ordered</th>
				    <th>Status</th>
				    </tr>";
				    
				    while($row = mysqli_fetch_assoc($r))	 
				    {
				
				    echo "<tr class='table'>";
				    echo "<td>{$row['OrderNum']}</td>";
				    echo "<td>&nbsp;&nbsp;SalesPerson1&nbsp;&nbsp;</td>";			
				    echo "<td>{$row['Cust_ID']}</td>";
				    echo "<td>{$row['ReqDate']}</td>";
				    echo "<td>{$row['ODate']}</td>";
				    echo "<td>{$row['Status']}</td>";
				    }
				    echo "</tr>\n";
				    
				    echo "</table></center><br>";
				    $row = NULL;
			}
			if($time == "2")
			{
				    $q = "SELECT * FROM CustOrder AS c, COItem AS i 
				    WHERE c.OrderNum = i.OrderNum AND DATE_SUB(CURDATE(),INTERVAL 7 DAY)";
			
				    $r = mysqli_query($dbc,$q);
				    echo "<center><table border='1'>
				    <tr>
				    <th>Order Number</th>
				    <th>Sales Person</th>
				    <th>Customer</th>
				    <th>Date Required</th>				   
				    <th>Date Ordered</th>
				    <th>Status</th>
				    </tr>";
				    
				    while($row = mysqli_fetch_assoc($r))	 
				    {
				
				    echo "<tr class='table'>";
				    echo "<td>{$row['OrderNum']}</td>";
				    echo "<td>&nbsp;&nbsp;SalesPerson1&nbsp;&nbsp;</td>";			
				    echo "<td>{$row['Cust_ID']}</td>";
				    echo "<td>{$row['ReqDate']}</td>";
				    echo "<td>{$row['ODate']}</td>";
				    echo "<td>{$row['Status']}</td>";
				    }
				    echo "</tr>\n";
				    
				    echo "</table></center><br>";
				    $row = NULL;
				    }
			if($time == "3")
			{
				    $q = "SELECT * FROM CustOrder AS c, COItem AS i 
				    WHERE c.OrderNum = i.OrderNum AND DATE_SUB(CURDATE(),INTERVAL 30 DAY)";
			
				    $r = mysqli_query($dbc,$q);
				    echo "<center><table border='1'>
				    <tr>
				    <th>Order Number</th>
				    <th>Sales Person</th>
				    <th>Customer</th>
				    <th>Date Required</th>				   
				    <th>Date Ordered</th>
				    <th>Status</th>
				    </tr>";
				    
				    while($row3 = mysqli_fetch_assoc($r))	 
				    {
				
				    echo "<tr class='table'>";
				    echo "<td>{$row3['OrderNum']}</td>";
				    echo "<td>&nbsp;&nbsp;SalesPerson1&nbsp;&nbsp;</td>";			
				    echo "<td>{$row3['Cust_ID']}</td>";
				    echo "<td>{$row3['ReqDate']}</td>";
				    echo "<td>{$row3['ODate']}</td>";
				    echo "<td>{$row3['Status']}</td>";
				    }
				    echo "</tr>\n";
				    
				    echo "</table></center><br>";
				    $row3 = NULL;
			}
		}
		?>
		<center><button onclick="myFunction()"> Print this page </button></center>

		<script>
		function myFunction()
		{
		window.print();
		}
		</script>
   
</body>
</html>

