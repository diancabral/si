<?php

include 'classes/JurosSimples.php';

$jpin = new JurosSimples;

$jpin->J  = 12000;
$jpin->P  = false;
$jpin->i  = 500;
$jpin->ix = 'a.m.';
$jpin->n  = 60;

?>

<!DOCTYPE html>

	<html lang="en">

	<head>

		<meta charset="UTF-8">
		<title>Juros Simples</title>

		<style>

		body {

			font-size: 50px;

		}

		</style>

		<script type="text/x-mathjax-config">

			MathJax.Hub.Config({
				showProcessingMessages: false,
				showMathMenu: false,
				jax: ["input/TeX", "output/SVG"]

			});

		</script>

		<script type="text/javascript" async src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML"></script>

	</head>

	<body>

	<?php echo $jpin->resolver(); ?>

	</body>

</html>