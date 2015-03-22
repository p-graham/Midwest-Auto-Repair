<?php session_start(); ?>
<html>
<head>
    <!-- Group Project
            Programmer: Phil Graham -->
	<title>Create Purchase Order </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript">

            var counter = 0;

            function moreFields() {
                counter++;
                var newFields = document.getElementById("readroot").cloneNode(true);
                newFields.id = '';
                newFields.style.display = 'block';
                var newField = newFields.childNodes;
                for (var i=0;i<newField.length;i++) {
                    var theName = newField[i].name;
                    if (theName)
                        newField[i].name = theName + counter;
                }
                var insertHere = document.getElementById("writeroot");
                insertHere.parentNode.insertBefore(newFields,insertHere);
            }

            window.onload = moreFields;
        </script>
    <?php
		include("headerBuyer.html");
	?>
        <h1>
            Create Purchase Order
        </h1>
	
	<form action="PurchaseOrder.php" method="post">
		<strong><center>Select a Vendor to place an Order</strong>
		<?php
                DEFINE ('DB_USER', 'cs56712');
				DEFINE ('DB_PASSWORD', 'hr1S2dLXu');
				DEFINE ('DB_HOST','courses');
				DEFINE ('DB_NAME','cs56712');
        
                //make connection
                $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
                or die ('Could not connect to MySql:' .mysqli_connect_error() );
        
                $q = "SELECT * FROM Vendor";			
                $result = mysqli_query($dbc,$q) or die(mysql_error());
                
                echo '<select name="vendor">';
                echo '<option value="0" selected="selected">- Select Vendor -</option>';
				 
                while ($row = mysqli_fetch_assoc($result))
                {
			echo "<option value='{$row['Vendor_ID']}'>{$row['VendorName']}</option>";
			
	        }
		$y = 0;
                ?>
		
		</center>
		</select>
		<strong><center>Select the Warehouse for delivery</strong>
		<?php
		$q = "SELECT * FROM Warehouse";                    
                $result = mysqli_query($dbc,$q) or die(mysql_error());
                
                echo '<select name="warehouse">';
                echo '<option value="0" selected="selected">- Select Warehouse -</option>';
                while ($row = mysqli_fetch_assoc($result))
                {
                        echo "<option value='{$row['WarehouseName']}'>{$row['WarehouseName']}</option>";
		}
		?>
		</select>
		<br />
			<strong>Required Date of Delivery:</strong>
			<input size="20" type="date" name="ReqDate" >
		 <input type="submit" name="First" value="Select" />
		 

	    </form>
	    <form action="PurchaseOrder.php" method="post">
			</center>
			
			
			<!--<input type="submit" name="action" value="Select"/>-->
       <!--</form> -->
			<br />
			
			<br />
			<hr>
			<br />
			<?php
			$y = 0;
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$action = trim($_POST["action"]);
				$vendor = trim($_POST["vendor"]);
				//echo $vendor;
				$ReqDate = trim($_POST["ReqDate"]);
				$warehouse = trim($_POST["warehouse"]);
				
			
				//if($action == 'Select')
				//{				
					$q = "SELECT * FROM Vendor WHERE Vendor_ID = '$vendor'";
					$r = mysqli_query($dbc,$q) or die(mysqli_error());
					$row = mysqli_fetch_assoc($r);
					
					$_SESSION['status'] = "Shipped";
					$_SESSION['vendorname'] = $row['VendorName'];
                                        $_SESSION['address'] = $row['Address'];
                                        $_SESSION['city'] = $row['City'];
                                        $_SESSION['state'] = $row['State'];
                                        $_SESSION['zip'] = $row['Zip'];
					$_SESSION['vendID'] = $row['Vendor_ID'];
					$_SESSION['status'] = "Outstanding";
                                        
                                                if (isset($_SESSION['vendorname'])) echo "Parts sold by ".$_SESSION['vendorname'];
			}
			?>
    
        <div id="readroot" style="display: none">

            <input type="button" value="Remove Part"
                   onclick="this.parentNode.parentNode.removeChild(this.parentNode);" /><br /><br />

            
	     <?php
	        $vendorname = $_SESSION['vendorname'];
		$q = "SELECT * FROM Parts WHERE Vendor = '$vendorname'";       
		$result = mysqli_query($dbc,$q) or die(mysql_error());
	
		$dropdown = "<tr><td>Select Part:</td><td><select name='partid[]'>";
		$dropdown .= '<option value="" selected="selected">- Select Part -</option>';
		while($row = mysqli_fetch_assoc($result)) 
		{
			$Pname .= $row['Part_ID'];
			$Pname .= " ";
			$Pname .= $row['Description'];
			
			$dropdown .= "\r\n<option value='{$row['Part_ID']}'>{$Pname}</option>";
			
			$Pname = NULL;
		}
		$dropdown .= "\r\n</select></td></tr>";
		echo $dropdown;
		//echo $_SESSION['city'];
		
	    ?>
	    
	    <br />
	    Quantity:
	    <input name="quantity[]" value="" />
	    
        </div>

        <!--<form method="post" action="SellParts.php">-->

            <span id="writeroot"></span>

            <input type="button" onclick="moreFields()" value="New Part" />
            <input type="submit" name="action" value="Submit" />

        </form>
	
	
	<?php
	
	//echo $_SESSION['address'];
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'Submit')
	{
	    echo $_SESSION['address'];
	    $address = $_SESSION['address'];
	    echo "Test";
	    echo $_SESSION['address'];;
	    echo $vendID;
	    $s="INSERT INTO PurchaseOrder (Vendor_ID, Address, City, State, Zip, ReqDate, Status, Flag, WarehouseName)
	    VALUES ('$vendID', '$address', '$city','$state', '$zip', '$ReqDate', '$status', '1', '$warehouse')";
	    mysqli_query($dbc,$s) or die (mysqli_error($dbc));
		$s = "SELECT OrderNum FROM PurchaseOrder WHERE Flag=1";
		//$s = "SELECT OrderNum FROM CustOrder WHERE Cust_ID = '$CustID' AND
		//	Address = '$address' AND City = '$city' AND State = '$state'
		//	AND Zip = '$zip' AND ReqDate = '$ReqDate' AND Status = '$status'";
	    $result = mysqli_query($dbc,$s) or die (mysqli_error($dbc)); //The Flag is only set to 1 long enough to get the OrderNum for table building
		$ORDER = mysqli_fetch_assoc($result);
		$OID = $ORDER['OrderNum'];
		//echo $OID;
		//echo "--";
		
	    $s = "UPDATE PurchaseOrder SET Flag=0 WHERE OrderNum = '$OID'";
	    mysqli_query($dbc,$s) or die (mysqli_error($dbc)); //Set Flag to 0
		
	   
	    //$PID = $_POST['partid'];
	    //$quantity = $_POST['quantity'];
	    //echo $_POST['partid'][1];
	    $size = count($_POST['partid']);
	    //echo "size";
	    //echo $size;
	    for($x = 1; $x < $size; $x++){
			
			//echo "<br />";
			//echo "Test";
			$PID = $_POST['partid'][$x];
			$QUAN = $_POST['quantity'][$x];
			$s = "SELECT * FROM Parts WHERE Part_ID = '$PID'";
			$r = mysqli_query($dbc,$s) or die(mysqli_error($dbc));
			$row = mysqli_fetch_assoc($r);
			//echo $row['Part_ID'];
			//echo "<br />";
			$UOM = $row['UnitOfMeasure'];
			//echo $UOM;
			//echo "<br />$";
			$PRICE = $row['Price'];
			//echo $PRICE;
			//echo "<br />";
			
			$s = "INSERT INTO POItem (Part_ID, Quantity, UnitOfMeasure, Price, OrderNum)
			VALUES ('$PID', '$QUAN', '$UOM', '$PRICE', '$OID')";
			mysqli_query($dbc,$s);
			//echo $PID;
			//echo "<br />";
			//echo $QUAN;
	    }
	    echo "<br /> <center> Purchase Order Placed </center>";
	}
	?>
    </body>
</html>

