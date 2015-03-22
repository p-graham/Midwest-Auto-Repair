<html>
<head>
    <!-- 
            Programmer: Phil Graham
            -->
    <title>Quantity Levels </title>
	<?php
		include("headerWarehouseManager.html");
	?>
        <h1>
            Set Quantity Levels
        </h1>
        <br />
        <form action="SetQuantity.php" method="post">
			<center>
				<table>
				
			<?php
               DEFINE ('DB_USER', 'cs56712');
               DEFINE ('DB_PASSWORD', 'hr1S2dLXu');
               DEFINE ('DB_HOST','courses');
               DEFINE ('DB_NAME','cs56712');
       
               //make connection
               $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
               or die ('Could not connect to MySql:' .mysqli_connect_error() );
       
               $q = "SELECT * FROM Warehouse";	 
               $result = mysqli_query($dbc,$q) or die(mysql_error());
               
               $dropdown = "<tr><td>Select Warehouse:</td><td><select name='warehousename'>";
               while($row = mysqli_fetch_assoc($result)) 
               {
					$name .= $row['WarehouseName'];
                    $dropdown .= "\r\n<option value='{$row['WarehouseName']}'>{$name}</option>";
					$name = NULL;
               }
               $dropdown .= "\r\n</select></td></tr>";
               echo $dropdown;
			   
			    mysqli_free_result($result);
        		mysqli_close($dbc);
			?>	
				
			<?php
               DEFINE ('DB_USER', 'cs56712');
               DEFINE ('DB_PASSWORD', 'hr1S2dLXu');
               DEFINE ('DB_HOST','courses');
               DEFINE ('DB_NAME','cs56712');
       
               //make connection
               $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
               or die ('Could not connect to MySql:' .mysqli_connect_error() );
       
               $q = "SELECT * FROM Parts";	 
               $result = mysqli_query($dbc,$q) or die(mysql_error());
               
               $dropdown = "<tr><td>Select Part:</td><td><select name='partid'>";
               while($row = mysqli_fetch_assoc($result)) 
               {
					$name .= $row['Part_ID'];
					$name .= " ";
					$name .= $row['Description'];
                    $dropdown .= "\r\n<option value='{$row['Part_ID']}'>{$name}</option>";
					$name = NULL;
               }
               $dropdown .= "\r\n</select></td></tr>";
               echo $dropdown;
			   
			    mysqli_free_result($result);
        		mysqli_close($dbc);
			?>	
				<tr>
					<td>Quantity level:</td>     
					<td><input size="4" type="text" name="quantitylevel"/></td>
				</tr>
			 </table>
			
            <br />
            <br />
            <input type="submit" value="Submit"/>
            <input type="reset" value="Reset"/> <br />
			</center>
        </form>
        
        <?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$warehousename = trim($_POST["warehousename"]);
			$partid = trim($_POST["partid"]);
			$quantitylevel = trim($_POST["quantitylevel"]);
	
			if(!$warehousename | !$partid | !$quantitylevel)			//makes sure fields are filled in
				{ die('You did not fill in a required field.'); }
	
			DEFINE ('DB_USER', 'cs56712');
			DEFINE ('DB_PASSWORD', 'hr1S2dLXu');
			DEFINE ('DB_HOST','courses');
			DEFINE ('DB_NAME','cs56712');
			
			//make connection
			$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
			or die ('Could not connect to MySql:' .mysqli_connect_error() );
			
			//set encoding
			mysqli_set_charset($dbc, 'utf8');
			
			$s="INSERT INTO QuantityLevel (WarehouseName, Part_ID, 
				Quantity)
				VALUES ('$warehousename', '$partid', '$quantitylevel')";
			
			$q = "SELECT * FROM QuantityLevel 
					WHERE WarehouseName = '$warehousename'
					AND Part_ID = '$partid'";	 
            $result = mysqli_query($dbc,$q) or die(mysql_error());
			while($row = mysqli_fetch_assoc($result)) 
               {
					if($row['WarehouseName'] && $row['Part_ID'])
					{
					$s = "UPDATE QuantityLevel SET Quantity = '$quantitylevel'
						WHERE WarehouseName = '$warehousename'
						AND Part_ID = '$partid'";
					}
			   }
				
			mysqli_query($dbc,$s) or die (mysqli_error($dbc));                              //result
			
			echo "<br /> <center> Quantity Level successfully added </center>";
			
			mysqli_free_result($result);
			mysqli_close($dbc);
		}
		?>
		<center><button onclick="window.location.href='QuantityReport.php' "> Quantity Level Report </button></center>
    </div>
</body>
</html>
