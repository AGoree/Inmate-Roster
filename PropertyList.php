<?php       
include_once 'functions/Property.php';

include_once 'Header.php';

if (isset ( $_GET ['delRowId1'] )) {
    
    $rowID = $_GET ['delRowId1'];
    
    $deleteResult = delProperty($rowID);
    
    if ($deleteResult == - 1)
        showErrorMessage ( "Failed to delete row ID $rowID. FK Violation" );
    elseif ($deleteResult == 0)
        showErrorMessage ( "Failed to deleted row ID $rowID" );
    else
        showInfoMessage ( "Successfully deleted row ID $rowID" );
}
?>
<form action="PropertyList.php" method="post">
    <button type="submit" name="ASCc">Sort by last name (ASC)</button>
    <button type="submit" name="DESC">Sort by last name (DESC)</button>
</form>
<?php 
    if(isset($_POST['ASCc']))
    {
        $asc_query = "SELECT person_id,
         last_name,
         first_name,
         DOB,
         street1,
         street2,
         city,
         state.name AS sn,
         zip
      FROM person INNER JOIN address USING (address_id)
              INNER JOIN state USING (state_id) ORDER BY last_name ASC";
    }
?>
<?php

$result = getAllProperty();

if ($result->num_rows > 0) {
    // Print table's header
    echo '<table width="100%" border="1">
            <tr>
                <td><strong>No</strong></td>
                <td><strong>Type</strong></td>
                <td><strong>Rooms</strong></td>
                <td><strong>Rent</strong></td>
                <td><strong>Address</strong></td>
                <td><strong>Client</strong></td>
                <td><strong>Staff</strong></td>
                <td><strong>Delete?</strong></td>
            </tr>';
    
    // Print table's body
    while ( $rows = $result->fetch_assoc() ) {
        
        echo "<tr>
                <td>{$rows ['property_no']}</td>
                <td>{$rows ['prop_type']}</td>
                <td>{$rows ['rooms']}</td>
                <td>{$rows ['rent']}</td>
                    <td>
                        {$rows ['street1']}<BR>{$rows ['street2']}<BR>
                        {$rows ['city']}<BR>{$rows ['sn']}<BR>{$rows ['zip']}
                    </td>
                <td>{$rows ['client_no']}</td>
                <td>{$rows ['staff_no']}</td>
                <td>
                    <form action=PropertyList.php>
                        <input type=hidden name=delRowId1 value=\"{$rows ['property_no']}\" />
                        <button type=submit>Delete</button>
                    </form>
                </td>
            </tr>";
    }
    
    echo '</table>';
}
include_once 'footer.php';
?>

