<?php 
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "library";
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if(mysqli_connect_errno()){
		echo "Failed to connect to MYSQL:".mysqli_connect_error()."<br/>";
	} 
	$Loan_id = ($_POST['Loan_id']);
	date_default_timezone_set("America/Chicago");
	$date_in = date("Y-m-d");

	$sql="UPDATE BOOK_LOANS SET Date_in='$date_in' WHERE Loan_id='$Loan_id'";
	if ($conn->query($sql) === TRUE) {
   		echo "<hr>Book checked in successfully!";
   		$sql2="SELECT * FROM BOOK_LOANS where Loan_id='$Loan_id'";
   		$result = mysqli_query($conn,$sql2);
		if (mysqli_num_rows($result) > 0) {
			$row =mysqli_fetch_assoc($result);
    		$table="<table border='4'><tr><td>Book Id</td><td>Branch Id</td><td>Card Number</td><td>Date Out</td><td>Due Date</td><td>Date In</td></tr><tr><td>".$row["Book_id"]."</td><td>".$row["Branch_id"]."</td><td>".$row["Card_no"]."</td><td>".$row["Date_out"]."</td><td>".$row["Due_date"]."</td><td>".$row["Date_in"]."</td></tr>";
    	}
    	$table = $table."</table>";
    	echo $table;
    	echo "<hr>";
    	echo "<a href='library.html'><button>Go Back!</button></a>";
	} else {
    	echo "Error updating record: " . $conn->error;
	}

?>