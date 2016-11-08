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
	$Book_id = trim($_POST['Book_id']);
	$Title = trim($_POST['Title']);
	$Author = trim($_POST['Author']);

	
	if($Book_id=="" && $Title == "" && $Author == ""){
		echo "Please enter Book_id or Title or Author for searching! <br/>";
	}else if($Book_id!="" && $Title == "" && $Author == ""){
		$sql1 = "SELECT BOOK.Book_id, BOOK.Title, BOOK_AUTHORS.Author_name, BOOK_COPIES.Branch_id, BOOK_COPIES.No_of_copies from BOOK, BOOK_AUTHORS, BOOK_COPIES where BOOK.Book_id like '%".$Book_id."%' and BOOK_AUTHORS.Book_id=BOOK.Book_id and BOOK_COPIES.Book_id=BOOK.Book_id";
	}else if($Book_id=="" && $Title != "" && $Author == ""){
		$sql1 = "SELECT BOOK.Book_id, BOOK.Title, BOOK_AUTHORS.Author_name, BOOK_COPIES.Branch_id, BOOK_COPIES.No_of_copies from BOOK, BOOK_AUTHORS, BOOK_COPIES where BOOK.Title like '%".$Title."%' and BOOK_AUTHORS.Book_id=BOOK.Book_id and BOOK_COPIES.Book_id=BOOK.Book_id";
	}else if($Book_id=="" && $Title == "" && $Author != ""){
		$sql1 = "SELECT BOOK.Book_id, BOOK.Title, BOOK_AUTHORS.Author_name, BOOK_COPIES.Branch_id, BOOK_COPIES.No_of_copies from BOOK, BOOK_AUTHORS, BOOK_COPIES where BOOK_AUTHORS.Author_name like '%".$Author."%' and BOOK_AUTHORS.Book_id=BOOK.Book_id and BOOK_COPIES.Book_id=BOOK_AUTHORS.Book_id";
	}else if($Book_id!="" && $Title != "" && $Author == ""){
		$sql1 = "SELECT BOOK.Book_id, BOOK.Title, BOOK_AUTHORS.Author_name, BOOK_COPIES.Branch_id, BOOK_COPIES.No_of_copies from BOOK, BOOK_AUTHORS, BOOK_COPIES where BOOK.Book_id like '%".$Book_id."%' and BOOK.Title like'%".$Title."%' and BOOK_AUTHORS.Book_id=BOOK.Book_id and BOOK_COPIES.Book_id=BOOK.Book_id";
	}else if($Book_id!="" && $Title == "" && $Author != ""){
		$sql1 = "SELECT BOOK.Book_id, BOOK.Title, BOOK_AUTHORS.Author_name, BOOK_COPIES.Branch_id, BOOK_COPIES.No_of_copies from BOOK, BOOK_AUTHORS, BOOK_COPIES where BOOK.Book_id like '%".$Book_id."%' and BOOK_AUTHORS.Book_id=BOOK.Book_id and BOOK_AUTHORS.Author_name like '%".$Author."%' and BOOK_COPIES.Book_id=BOOK.Book_id";
	}else if($Book_id=="" && $Title != "" && $Author != ""){
		$sql1 = "SELECT BOOK.Book_id, BOOK.Title, BOOK_AUTHORS.Author_name, BOOK_COPIES.Branch_id, BOOK_COPIES.No_of_copies from BOOK, BOOK_AUTHORS, BOOK_COPIES where BOOK.Book_id like '%".$Book_id."%' and BOOK_AUTHORS.Book_id=BOOK.Book_id and BOOK_AUTHORS.Author_name like '%".$Author."%' and BOOK.Title like '%".$Title."%' and BOOK_COPIES.Book_id=BOOK.Book_id";
	}else{
		$sql1 = "SELECT BOOK.Book_id, BOOK.Title, BOOK_AUTHORS.Author_name, BOOK_COPIES.Branch_id, BOOK_COPIES.No_of_copies from BOOK, BOOK_AUTHORS, BOOK_COPIES where BOOK.Book_id like '%".$Book_id."%' and BOOK_AUTHORS.Book_id=BOOK.Book_id and BOOK_AUTHORS.Author_name like '%".$Author."%' and BOOK.Title like '%".$Title."%' and BOOK_COPIES.Book_id=BOOK.Book_id";
	}
	
	$result = mysqli_query($conn,$sql1);
	if (mysqli_num_rows($result) > 0) {
		$table = "<table border='4'>
				<tr><td>Book_id</td><td>Title</td><td>Author</td><td>Branch_id</td><td># of Copies</td><td>Available</td><td>Check out</td></tr>";    	
		while($row =mysqli_fetch_assoc($result)) {
			$bookid=$row["Book_id"];
			$branchid=$row["Branch_id"];
			$available=$row["No_of_copies"];
			$sql2="SELECT count(*) from BOOK_LOANS where Book_id='".$bookid."' and Branch_id='".$branchid."' and Date_in is null";
			$result2 = mysqli_query($conn,$sql2);
			if (mysqli_num_rows($result2) > 0){
				$row2 =mysqli_fetch_assoc($result2);
				$available=$available-$row2["count(*)"];
			}else{
			
			}
			if($available==0){
				$string="<button onclick=not_available()>checkout</button>";
			}else{
				$string="<form action='login.php' method='post' style='display: inline'><input type='hidden' name='Book_id' value='$bookid'><input type='hidden' name='Branch_id' value='$branchid'><input type='submit' value='checkout'></form>";
			}
        	$table=$table."<tr><td>".$row["Book_id"]."</td><td>".$row["Title"]."</td><td>".$row["Author_name"]."</td><td>".$row["Branch_id"]."</td><td>".$row["No_of_copies"]."</td><td>".$available."</td><td>".$string."</td></tr>";
     	}
     	$table = $table."</table><script>function not_available(){alert('The Book is not available in this branch!.');}</script>";
     	echo "<hr>We have this Book!";
     	echo $table;
     	echo "<hr>";
     	echo "No book availiable now?</br>";
     	echo "<a href='library.html'><button>Go Back!</button></a>";
	} else {
     	echo "There is no such book in our library!</br>";
     	echo "<a href='library.html'><button>Go Back!</button></a>";
	}


	mysqli_close($conn);
?>