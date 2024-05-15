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
        <a class="btn-secondary" href="manage-list.php">Manage Lists</a>
        
        
        <h3>Add List Page</h3>
        
        <p>
        
        <?php 
        
            // Verificar si la sesión está creada o no
            if(isset($_SESSION['add_fail']))
            {
                // mostrar mensaje de sesión
                echo $_SESSION['add_fail'];
                // eliminar el mensaje después de mostrarlo una vez
                unset($_SESSION['add_fail']);
            }
        
        ?>
        
        </p>
        
        <!-- Form to Add List Starts Here -->
        
        <form method="POST" action="">
            
            <table class="tbl-half">
                <tr>
                    <td>List Name: </td>
                    <td><input type="text" name="list_name" placeholder="Type list name here" required="required" /></td>
                </tr>
                <tr>
                    <td>List Description: </td>
                    <td><textarea name="list_description" placeholder="Type List Description Here"></textarea></td>
                </tr>
                
                <tr>
                    <td><input class="btn-primary btn-lg" type="submit" name="submit" value="SAVE" /></td>
                </tr>
                
            </table>
            
        </form>
        
        <!-- Form to Add List Ends Here -->
        </div>
    </div>
    </body>
</html>


<?php 

    // Verificar si el formulario ha sido enviado o no
    if(isset($_POST['submit']))
    {
        // Obtener los valores del formulario y guardarlos en variables
        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'];
        
        // Conectar a la base de datos
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        // Verificar si la base de datos se conectó o no
        /*
        if($conn==true)
        {
            echo "Database Connected";
        }
        */
        
        // SEleccionar base de datos
        $db_select = mysqli_select_db($conn, DB_NAME);
        
        // Verificar si la base de datos está conectada o no
        /*
        if($db_select==true)
        {
            echo "Database SElected";
        }
        */
        // Consulta SQL para insertar datos en la base de datos
        $sql = "INSERT INTO tbl_lists SET 
            list_name = '$list_name',
            list_description = '$list_description'
        ";
        
        // Ejecutar consulta e insertar en la base de datos
        $res = mysqli_query($conn, $sql);
        
        // Verificar si la consulta se ejecutó correctamente o no
        if($res==true)
        {
            // Datos insertados correctamente
            // echo "Data Inserted";
            
            // Crear una variable de SESIÓN para mostrar mensaje
            $_SESSION['add'] = "List Added Successfully";
            
            // Redirigir a la página de Administrar Lista
            header('location:manage-list.php');
            
            
        }
        else
        {
            // Error al insertar datos
            // echo "Failed to Insert Data";
            
            // Crear variable de SESIÓN para guardar mensaje
            $_SESSION['add_fail'] = "Failed to Add List";
            
            // Redirigir a la misma página
            header('location:add-list.php');
        }
        
    }

?>
