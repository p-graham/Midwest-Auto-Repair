<html>
<head>
    <!-- 
            Programmer: Phil Graham -->
	<title>Customer Information </title>
	<script>
	function showhide(bchecked)
	{
		if(bchecked)
		{
			document.getElementById("myhide").style.display = "none";
		} 
		else
		{
			document.getElementById("myhide").style.display = "";
		}

	}
	</script>
	
	
    <?php
		include("headerSalesPerson.html");
	?>
        <h1>
            Customer Information
        </h1>
        <br />
		<form action="CustInfo.php" method="post">
		<strong><center>Select a Customer to edit their Information</strong>
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
            ?>
			</center>
			<br />	
			</select>
			<input type="submit" name="action" value="Edit"/>
		</form>
			<br />
			<hr>
			<br />
			<strong>Or enter information to add a new Customer</strong>
            <br />
			<br />
			<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$action = trim($_POST["action"]);
				$cust = trim($_POST["customer"]);
			
				if($action == 'Edit')
				{				
					$q = "SELECT * FROM Customers WHERE Cust_ID = '$cust'";
					$r = mysqli_query($dbc,$q) or die(mysqli_error());
					$row = mysqli_fetch_assoc($r);
					
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
					
						if ($name) echo "Editing Vendor information for ".$name;
				}
			}
		?>
		<br />
		<form action="CustInfo.php" method="post">
			<fieldset>
			<legend>Customer Information</legend>
				<table>
					<tr>
						<td>First Name: </td>
						<td><input size="20" type="text" name="firstname" value="<?php echo $firstname; ?>"/></td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td><input size="20" type="text" name="lastname" value="<?php echo $lastname; ?>"/></td>
					</tr>
					<tr>
						<td>Address:</td>
						<td><input size="20" type="text" name="address" value="<?php echo $address; ?>"/></td>
					</tr>
					<tr>
						<td>City:</td>
						<td><input size="20" type="text" name="city" value="<?php echo $city; ?>"/></td>
					</tr>
					<tr>
						<td>State:</td>
						<td>
							<select name="state">
								<option value="AL" <?php if($state == 'AL'){echo("selected");}?>>AL</option>
								<option value="AK" <?php if($state == 'AK'){echo("selected");}?>>AK</option>
								<option value="AZ" <?php if($state == 'AZ'){echo("selected");}?>>AZ</option>
								<option value="AR" <?php if($state == 'AR'){echo("selected");}?>>AR</option>
								<option value="CA" <?php if($state == 'CA'){echo("selected");}?>>CA</option>
								<option value="CO" <?php if($state == 'CO'){echo("selected");}?>>CO</option>
								<option value="CT" <?php if($state == 'CT'){echo("selected");}?>>CT</option>
								<option value="DE" <?php if($state == 'DE'){echo("selected");}?>>DE</option>
								<option value="FL" <?php if($state == 'FL'){echo("selected");}?>>FL</option>
								<option value="GA" <?php if($state == 'GA'){echo("selected");}?>>GA</option>
								<option value="HI" <?php if($state == 'HI'){echo("selected");}?>>HI</option>
								<option value="ID" <?php if($state == 'ID'){echo("selected");}?>>ID</option>
								<option value="IL" <?php if($state == 'IL'){echo("selected");}?>>IL</option>
								<option value="IN" <?php if($state == 'IN'){echo("selected");}?>>IN</option>
								<option value="IA" <?php if($state == 'IA'){echo("selected");}?>>IA</option>
								<option value="KS" <?php if($state == 'KS'){echo("selected");}?>>KS</option>
								<option value="KY" <?php if($state == 'KY'){echo("selected");}?>>KY</option>
								<option value="LA" <?php if($state == 'LA'){echo("selected");}?>>LA</option>
								<option value="ME" <?php if($state == 'ME'){echo("selected");}?>>ME</option>
								<option value="MD" <?php if($state == 'MD'){echo("selected");}?>>MD</option>
								<option value="MA" <?php if($state == 'MA'){echo("selected");}?>>MA</option>
								<option value="MI" <?php if($state == 'MI'){echo("selected");}?>>MI</option>
								<option value="MN" <?php if($state == 'MN'){echo("selected");}?>>MN</option>
								<option value="MS" <?php if($state == 'MS'){echo("selected");}?>>MS</option>
								<option value="MO" <?php if($state == 'MO'){echo("selected");}?>>MO</option>
								<option value="MT" <?php if($state == 'MT'){echo("selected");}?>>MT</option>
								<option value="NE" <?php if($state == 'NE'){echo("selected");}?>>NE</option>
								<option value="NV" <?php if($state == 'NV'){echo("selected");}?>>NV</option>
								<option value="NH" <?php if($state == 'NH'){echo("selected");}?>>NH</option>
								<option value="NJ" <?php if($state == 'NJ'){echo("selected");}?>>NJ</option>
								<option value="NM" <?php if($state == 'NM'){echo("selected");}?>>NM</option>
								<option value="NY" <?php if($state == 'NY'){echo("selected");}?>>NY</option>
								<option value="NC" <?php if($state == 'NC'){echo("selected");}?>>NC</option>
								<option value="ND" <?php if($state == 'ND'){echo("selected");}?>>ND</option>
								<option value="OH" <?php if($state == 'OH'){echo("selected");}?>>OH</option>
								<option value="OK" <?php if($state == 'OK'){echo("selected");}?>>OK</option>
								<option value="OR" <?php if($state == 'OR'){echo("selected");}?>>OR</option>
								<option value="PA" <?php if($state == 'PA'){echo("selected");}?>>PA</option>
								<option value="RI" <?php if($state == 'RI'){echo("selected");}?>>RI</option>
								<option value="SC" <?php if($state == 'SC'){echo("selected");}?>>SC</option>
								<option value="SD" <?php if($state == 'SD'){echo("selected");}?>>SD</option>
								<option value="TN" <?php if($state == 'TN'){echo("selected");}?>>TN</option>
								<option value="TX" <?php if($state == 'TX'){echo("selected");}?>>TX</option>
								<option value="UT" <?php if($state == 'UT'){echo("selected");}?>>UT</option>
								<option value="VT" <?php if($state == 'VT'){echo("selected");}?>>VT</option>
								<option value="VA" <?php if($state == 'VA'){echo("selected");}?>>VA</option>
								<option value="WA" <?php if($state == 'WA'){echo("selected");}?>>WA</option>
								<option value="WV" <?php if($state == 'WV'){echo("selected");}?>>WV</option>
								<option value="WI" <?php if($state == 'WI'){echo("selected");}?>>WI</option>
								<option value="WY" <?php if($state == 'WY'){echo("selected");}?>>WY</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Zip Code:</td>
						<td><input size="5" type="text" name="zip" value="<?php echo $zip; ?>"/></td>
					</tr>
					<tr>
						<td>Phone Number: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td><input size="10" type="text" name="phone" value="<?php echo $phone; ?>"/></td>
					</tr>
					</table>
			</fieldset>
			<br />
			<fieldset>
				<legend>Card Information</legend>
				<table>
				<tr>
					<td>Name as it Appears on Card:&nbsp;</td>
						<td><input size="30" type="text" name="cardname" value="<?php echo $cardname; ?>"/></td>
					</tr>
					<tr>
					<tr>
						<td>Card Type:</td>
						<td>
							<select name="cardtype">
								<option value="Visa" <?php if($cardtype == 'SC'){echo("selected");}?>> Visa </option>
								<option value="MasterCard" <?php if($cardtype == 'SC'){echo("selected");}?>> Master Card </option>
								<option value="Discover" <?php if($cardtype == 'SC'){echo("selected");}?>> Discover</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Card Number:</td>
						<td><input size="16" type="text" name="cardnum" value="<?php echo $cardnum; ?>"/></td>
					</tr>
					<tr>
						<td>Card Security Code:</td>
						<td><input size="3" type="text" name="securecode" value="<?php echo $securecode; ?>"/></td>
					</tr>
					<tr>
						<td>Expiration Date:</td>
						<td><input size="20" type="date" name="expdate" value="<?php echo $expdate; ?>"/></td>
					</tr>
				</table>
			</fieldset>
			<br/>
			<input type="checkbox" name ="check" id ="check" value = "checked" onclick="showhide(this.checked);"/>
			<strong>Check this box if Payment Address is the same as Customer Address</strong>
			<br />
			<br />
			
			<div id="myhide"> 
			<fieldset>
			<legend>Payment Address</legend>
			<table>
					<tr>
						<td>Address:</td>
						<td><input size="20" type="text" name="cardaddress" value="<?php echo $cardaddress; ?>"/></td>
					</tr>
					<tr>
						<td>City:</td>
						<td><input size="20" type="text" name="cardcity" value="<?php echo $cardcity; ?>"/></td>
					</tr>
					<tr>
						<td>State: </td>
						<td>
							<select name="cardstate">
								<option value="AL" <?php if($cardstate == 'AL'){echo("selected");}?>>AL</option>
								<option value="AK" <?php if($cardstate == 'AK'){echo("selected");}?>>AK</option>
								<option value="AZ" <?php if($cardstate == 'AZ'){echo("selected");}?>>AZ</option>
								<option value="AR" <?php if($cardstate == 'AR'){echo("selected");}?>>AR</option>
								<option value="CA" <?php if($cardstate == 'CA'){echo("selected");}?>>CA</option>
								<option value="CO" <?php if($cardstate == 'CO'){echo("selected");}?>>CO</option>
								<option value="CT" <?php if($cardstate == 'CT'){echo("selected");}?>>CT</option>
								<option value="DE" <?php if($cardstate == 'DE'){echo("selected");}?>>DE</option>
								<option value="FL" <?php if($cardstate == 'FL'){echo("selected");}?>>FL</option>
								<option value="GA" <?php if($cardstate == 'GA'){echo("selected");}?>>GA</option>
								<option value="HI" <?php if($cardstate == 'HI'){echo("selected");}?>>HI</option>
								<option value="ID" <?php if($cardstate == 'ID'){echo("selected");}?>>ID</option>
								<option value="IL" <?php if($cardstate == 'IL'){echo("selected");}?>>IL</option>
								<option value="IN" <?php if($cardstate == 'IN'){echo("selected");}?>>IN</option>
								<option value="IA" <?php if($cardstate == 'IA'){echo("selected");}?>>IA</option>
								<option value="KS" <?php if($cardstate == 'KS'){echo("selected");}?>>KS</option>
								<option value="KY" <?php if($cardstate == 'KY'){echo("selected");}?>>KY</option>
								<option value="LA" <?php if($cardstate == 'LA'){echo("selected");}?>>LA</option>
								<option value="ME" <?php if($cardstate == 'ME'){echo("selected");}?>>ME</option>
								<option value="MD" <?php if($cardstate == 'MD'){echo("selected");}?>>MD</option>
								<option value="MA" <?php if($cardstate == 'MA'){echo("selected");}?>>MA</option>
								<option value="MI" <?php if($cardstate == 'MI'){echo("selected");}?>>MI</option>
								<option value="MN" <?php if($cardstate == 'MN'){echo("selected");}?>>MN</option>
								<option value="MS" <?php if($cardstate == 'MS'){echo("selected");}?>>MS</option>
								<option value="MO" <?php if($cardstate == 'MO'){echo("selected");}?>>MO</option>
								<option value="MT" <?php if($cardstate == 'MT'){echo("selected");}?>>MT</option>
								<option value="NE" <?php if($cardstate == 'NE'){echo("selected");}?>>NE</option>
								<option value="NV" <?php if($cardstate == 'NV'){echo("selected");}?>>NV</option>
								<option value="NH" <?php if($cardstate == 'NH'){echo("selected");}?>>NH</option>
								<option value="NJ" <?php if($cardstate == 'NJ'){echo("selected");}?>>NJ</option>
								<option value="NM" <?php if($cardstate == 'NM'){echo("selected");}?>>NM</option>
								<option value="NY" <?php if($cardstate == 'NY'){echo("selected");}?>>NY</option>
								<option value="NC" <?php if($cardstate == 'NC'){echo("selected");}?>>NC</option>
								<option value="ND" <?php if($cardstate == 'ND'){echo("selected");}?>>ND</option>
								<option value="OH" <?php if($cardstate == 'OH'){echo("selected");}?>>OH</option>
								<option value="OK" <?php if($cardstate == 'OK'){echo("selected");}?>>OK</option>
								<option value="OR" <?php if($cardstate == 'OR'){echo("selected");}?>>OR</option>
								<option value="PA" <?php if($cardstate == 'PA'){echo("selected");}?>>PA</option>
								<option value="RI" <?php if($cardstate == 'RI'){echo("selected");}?>>RI</option>
								<option value="SC" <?php if($cardstate == 'SC'){echo("selected");}?>>SC</option>
								<option value="SD" <?php if($cardstate == 'SD'){echo("selected");}?>>SD</option>
								<option value="TN" <?php if($cardstate == 'TN'){echo("selected");}?>>TN</option>
								<option value="TX" <?php if($cardstate == 'TX'){echo("selected");}?>>TX</option>
								<option value="UT" <?php if($cardstate == 'UT'){echo("selected");}?>>UT</option>
								<option value="VT" <?php if($cardstate == 'VT'){echo("selected");}?>>VT</option>
								<option value="VA" <?php if($cardstate == 'VA'){echo("selected");}?>>VA</option>
								<option value="WA" <?php if($cardstate == 'WA'){echo("selected");}?>>WA</option>
								<option value="WV" <?php if($cardstate == 'WV'){echo("selected");}?>>WV</option>
								<option value="WI" <?php if($cardstate == 'WI'){echo("selected");}?>>WI</option>
								<option value="WY" <?php if($cardstate == 'WY'){echo("selected");}?>>WY</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Zip Code:</td>
						<td><input size="5" type="text" name="cardzip" value="<?php echo $cardzip; ?>"/></td>
					</tr>
				</table>
			</fieldset>
			</div>
			
			
			
			<br />
			<br />
            <input type="submit" name="action" value="Submit"/>
            <input type="reset" value="Reset"/> <br />
			 </form>
			 
			<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'Submit')
			{
				$firstname = trim($_POST["firstname"]);
				$lastname = trim($_POST["lastname"]);
				$address = trim($_POST["address"]);
				$city = trim($_POST["city"]);
				$state = trim($_POST["state"]);
				$zip = trim($_POST["zip"]);
				$phone = trim($_POST["phone"]);
				$cardname = trim($_POST["cardname"]);
				$cardtype = trim($_POST["cardtype"]);
				$cardnum = trim($_POST["cardnum"]);
				$securecode = trim($_POST["securecode"]);
				$expdate = trim($_POST["expdate"]);
				
				$cardaddress = trim($_POST["cardaddress"]);
				$cardcity = trim($_POST["cardcity"]);
				$cardstate = trim($_POST["cardstate"]);
				$cardzip = trim($_POST["cardzip"]);
				
				$check = trim($_POST["check"]);
				
				if(!$firstname | !$lastname | !$address | !$city | !$state
					| !$zip | !$phone | !$cardname | !$cardtype | !$cardnum | 
					!$securecode | !$expdate) 			//makes sure fields are filled in
					{ die('You did not fill in a required Customer Information.'); }
				
				if(isset($check) && $check == 'checked')
				{
					$cardaddress = $address;
					$cardcity = $city;
					$cardstate = $state;
					$cardzip = $zip;
				}
				if( $check != 'checked')
				{
					if(!$cardaddress | !$cardcity | !$cardstate | !$cardzip)			//makes sure fields are filled in
					{ die('You did not fill in a required Payment Address.'); }
				}
			   
			   //set encoding
				mysqli_set_charset($dbc, 'utf8');
				
            $s="INSERT INTO Customers (First_Name, 
				Last_Name, Address, City, State, Zip, Phone_Number,Card_Name,
				Card_Type, Card_Num, Card_Security, Exp_Date, Card_Address,
				Card_City, Card_State, Card_Zip)
				VALUES ('$firstname', '$lastname', '$address', '$city', 
				'$state', '$zip', '$phone', '$cardname', '$cardtype', '$cardnum', '$securecode',
				'$expdate', '$cardaddress', '$cardcity', '$cardstate', '$cardzip')";
			
			$q = "SELECT * FROM Customers 
					WHERE First_Name = '$firstname'
					AND Last_Name = '$lastname'";
					
            $result = mysqli_query($dbc,$q) or die(mysql_error());
			
			while($row = mysqli_fetch_assoc($result)) 
               {
					if($row['First_Name'] && $row['Last_Name'])
					{
					$s = "UPDATE Customers SET 
						First_Name = '$firstname', Last_Name = '$lastname', 
						Address = '$address', City = '$city' , State = '$state', 
						Zip = '$zip', Phone_Number = '$phone', Card_Name = '$cardname',
						Card_Type = '$cardtype', Card_Num = '$cardnum', 
						Card_Security = '$securecode', Exp_Date = '$expdate',
						Card_Address = '$cardaddress', Card_City = '$cardcity', 
						Card_State ='$cardstate', Card_Zip = '$cardzip' 
						WHERE First_Name = '$firstname'
						AND Last_Name = '$lastname'";
					}
			   }
				
			mysqli_query($dbc,$s) or die (mysqli_error($dbc));                             //result
			   
			   echo "<br /> <center> Customer successfully added </center>";
               
			   mysqli_close($dbc);
			}
			?>	
		<br />
    </div>
</body>
</html>

