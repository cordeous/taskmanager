<?php 
   
    include('config/constants.php');
    
    // Verificar si se ha enviado 'list_id' a través de GET
    if(isset($_GET['list_id'])){
        // Obtener el 'list_id' de GET
        $list_id = $_GET['list_id'];
        // Conectar a la base de datos
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());    
        // Seleccionar la base de datos
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        
        // Consulta para eliminar la lista con el 'list_id' proporcionado
        $sql = "DELETE FROM tbl_lists WHERE list_id=$list_id";
        
        // Ejecutar la consulta
        $res = mysqli_query($conn, $sql);
        
        // Verificar si la consulta se ejecutó correctamente
        if($res==true)
        {
            // Establecer mensaje de sesión para indicar que la lista se eliminó correctamente
            $_SESSION['delete'] = "Lista eliminada exitosamente";

            header('location:manage-list.php');
        }
        else
        {
            // Establecer mensaje de sesión en caso de que no se pueda eliminar la lista
            $_SESSION['delete_fail'] = "Error al eliminar la lista.";
            header('location:manage-list.php');
        }
    }
    else
    {
        header('location:manage-list.php');
    }
?>
