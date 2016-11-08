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
	date_default_timezone_set("America/Chicago");
	$today = date("Y-m-d");
	$Card_num = trim($_POST['Card_num']);

	$sql= "SELECT * from BOOK_LOANS where Card_no=$Card_num";
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0){
		$sql2="SELECT Loan_id from BOOK_LOANS where Card_no=$Card_num and Due_date<'".$today."' and Date_in is null";
		$result2 = mysqli_query($conn,$sql2);
		if (mysqli_num_rows($result2) > 0) {
			echo "<hr>Can't pay the fines! This customer still have overdue books to return;<br>";
			echo "<a href='library.html'><button>Go Back!</button></a><hr>";
   		}else{
			
			$sql3 = "SELECT sum(fine_amt) from FINES, BOOK_LOANS where Card_no=$Card_num and BOOK_LOANS.Loan_id=FINES.loan_id and paid=0 group by Card_no";
			$result3 = mysqli_query($conn,$sql3);
			if (mysqli_num_rows($result3) > 0) {
				while($row3 =mysqli_fetch_assoc($result3)) {
    			echo "The balance of this customer is ".$row3["sum(fine_amt)"]."!<br>";
    			echo "<form action='pay.php' method='post'><input type='hidden' name='Card_num' value='$Card_num'><input type='submit' value='Pay!'></form>";
     			}
   			}else{
				echo "<hr>The balance of this customer is 0!<br>";
				echo "<a href='library.html'><button>Go Back!</button></a><hr>";
			}
		}
	}else{
		echo "<hr>This customer has no loan records!<br>";
		echo "<a href='library.html'><button>Go Back!</button></a><hr>";
	}
?>