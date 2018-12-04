<!DOCTYPE html>
<html lang="ko">
<head>
<title>Ajax Polling Sample Code</title>
<meta charset="utf-8">
<script type="text/javascript" src="chat.js"></script>
<link rel="stylesheet" type="text/css" href="chat.css" />
</head>
<body>
<dl id="list"></dl>
<form onsubmit="chatManager.write(this); return false;">
	<input name="msg" id="msg" type="text" />
	<input name="btn" id="btn" type="submit" value="Input" />
</form>
</body>
</html>
