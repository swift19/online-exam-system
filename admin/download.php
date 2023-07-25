<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Download</title>
</head>
<body>

	<?php
		namespace Dompdf;
		require_once 'dompdf/autoload.inc.php';

		if(isset($_GET['exam_id']))
		{
			$dompdf = new Dompdf(); 
			$dompdf->loadHtml('
			<table border=1 align=center width=400>
			<tr><td>Name : </td><td>'.$_GET['exam_id'].'</td></tr>
			<tr><td>Email : </td><td>'.$_GET['exam_id'].'</td></tr>
			<tr><td>Age : </td><td>'.$_GET['exam_id'].'</td></tr>
			<tr><td>Country : </td><td>'.$_GET['exam_id'].'</td></tr>
			</table>
			');
			$dompdf->setPaper('A4', 'landscape');
			$dompdf->render();
			$dompdf->stream("",array("Attachment" => false));
			exit(0);
		}
	?>

</body>
</html>