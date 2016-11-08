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
	$date_out = date("Y-m-d");
	$due_date = date("Y-m-d", strtotime($date_out. ' + 13 days'));
	$Card_num=$_POST['card_num'];
	$Book_id=$_POST['Book_id'];
	$Branch_id=$_POST['Branch_id'];
	
	$sql = "SELECT card_no FROM BORROWER where card_no='".$Card_num."'";
	$result = mysqli_query($conn,$sql);
	$isExist = false;

	if (mysqli_num_rows($result) > 0) {
    	$isExist=true;
	}

	if($isExist){
		$sql2="SELECT count(*) from BOOK_LOANS where Card_no='".$Card_num."' and date_in is null";
		$result2 = mysqli_query($conn,$sql2);
		if (mysqli_num_rows($result2) > 0){
				$row2 =mysqli_fetch_assoc($result2);
				$num=$row2["count(*)"];
			}else{
				$num=0;
			}


		if($num<3){
			$sql = "INSERT into BOOK_LOANS(Book_id, Branch_id, Card_no, Date_out, Due_date) values ('$Book_id','$Branch_id','$Card_num','$date_out','$due_date')";
			if ($conn->query($sql) === TRUE) {
				echo "<hr>New record created successfully</br>";
				echo "Book Id: ".$Book_id."<br>";
				echo "Branch Id: ".$Branch_id."<br>";
				echo "Card Number: ".$Card_num."<br>";
				echo "Date Out: ".$date_out."<br>";
				echo "Due Date: ".$due_date."<br>";
				echo "<hr>";
				echo "<a href='library.html'><button>Go Back!</button></a>";

			} else {
   				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}else{
			echo "<hr>You have borrowed three books!<br>";
			echo "<a href='library.html'><button>Go Back!</button></a><hr>";
		}
	}else{
		echo "<hr>Your card number doesn't exist! </br>";
		echo "<form action='login.php' method='post' style='display: inline'><input type='hidden' name='Book_id' value='$Book_id'><input type='hidden' name='Branch_id' value='$Branch_id'><input type='submit' value='Go Back!'></form><hr>";
	}
 ?>