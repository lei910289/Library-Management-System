<?php 
	$Book_id = $_POST['Book_id'];
	$Branch_id = $_POST['Branch_id'];

	date_default_timezone_set("America/Chicago");
	$today = date("Y-m-d");
	$date1=date_create($today);
	$date2=date_create("2013-12-12");
	$diff=date_diff($date1,$date2);
	




	echo "<hr>";
	echo "Please log in to check out!</br>";
	echo "<form action='book_loan.php' method='post'>
			Card Number<input type='text' name='card_num'>
			<input type='hidden' name='Book_id' value='$Book_id'>
			<input type='hidden' name='Branch_id' value='$Branch_id'></br>
			<input type='submit' value='Submit to checkout!'>
	</form>";
	echo "<hr>";
	echo "Don't have a card number?</br>";
	echo "<a href='library.html'><button>Sign up Now!</button></a>";
	echo "<hr>";
 ?>