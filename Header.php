<?php
include_once 'functions/Common.php';
?>
<style>
<!--
body {
	padding: 75px 0px 75px 0px;
}

a {
	text-decoration: none;
	color: #00F;
}

a:HOVER {
	text-decoration: underline;
	color: #00F;
}

a:ACTIVE {
	text-decoration: none;
	color: #00F;
}

.tblHdr {
	border: 0px solid black;
	width: 100%;
	padding: 10px 5px 5px 10px;
	display: inline;
}

table td {
	text-align: center;
	vertical-align: top;
	border: 1px solid black;
	padding: 5px;
}

input {
	width: 95%;
}

input[type="radio"] {
	align: left;
	width: 10%;
}
-->
</style>
<div style="position: fixed; top: 0px; width: 100%; background-color: #FFF; border-bottom: #005CE8 5px double;">
	<div style="display: inline;">
		<img src='icons/apache-php-mysql.jpg' height="58" />
	</div>
	<table class="tblHdr">
		<tr>
			<td>
				<a href="index.php"><img alt="" src="icons/database.png" width="18" height="18"> DB Status</a>
			</td>
			<td>
				<a href="PersonList.php"><img alt="" src="icons/person.png" width="18" height="18"> List of Persons</a>
			</td>
			<td>
				<a href="PersonAdd.php"><img alt="" src="icons/add.png" width="18" height="18"> Add Person</a>
			</td>
			<td>
				<a href="propertyList.php"><img alt="" src="icons/property.png" width="18" height="18"> List of Properties</a>
			</td>
			<td>
				<a href="propertyAdd.php"><img alt="" src="icons/add.png" width="18" height="18"> Add Property</a>
			</td>
		</tr>
	</table>
</div>