<?php
function getAllProperty() {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query( "CALL propertyList()" );
    
    $dbc->close ();
    
    return $resultArr;
}
function getAllStaff() {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "CALL staffList()" );
    
    $dbc->close ();
    
    return $resultArr;
}

function getAllClient() {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "CALL clientList()" );
    
    $dbc->close ();
    
    return $resultArr;
}

function delProperty($rowID) {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "SELECT deletePropertyByID('$rowID') AS deleteResult" ) OR die($dbc->error);
    
    $result = $resultArr->fetch_assoc();
    
    $dbc->close();
    
    return $result ['deleteResult'];
}
function getAllAddress()
{
	$dbc = getDBC ();
    
    $resultArr = $dbc->query ( "CALL addressList()" );
    
    $dbc->close ();
    
    return $resultArr;
}
function getAllStates() {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "CALL stateList()" );
    
    $dbc->close ();
    
    return $resultArr;
}
function addProperty($propNo, $pType, $pRooms, $pRent, $pAdd1, $pAdd2, $pCity, $pState, $pZip, $pClient, $fNM) {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "SELECT insertProperty (\"$propNo\", \"$pType\", \"$pRooms\", \"$pRent\", \"$pAdd1\", \"$pAdd2\", \"$pCity\", \"$pState\", \"$pZip\",\"$pClient\",\"$fNM\") AS insertResult" );
    
    $result = $resultArr->fetch_assoc ();
    
    $dbc->close ();
    
    return $result ['insertResult'];
}

?>