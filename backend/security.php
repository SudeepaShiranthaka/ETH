
<?php

function _sanitizeinput($inputstring){

	$result = str_replace("<script>", "", $inputstring);
	$result = str_replace("</script>", "", $result);

	return $result;

}

?>