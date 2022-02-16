<?php
require_once('dbcon.php');

if(isset($_POST['submit'])){
	// print_r($_POST);
	$std_name = $_POST['std_name'];
	$sub_name = $_POST['subject'];
	$mark = $_POST['mark'];
	$credit = 0;

	if($mark >=80){
	 $credit = 5;
	}elseif($mark>69 && $mark<=79) {
		$credit = 4;
	}elseif($mark>59 && $mark<=69){
		$credit = 3.5;
	}elseif($mark >49 && $mark<=59){
		$credit = 3;
	}elseif($mark >39 && $mark<=49){
		$credit = 2;
	}elseif($mark >=33 && $mark<=39){
		$credit = 1;
	}else{
		$credit = 0;
	}
	$marks_insert = $con->query("INSERT INTO `marks` (`std_id`, `subject_name`, `mark`, `credit`) VALUES ('$std_name', '$sub_name', '$mark', '$credit ')");
	header('Location:index.php?page=all_students');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ol>
    <h1 class="text-primary"><i class="fa fa-user-plus"></i>Add Marks <small>Add Marks </small></h1>
    <ol class="breadcrumb">
        <li><a href="index.php?pages=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active"><a href="index.php?page=all_students"><i class="fa fa-user-plus"></i>All Students</a></li>
    </ol>
			<form action="" method="post">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Student Name</th>
						<th>Subject</th>
						<th>Mark</th>
						<!-- <th>Credit</th> -->
					</tr>
				</thead>
				<tbody>
					<tr>
					<td>
						<select name="std_name" id="std_name" class="form-control">
							<option value="">Select Student</option>
							<?php $s = $con->query("SELECT * FROM`student_info`");
							while($st = $s->fetch_assoc()){
							?>
							<option value="<?php echo $st['id']; ?>"><?php echo $st['name']; ?></option>
							<?php } ?>
						</select>
					</td>
					<td>
						<input type="text" name="subject" id="subject" class="form-control">
					</td>
					<td>
						<input type="text" name="mark" id="mark" class="form-control">
					</td>
					<!-- <td>
						<input type="number" name="credit" id="credit" class="form-control">
					</td> -->
					</tr>
					<tr>
						<td colspan="4">
							<input type="submit" value="Submit" name="submit" class="btn btn-success btn-block">
						</td>
					</tr>
				</tbody>
			</table>
			</form>
		

</body>
</html>





