<?php  include('config/server.php');

// fetch the record to be updated
if (isset($_GET['edit'])) {
    $Id = $_GET['edit'];
    $edit_state = true;
    $rec = mysqli_query($link, "SELECT * FROM Students WHERE Id='$Id' ") ;

        $record = mysqli_fetch_array($rec);
        $Id = $record['Id'];
        $Name = $record['Name'];
        $Age = $record['Age'];
        $Department = $record['Department'];
        $Subject = $record['Subjects'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD Operations</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

    <div class="container">
        <H1>Example to try CRUD Operations</H1>
        <p>It is a simple PHP application Which I developed to learn CRUD user operations.</p>
        <p>Please scroll down below and fillup the form then you can view, edit, delete your response.</p>
        <p>Note : You can edit Name, Age, Department, Subjects,<u><i class="highlight"> but you can not edit Id.</i></u>  Id is unique and it is used as a key on other operations.</p>
    </div>
    <?php if (isset($_SESSION['msg'])): ?>
        <div class="msg">
            <?php 
                echo $_SESSION['msg']; 
                unset($_SESSION['msg']);
            ?>
        </div>
    <?php endif ?>
    <table>
        <thead class="Thead">
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Age</td>
                <td>Department</td>
                <td >Subject</td>
                <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>

        <!-- retrive records -->
        <?php $records = mysqli_query($link, "SELECT * FROM Students"); ?>
            <?php while ($row = mysqli_fetch_array($records)) { ?>
                <tr>
                    <td><?php echo $row['Id']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Age']; ?></td>
                    <td><?php echo $row['Department']; ?></td>
                    <td><?php echo $row['Subjects']; ?></td>
                    <td>
                        <a class="edit_btn" href = "index.php?edit=<?php echo $row['Id']; ?>">Edit</a>
                    </td>
                    <td>
                        <a class="del_btn" href = "config/server.php?del=<?php echo $row['Id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
            
        </tbody>
    </table>

    <form  method="post" action="config/server.php" >
        <div class="input-group">
            <label>Id</label>
            <input type="number" name="Id" value = "<?php echo $Id; ?>">
        </div>
        <div class="input-group">
            <label>Name</label>
            <input type="text" name="Name" value = "<?php echo $Name; ?>">
        </div>
        <div class="input-group">
            <label>Age</label>
            <input type="number" name="Age" value = "<?php echo $Age; ?>">
        </div>
        <div class="input-group">
            <label>Department</label>
            <input type="text" name="Department" value = "<?php echo $Department; ?>">
        </div>
        <div class="input-group">
            <label>Subjects</label>
            <input type="text" name="Subjects" value = "<?php echo $Subject; ?>">
        </div>
        <div class="input-group">        
            <?php if ($edit_state == false): ?>
                <button class="btn" type="submit" name="save" style="background: #556B2F;" >save</button>
            <?php else: ?>
                <button class="btn" type="submit" name="update" >update</button>
            <?php endif ?>
        </div>
    </form>
</body>
</html>
