<?php

function WriteHeaders($heading, $title)
{
	echo "
	<!doctype html> 
	<html lang = \"en\">
	<head>
		<meta charset = \"UTF-8\">
		<link rel=\"stylesheet\" type=\"text/css\" href=\"asst1Style.css\">
		<title>".$title."</title>
	</head>
	<body>
		<div class=\"top\">
			<p>".$heading."</p>
		</div>
	";
}

function WriteFooters()
{
	DisplayContactInfo();

	echo "
	</body>
	</html>
	";
}

function DisplayLabel($labelText)
{
	echo "<label>".$labelText."</label>";
}

function DisplayTextBox($name, $size, $value)
{
	echo "<Input type = text name = $name size = $size value = $value>";
}

function DisplayContactInfo()
{
	echo "<div class=\"bottom\"><footer>Questions?, Comments? <a href=\"rortelli27@student.sl.on.ca\">Email</a></footer></div>";
}

function DisplayImage($filename, $alt, $height, $width)
{
	echo "<img src=".$filename." alt=".$alt." style=\"width:".$width.";height:".$height.";\">";
}

function DisplayButton($name, $text, $filename, $alt, $value)
{
	if ($filename != "")
	{
		echo "<input type=\"image\" name=".$name." src=".$filename." alt=".$alt." value=".$value."></button>";
	}
	else
	{
		echo "<button type=Submit name=".$name." value=".$value.">".$text."</button>";
	}
}





?>