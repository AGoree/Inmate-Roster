<?php
include_once 'functions/Common.php';
include_once 'Header.php';
$dbc = getDBC();

if ($dbc->connect_errno) {
    
    showErrorMessage ( "Database Connection Error" );
    showErrorMessage ( "Error #: " . $dbc->connect_errno );
    showErrorMessage ( "Error Description: " . $dbc->connect_error );
} else {
    showInfoMessage ( "Successfully connected to database" );
}

include_once 'footer.php';
?>