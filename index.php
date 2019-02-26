<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Candidate Exercise - PHP Developer</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="css/bootstrap.min.css">
	  <script src="js/jquery.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>
	</head>
	<body>

		<div class="container">
			<h1>1. FizzBuzz</h1>

			<p>Write a PHP script that prints all integer values from 1 to 100.</p>
			<p>For multiples of three output "Fizz" instead of the value and for the multiples of five output "Buzz". Values which are multiples of both three and five should output as "FizzBuzz".</p>

		  	<pre>
		  		<?php show_source("code/FizzBuzz.php"); ?>
		  	</pre>

			<p><a class="btn btn-primary" data-toggle="collapse" href="#FizzBuzz" role="button" aria-expanded="false" aria-controls="FizzBuzz">Output</a></p>
			<div class="collapse" id="FizzBuzz">
				<pre>
			  		<?php require("code/FizzBuzz.php"); ?>
			  	</pre>
			</div>
		  	<hr />

		  	<h1>2. 500 Element Array</h1>
			<p>Write a PHP script to generate a random array of 500 integers (values of 1 – 500 inclusive). Randomly remove and discard an arbitary element from this newly generated array.</p>
			<p>Write the code to efficiently determine the value of the missing element. Explain your reasoning with comments.</p>
		  	<pre>
			  	<?php show_source("code/500ElementArray.php"); ?>
			</pre>

			<p><a class="btn btn-primary" data-toggle="collapse" href="#500ElementArray" role="button" aria-expanded="false" aria-controls="500ElementArray">Output</a></p>
			<div class="collapse" id="500ElementArray">
			  	<pre>
			  		<?php require("code/500ElementArray.php"); ?>
			  	</pre>
			</div>
		  	<hr />

		  	<h1>3. Database Connectivity</h1>
			<p>Demonstrate with PHP how you would connect to a MySQL (InnoDB) database and query for all records with the following fields: (name, age, job_title) from a table called 'exads_test'.</p>
			<p>Also provide an example of how you would write a sanitised record to the same table.</p>
			<pre>
			  	<?php show_source("code/DatabaseConnectivity.php"); ?>
			</pre>

			<p><a class="btn btn-primary" data-toggle="collapse" href="#DatabaseConnectivity" role="button" aria-expanded="false" aria-controls="DatabaseConnectivity">Output</a></p>
			<div class="collapse" id="DatabaseConnectivity">
			  	<pre>
			  		<?php require("code/DatabaseConnectivity.php"); ?>
			  	</pre>
			</div>
		  	<hr />

		  	<h1>4. Date Calculation</h1>
		  	<p>The Irish National Lottery draw takes place twice weekly on a Wednesday and a Saturday at 8pm.</p>
			<p>Write a function or class that calculates and returns the next valid draw date based on the current date and time AND also on an optionally supplied date and time.</p>
			<pre>
			  	<?php show_source("code/LotteryDraw.php"); ?>
			</pre>

			<p><a class="btn btn-primary" data-toggle="collapse" href="#LotteryDraw" role="button" aria-expanded="false" aria-controls="LotteryDraw">Output</a></p>
			<div class="collapse" id="LotteryDraw">
			  	<pre>
			  		<?php require("code/LotteryDraw.php"); ?>
			  	</pre>
			</div>
		  	<hr />

			<h1>5. A/B Testing</h1>
			<p>Exads would like to A/B test a number of promotional designs to see which provides the best conversion rate.</p>
			<p>Write a snippet of PHP code that redirects end users to the different designs based on the database table below. Extend the database model as needed.</p>
			<p>i.e. - 50% of people will be shown Design A, 25% shown Design B and 25% shown Design C. The code needs to be scalable as a single promotion may have upwards of 3 designs to test.</p>
			<pre>
			  	<?php show_source("code/AB_Testing.php"); ?>
			</pre>

			<p><a class="btn btn-primary" data-toggle="collapse" href="#AB_Testing" role="button" aria-expanded="false" aria-controls="AB_Testing">Output</a></p>
			<div class="collapse" id="AB_Testing">
			  	<pre>
			  		<?php require("code/AB_Testing.php"); ?>
			  	</pre>
			</div>
			<hr />
		</div>
	</body>
</html>
