<?php 
    include('config/constants.php');
?>

<html>
    <head>
        <title>Task Manager with PHP and MySQL</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    
    <body>
        <div class="wrapper">
    
        <h1>TASK MANAGER</h1>
        
        <a class="btn-secondary" href="index.php">Home</a>
        
        <h3>Add Task Page</h3>

        <p>
        	<?php
        		// Check if 'add_fail' session is set
        		if(isset($_SESSION['add_fail'])){
        			// Display session message
        			echo $_SESSION['add_fail'];
        			// Unset the session after displaying once
        			unset($_SESSION['add_fail']);
        		}
        	?>
        </p>
        
        <form method="POST" action="">
            
            <table class="tbl-half">
                <tr>
                    <td>Task Name: </td>
                    <td><input type="text" name="task_name" placeholder="Enter your Task Name" required="required" /></td>
                </tr>
                
                <tr>
                    <td>Task Description: </td>
                    <td><textarea name="task_description" placeholder="Enter Task Description"></textarea></td>
                </tr>
                
                <tr>
                    <td>Select List: </td>
                    <td>
                        <select name="list_id">
                            
                            <?php 
                                // Connect to the database
                                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                                
                                // Select the database
                                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                                
                                // Query to select all lists
                                $sql = "SELECT * FROM tbl_lists";
                                
                                // Execute the query
                                $res = mysqli_query($conn, $sql);
                                
                                // Check if query executed successfully
                                if($res==true)
                                {
                                    // Count the number of rows
                                    $count_rows = mysqli_num_rows($res);
                                    
                                    // Check if lists are available
                                    if($count_rows>0)
                                    {
                                        // Loop through all rows
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $list_id = $row['list_id'];
                                            $list_name = $row['list_name'];
                                            ?>
                                            <!-- Print option for each list -->
                                            <option value="<?php echo $list_id ?>"><?php echo $list_name; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <!-- If no lists are available -->
                                        <option value="0">None</option>
                                        <?php
                                    }
                                    
                                }
                            ?>
                        
                            
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>Priority: </td>
                    <td>
                        <select name="priority">
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>Deadline: </td>
                    <td><input type="date" name="deadline" /></td>
                </tr>
                
                <tr>
                    <td><input class="btn-primary btn-lg" type="submit" name="submit" value="SAVE" /></td>
                </tr>
                
            </table>
            
        </form>
        
        </div>
    </div>
    </body>
    
</html>

<?php 

    if(isset($_POST['submit']))
    {
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];
        
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
        
        $sql2 = "INSERT INTO tbl_tasks SET 
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = $list_id,
            priority = '$priority',
            deadline = '$deadline'
        ";
        
        $res2 = mysqli_query($conn2, $sql2);
        
        if($res2==true)
        {
            $_SESSION['add'] = "Task Added Successfully.";
            header('location:index.php');
            
        }
        else
        {
            $_SESSION['add_fail'] = "Failed to Add Task";
            header('location:add-task.php');
        }
    }

?>
