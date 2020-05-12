<?php

    session_start();

    include_once 'database.php';

    //Initialising Variables
    $Id = 0;
    $Name = "";
    $Age = 0;
    $Department = "";
    $Subject = "";
    $edit_state = false;
    
    //if save button is clicked
    if(isset($_POST['save'])){
        $Id = $_POST['Id'];
        $Name = $_POST['Name'];
        $Age = $_POST['Age'];
        $Department = $_POST['Department'];
        $Subject = $_POST['Subjects'];

        $query = " INSERT INTO `Students`(`Id`,`Name`, `Age`, `Department`, `Subjects`) VALUES ('$Id','$Name','$Age','$Department','$Subject')";
        if(!mysqli_query($link, $query)) {

            $_SESSION['msg'] = "Record could not be saved, please try later. Error <br>" . $sql . "<br>" . mysqli_error($link);

        } else {
            $_SESSION['msg'] =  "Record is successfully saved! ";
        }

        header('location: index.php'); // Redirected to index page after inserting data
    }

    //update records
    if(isset($_POST['update'])){
        $Id = $_POST['Id'];
        $Name = $_POST['Name'];
        $Age = $_POST['Age'];
        $Department = $_POST['Department'];
        $Subject = $_POST['Subjects'];

        $sql = "UPDATE `Students` SET `Id` = '$Id', `Name` = '$Name', `Age` = '$Age', `Department` = '$Department', `Subjects` = '$Subject' WHERE `Id` = '$Id';";
		if (mysqli_query($link, $sql)) {
			$_SESSION['msg'] = "Record is successfully updated! ";
		} 
		else {
			$_SESSION['msg'] = "Record could not be updated, <br> Error" . $sql . "<br>" . mysqli_error($link);
		}
        header('location: index.php'); // Redirected to index page after inserting data
    }

    //delete records
    if (isset($_GET['del'])) {
        $Id = $_GET['del'];

        mysqli_query($link, "DELETE FROM Students WHERE Id='$Id' ");
        $_SESSION['msg'] = "Record is successfully deleted!"; 
        header('location: index.php');
    }

?>
