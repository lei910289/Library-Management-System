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
	$Card_num = $_POST['Card_num'];
	$sql="SELECT FINES.loan_id from FINES, BOOK_LOANS where Card_no=$Card_num and Date_in is not null and BOOK_LOANS.Loan_id=FINES.loan_id and paid=0";
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
		while($row =mysqli_fetch_assoc($result)) {
			
			$loan_id=$row["loan_id"];
    		$sql2="UPDATE FINES SET paid=1 where loan_id=$loan_id";
    		mysqli_query($conn,$sql2);
     	}
     	echo "Payment completed!";
    	echo "<a href='library.html'><button>Go Back!</button></a>";
   	}else{
		echo "string";
	}



?>