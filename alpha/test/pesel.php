<?php
function pesel($pesel) {
	if (strlen($pesel) == 11) {

			$rok = substr($pesel, 0, 2);
			$stulecie = substr($pesel, 2, 1);
			$miesiac = substr($pesel, 3, 1);
			$dzien = substr($pesel, 4, 2);
			$plec = substr($pesel, 9, 1);

				switch ($stulecie) {
					case 8:
					$stulecie = 18;
					$a = 0;
					break;
					case 9:
					$stulecie = 18;
					$a = 1;
					break;
					case 0:
					$stulecie = 19;
					$a = 0;
					break;
					case 1:
					$stulecie = 19;
					$a = 1;
					break;
					case 2:
					$stulecie = 20;
					$a = 0;
					break;
					case 3:
					$stulecie = 20;
					$a = 1;
					break;
					case 4:
					$stulecie = 21;
					$a = 0;
					break;
					case 5:
					$stulecie = 21;
					$a = 1;
					break;
					case 6:
					$stulecie = 22;
					$a = 0;
					default:
					$stulecie = 22;
					$a = 1;
					break;
				}
				$b = implode("",array($a,$miesiac));
				
				if ($plec % 2 == 0) {
					$plec = 'Kobieta';
				} else {
					$plec = 'Mężczyzna';
				}

				echo 'Urodziłeś się ' .$dzien. '-' .$b. '-' .$stulecie. $rok. '<br>Twoja płeć to: ' .$plec;

	} else {
	echo 'błędny pesel';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body>


<?php
if (isset($_POST['submit'])) {

$pesel = $_POST['pesel'];
pesel($pesel);

} else {
	?><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" />
		<input type="text" name="pesel" id="pesel" />
		<input type="submit" name="submit" value="wartość" />
	</form>
	<?php
}

?>
</body>
</html>