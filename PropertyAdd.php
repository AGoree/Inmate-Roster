<?php
include_once'header.php';
include_once'functions/Property.php';
$propNo = getIfSet ( "propNo" );
$pType = getIfSet ( "pType" );
$pRooms = getIfSet ( "pRooms" );
$pRent = getIfSet ( "pRent" );
$pAdd1 = getIfSet ( "pAdd1" );
$pAdd2 = getIfSet ( "pAdd2" );
$pCity = getIfSet ( "pCity" );
$pState = getIfSet ( "pState" );
$pClient = getIfSet ( "pClient" );
$pZip = getIfSet ( "pZip" );
$fNM = getIfSet ( "fNM" );
$pAddID = getIfSet("pAddID");

if (isValid_and_set ( "propNo" ) && is_numeric ( $_GET ['propNo'] ) && isValid_and_set ( "pType" ) && isValid_and_set ( "pRooms" ) && isValid_and_set ( "pRent" ) && isValid_and_set ( "pAdd1" ) && isValid_and_set ( "pAdd2" ) && isValid_and_set ( "pCity" ) && is_numeric ( $_GET ['pState'] ) && is_numeric ( $_GET ['pClient'] ) && is_numeric ( $_GET ['pZip'] ) && is_numeric ( $_GET ['fNM'] )) {
    
    $insertResult = addProperty ( $propNo, $pType, $pRooms, $pRent, $pAdd1, $pAdd2, $pCity, $pState, $pZip, $pClient, $fNM );
    
    if ($insertResult == - 1)
        showErrorMessage ( "Failed to insert row ID $propNo. PK repeated" );
    elseif ($insertResult == 0)
        showErrorMessage ( "Failed to insert row ID $propNo" );
    else
        showInfoMessage ( "Successfully inserted row ID $propNo" );
} else if (isset ( $_GET ['btnAddProperty'] ))
    showErrorMessage ( "Please enter valid values" );

?>
<form name="frmAddProperty" action="propertyAdd.php">
	<table style="border: 0px; width: 350px">
		<tr>
			<td width="90">
				<strong>Property No:</strong>
			</td>
			<td>
				<input type="text" name=propNo value="<?= $propNo ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<strong>Type:</strong>
			</td>
			<td>
				<INPUT TYPE="radio" NAME="pType" VALUE="Flat" <?php echo ($pType  == 'Flat'?"CHECKED":"") ?>>Flat
					<INPUT TYPE="radio" NAME="pType" VALUE="Condo" <?php echo ($pType  == 'Condo'?"CHECKED":"") ?>>Condo 
						<INPUT TYPE="radio" NAME="pType" VALUE="House" <?php echo ($pType  == 'House'?"CHECKED":"") ?>>House
			</td>
		</tr>
		<tr>
			<td>
				<strong>Rooms:</strong>
			</td>
			<td>
				<input type="text" name=pRooms value="<?= $pRooms ?>"/>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Rent:</strong>
			</td>
			<td>
				<input type="text" name=pRent value="<?= $pRent ?>"/>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Address 1:</strong>
			</td>
			<td>
				<input type="text" name=pAdd1 value="<?= $pAdd1 ?>"/>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Address 2:</strong>
			</td>
			<td>
				<input type="text" name=pAdd2 value="<?= $pAdd2 ?>"/>

			</td>
		</tr>
		<tr>
			<td>
				<strong>Zip:</strong>
			</td>
			<td>
				<input type="text" name = pZip value="<?= $pZip ?>"/>

			</td>
		</tr>
		<tr>
			<td>
				<strong>City:</strong>
			</td>
			<td>
				<input type="text" name=pCity value="<?= $pCity ?>"/>

			</td>
		</tr>
		<tr>
			<td>
					<strong>State:</strong>
			</td>
			<td>
				<SELECT name=pState>
                    <option value="na">Select State</option>
				<?php
				$result = getAllStates ();
				while ( $rows = $result->fetch_assoc () ) {
    			echo "<option value=\"{$rows['state_id']}\"";
    				if ($pState == $rows ['state_id'])
        				echo " SELECTED ";
    
    			echo ">{$rows['abb']} - {$rows['name']}</option>";
}
?>
					</SELECT>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Client:</strong>
			</td>
			<td>
				<SELECT name=pClient>
					<option value="na">Select a Client</option>
					<?php
						$result = getAllClient();
						while ( $rows = $result->fetch_assoc () ) {
    
    					echo "<option value=\"{$rows['person_id']}\"";
    
    					if ($fNM == $rows ['person_id'])
       						 echo " SELECTED ";
    
   							 echo ">{$rows['first_name']}</option>";
    
}
?>
				</SELECT>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Staff:</strong>
			</td>
			<td>
				<SELECT name=fNM>
			<option value="na">Select Staff</option>
			<option value="null"></option>				

	
<?php
$result = getAllStaff();
while ( $rows = $result->fetch_assoc () ) {
    
    echo "<option value=\"{$rows['person_id']}\"";
    
    if ($fNM == $rows ['person_id'])
        echo " SELECTED ";
    
    echo ">{$rows['first_name']}</option>";
    
}
?>
				</SELECT>
				
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button type=submit name=btnAddProperty>Add Property</button>
				<button type=reset>Reset</button>
			</td>
		</tr>
	</table>
</form>

<?php
include_once 'footer.php';
?>