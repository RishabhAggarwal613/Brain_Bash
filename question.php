<?php 
session_start();
include "connection.php";
if (isset($_SESSION['id'])) {
	
	if (isset($_GET['n']) && is_numeric($_GET['n'])) {
	        $qno = $_GET['n'];
	        if ($qno == 1) {
	        	$_SESSION['quiz'] = 1;
	        }
	        }
	        else {
	        	header('location: question.php?n='.$_SESSION['quiz']);
	        } 
	        if (isset($_SESSION['quiz']) && $_SESSION['quiz'] == $qno) {
			$query = "SELECT * FROM questions WHERE qno = '$qno'" ;
			$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
			if (mysqli_num_rows($run) > 0) {
				$row = mysqli_fetch_array($run);
				$qno = $row['qno'];
                 $question = $row['question'];
                 $ans1 = $row['ans1'];
                 $ans2 = $row['ans2'];
                 $ans3 = $row['ans3'];
                 $ans4 = $row['ans4'];
                 $correct_answer = $row['correct_answer'];
                 $_SESSION['quiz'] = $qno;
                 $checkqsn = "SELECT * FROM questions" ;
                 $runcheck = mysqli_query($conn , $checkqsn) or die(mysqli_error($conn));
                 $countqsn = mysqli_num_rows($runcheck);
                 $time = time();
                 $_SESSION['start_time'] = $time;
                 $allowed_time = $countqsn * 0.05;
                 $_SESSION['time_up'] = $_SESSION['start_time'] + ($allowed_time * 60) ;
                 

			}
			else {
				echo "<script> alert('something went wrong');
			window.location.href = 'home.php'; </script> " ;
			}
		}
		else {
		echo "<script> alert('error');
			window.location.href = 'home.php'; </script> " ;
	}
?>
<?php 
$total = "SELECT * FROM questions ";
$run = mysqli_query($conn , $total) or die(mysqli_error($conn));
$totalqn = mysqli_num_rows($run);

?>
<html>
	<head>
		<title>Brain_Bash</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<style>
		    .quiz-buttons input[type="submit"],
		    .quiz-buttons a.start {
		        display: inline-block;
		        width: 150px; /* Set desired width */
		        height: 40px; /* Set desired height */
		        text-align: center;
		        line-height: 40px; /* Vertically center text */
		        font-size: 16px;
		        background-color: #007BFF; /* Match button color */
		        color: white;
		        border: none;
		        border-radius: 5px;
		        text-decoration: none;
		        cursor: pointer;
		    }

		    .quiz-buttons input[type="submit"]:hover,
		    .quiz-buttons a.start:hover {
		        background-color: #0056b3; /* Hover effect */
		    }
		</style>
	</head>

	<body class="quiz-page">
		<header>
			<div class="container">
				<h1><a href="index.php">Brain_Bash</a></h1>
			</div>
		</header>

		<main>
			<div class= "container">
				<div class= "current">Question <?php echo $qno; ?> of <?php echo $totalqn; ?></div>
				<p class="question"><?php echo $question; ?></p>
				<form method="post" action="process.php">
					<ul class="choices">
					   <li><input name="choice" type="radio" value="a" required=""><?php echo $ans1; ?></li>
					   <li><input name="choice" type="radio" value="b" required=""><?php echo $ans2; ?></li>
					   <li><input name="choice" type="radio" value="c" required=""><?php echo $ans3; ?></li>
					   <li><input name="choice" type="radio" value="d" required=""><?php echo $ans4; ?></li>
					 
					</ul>
					<div class="quiz-buttons">
						<input type="submit" value="Submit">
						<input type="hidden" name="number" value="<?php echo $qno;?>">
						<a href="home.php" class="start">Stop Quiz</a>
					</div>
				</form>
			</div>
		</main>
</body>
</html>

<?php } 
else {
	header("location: home.php");
}
?>