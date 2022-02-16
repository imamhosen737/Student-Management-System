<?php
require_once("dbcon.php");
$id = base64_decode( $_GET['id']);
 $std_name = $con->query("SELECT * FROM student_info WHERE id = $id");
 $name = $std_name->fetch_assoc();
$result = $con->query("SELECT * FROM marks WHERE std_id = $id");
// print_r($std_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Result</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>
<body>
<ol>
    <h1 class="text-primary"><i class=""></i> <?php echo $name['name']; ?>'s Result</h1>
    <ol class="breadcrumb">
        <li><a href="index.php?pages=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active"><a href="index.php?page=all_students"><i class="fa fa-user-plus"></i>All Students</a></li>
    </ol>

    <div class="container">
    <div class="row" style="background-color: yellowgreen;">
        <div class="col-md-4">
            <h2>Name: <?php echo $name['name']; ?></h2>
        </div>
        <div class="col-md-4">
            <h2>Roll: <?php echo $name['roll']; ?></h2>
        </div>
        <div class="col-md-4">
            <h2>Class: <?php echo $name['class']; ?></h2>
        </div>
    </div>
    </div>
    <br>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Marks</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                $total_number = 0;
                $grade = 0;
                $gpa = 0;
                $subject = 0;
                $is_pass = true;
                while ($value=$result->fetch_assoc()) {
                    
                    if($value['mark']<33){
                        $is_pass = false;
                    }
                $total_number +=$value['mark'];
                $grade +=$value['credit'];
                $subject +=1;
                $gpa= $grade/$subject;

                ?>
            <tr>
                <td><?php echo $value['subject_name']; ?></td>
                <td><?php echo $value['mark']; ?></td>
                <td>
                    <?php
                    if($value['mark']>=80){
                        echo "A+";
                        $grade+=5;
                    }elseif($value['mark']>69 && $value['mark']<=79) {
                        echo "A";
                        $grade+=4;
                    }elseif($value['mark']>59 && $value['mark']<=69){
                       echo "A-";
                       $grade+=3.5; 
                    }elseif($value['mark']>49 && $value['mark']<=59){
                        echo "B";
                        $grade+=3;
                    }elseif($value['mark']>39 && $value['mark']<=49){
                        echo "C";
                        $grade+=2;
                    }elseif($value['mark']>=33 && $value['mark']<=39){
                        echo "D";
                        $grade+=1;
                    }else{
                        echo "F";
                        $grade+=0;
                    }
                    ?>
                </td>
            </tr>
            <?php }    ?>
            
            <tr>
                <td><h2 class="text-center">Total = </h2></td>
                <td><h2><?php echo $total_number; ?></h2></td>

                <td>
        <?php

        if(!$is_pass){
            echo "<h2>F</h2>";
        }else{
            if($total_number/$subject>=80){
                echo "<h2>A+</h2>";
            }else if($total_number/$subject>69 && $total_number/$subject<=79) {
                echo "<h2>A</h2>";
            }elseif($total_number/$subject>59 && $total_number/$subject<=69){
                echo "<h2>A-</h2>";
            }elseif($total_number/$subject>49 && $total_number/$subject<=59){
                echo "<h2>B</h2>";
            }elseif($total_number/$subject>39 && $total_number/$subject<=49){
                echo "<h2>C</h2>";
            }elseif($total_number/$subject>=33 && $total_number/$subject<=39){
                 echo "<h2>D</h2>";
            }
        }
        
        ?>
                </td>
            </tr>

        </tbody>
    </table>
</body>
</html>