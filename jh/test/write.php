<?
$db = new mysqli('eacinstance.cmqbzqnyewvh.us-east-2.rds.amazonaws.com', 'root', '11111111', 'eac');
$db->query('SET NAMES utf8');


$db->query('
	INSERT INTO chat(name, msg, date)
	VALUES(
		"' . $db->real_escape_string($_POST['name']) . '",
		"' . $db->real_escape_string($_POST['msg']) . '",
		NOW()
	)
');
?>
