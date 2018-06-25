<?php
include_once 'functions/Person.php';

include_once 'Header.php';



if (isset ( $_GET ['delRowId'] )) {
    
    $rowID = $_GET ['delRowId'];
    
    $deleteResult = delPerson ( $rowID );
    
    if ($deleteResult == - 1)
        showErrorMessage ( "Failed to delete row ID $rowID. FK Violation" );
    elseif ($deleteResult == 0)
        showErrorMessage ( "Failed to deleted row ID $rowID" );
    else
        showInfoMessage ( "Successfully deleted row ID $rowID" );
}
?>
<form action="personList.php" method="post">

    <button type="submit" name="ASCc" onclick="http://localhost/FinalProj/personList.php/?sort='last_name'&order=ASC">Sort by last name (ASC)</button>
    <button type="submit" name="DESC">Sort by last name (DESC)</button>

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
              INNER JOIN state USING (state_id) ORDER BY last_name";
        $result = executeQuery($asc_query);
    }
    elseif(isset($_POST['DESC']))
    {
        $DESC_query = "SELECT person_id,
         last_name,
         first_name,
         DOB,
         street1,
         street2,
         city,
         state.name AS sn,
         zip
      FROM person INNER JOIN address USING (address_id)
              INNER JOIN state USING (state_id) ORDER BY last_name DESC";
        $result = executeQuery($DESC_query);
    }

    function executeQuery($query)
{
    $dbc = getDBC ();
    $result = mysqli_query($dbc,$query);
    return $result;
}

?>
</form>
<?php

$result = getAllPerson();

if ($result->num_rows > 0) {
    // Print table's header
    echo '<table width="100%" border="1">
            <tr>
                <td><strong>ID</strong></td>
                <td><strong>Last Name</strong></td>
                <td><strong>First Name</strong></td>
                <td><strong>DOB</strong></td>
                <td Colspan=4><strong>Address</strong></td>
                <td><strong>Delete?</strong></td>
            </tr>';
    
    // Print table's body
    while ( $rows = $result->fetch_assoc() ) {
        
        echo "<tr>
                <td>{$rows ['person_id']}</td>
                <td>{$rows ['last_name']}</td>
                <td>{$rows ['first_name']}</td>
                <td>{$rows ['DOB']}</td>
                <td>{$rows ['street1']}<BR>{$rows ['street2']}</td>
                <td>{$rows ['city']}</td>
                <td>{$rows ['sn']}</td>
                <td>{$rows ['zip']}</td>
                <td>
                    <form action=PersonList.php>
                        <input type=hidden name=delRowId value=\"{$rows ['person_id']}\" />
                        <button type=submit>Delete</button>
                    </form>
                </td>
            </tr>";
    }
    
    echo '</table>';
}
include_once 'footer.php';
?>