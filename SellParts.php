<html>
<head>
    <!-- Group Project
            Programmer: Phil Graham -->
	<title>Sell Parts </title>
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
		include("headerSalesPerson.html");
	?>
        <h1>
            Sell Parts
        </h1>

	<form action="SellParts.php" method="post">
		<strong><center>Select a Customer to create a new Customer Order</strong>
		<?php
                DEFINE ('DB_USER', 'cs56712');
				DEFINE ('DB_PASSWORD', 'hr1S2dLXu');
				DEFINE ('DB_HOST','courses');
				DEFINE ('DB_NAME','cs56712');
        
                //make connection
                $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
                or die ('Could not connect to MySql:' .mysqli_connect_error() );
        
                $q = "SELECT * FROM Customers";			
                $result = mysqli_query($dbc,$q) or die(mysql_error());
                
                echo '<select name="customer">';
                echo '<option value="0" selected="selected">- Select Customer -</option>';
				 
                while ($row = mysqli_fetch_assoc($result))
                {
					$name = $row['First_Name'];
					$name .= " ";
					$name .= $row['Last_Name'];
					echo "<option value='{$row['Cust_ID']}'>{$name}</option>";
					$name = null;
	        }
		$y = 0;
                ?>
			</center>
			<br />	
			</select>
			<br />
			<strong>Required Date of Delivery:</strong>
			<input size="20" type="date" name="ReqDate" >
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
				$cust = trim($_POST["customer"]);
				$ReqDate = trim($_POST["ReqDate"]);
			
				//if($action == 'Select')
				//{				
					$q = "SELECT * FROM Customers WHERE Cust_ID = '$cust'";
					$r = mysqli_query($dbc,$q) or die(mysqli_error());
					$row = mysqli_fetch_assoc($r);
					
					$status = "Shipped";
					$CustID = $row['Cust_ID'];
					$firstname = $row['First_Name'];
					$lastname = $row['Last_Name'];
					$address = $row['Address'];
					$city = $row['City'];
					$state = $row['State'];
					$zip = $row['Zip'];
					$phone = $row['Phone_Number'];
					$cardname = $row['Card_Name'];
					$cardtype = $row['Card_Type'];
					$cardnum = $row['Card_Num'];
					$securecode = $row['Card_Security'];
					$expdate = $row['Exp_Date'];
					$cardaddress = $row['Card_Address'];
					$cardcity = $row['Card_City'];
					$cardstate = $row['Card_State'];
					$cardzip = $row['Card_Zip'];
					
					$name = $firstname;
					$name .= " ";
					$name .= $lastname;
					
						
				//}
				if ($name) echo "Select Parts for ".$name;
			}
			?>
    
        <div id="readroot" style="display: none">

            <input type="button" value="Remove Part"
                   onclick="this.parentNode.parentNode.removeChild(this.parentNode);" /><br /><br />

            
	     <?php
		$q = "SELECT * FROM Parts";       
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
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'Submit')
	{
	    $s="INSERT INTO CustOrder (Cust_ID, Address, City, 
	            State, Zip, ReqDate, Status, Flag)
	            VALUES ('$CustID', '$address', '$city', 
	            '$state', '$zip', '$ReqDate', '$status', '1')";
	    mysqli_query($dbc,$s) or die (mysqli_error($dbc));
		$s = "SELECT OrderNum FROM CustOrder WHERE Flag=1";
		//$s = "SELECT OrderNum FROM CustOrder WHERE Cust_ID = '$CustID' AND
		//	Address = '$address' AND City = '$city' AND State = '$state'
		//	AND Zip = '$zip' AND ReqDate = '$ReqDate' AND Status = '$status'";
	    $result = mysqli_query($dbc,$s) or die (mysqli_error($dbc)); //The Flag is only set to 1 long enough to get the OrderNum for table building
		$ORDER = mysqli_fetch_assoc($result);
		$OID = $ORDER['OrderNum'];
		//echo $OID;
		//echo "--";
		
	    $s = "UPDATE CustOrder SET Flag=0 WHERE OrderNum = '$OID'";
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
			
			$s = "INSERT INTO COItem (Part_ID, Quantity, UnitOfMeasure, Price, OrderNum)
			VALUES ('$PID', '$QUAN', '$UOM', '$PRICE', '$OID')";
			mysqli_query($dbc,$s);
			//echo $PID;
			//echo "<br />";
			//echo $QUAN;
	    }
	    echo "<br /> <center> Customer Order Placed </center>";
	}
	?>
    </body>
</html>

