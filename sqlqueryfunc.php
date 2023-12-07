<?php

function _sqlqueryfunc_eh($query){
	global $mysqlobj;

	$result = mysqli_query($mysqlobj, $query);
	if (!$result){
		switch (mysqli_errno($mysqlobj)){
			case 1064:
				print "<p>En intern feil i SQL statementet";
				print "<p>SQL = ".$query;
				print "<p>Error - ".mysqli_error($mysqlobj);
				break;
			case 1062:
				print "<p>En intern feil i SQL statement, en verdi er påkrevet å være unik";
				print "<p>SQL = ".$query;
				print "<p>Error - ".mysqli_error($mysqlobj);
				break;
			default:
				print "<p>TIL STUDENT: Det er en feil i et kall til SQL, rapporter til veiledere.</p>";
				print "<p>SQL = ".$query;
				$errorno = mysqli_errno($mysqlobj);
				$errorstr = mysqli_error($mysqlobj);
				print "<p>ERROR mysqli_query() failed [$errorno] $errorstr";
				break;
		}
		mysqli_close($mysqlobj);
	 	die;
		exit();
	}
	else{
		return $result;
	}
}

?>

