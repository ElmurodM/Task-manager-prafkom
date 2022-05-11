<?php
    include('config/constants.php'); 
     $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if(isset($_GET['list_id'])){
        $list_id = $_GET['list_id'];
        $sql = "SELECT * FROM tbl_lists WHERE list_id=$list_id";
        $res = mysqli_query($conn, $sql);
        if($res==true){
            $row = mysqli_fetch_assoc($res);
            $list_name = $row['list_name'];
        }else{
            header('location:'.SITEURL.'manage-list.php');
        }
    }
?>
<html>
    <head>
        <title>Admin panel</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
    </head>
    <body><div class="wrapper">
        <h1>TASK MANAGER</h1>
        <a class="btn-secondary" href="https://it-sfera.uz/Profkom/taskmanager-main/">Главная страница</a>
        <a class="btn-secondary" href="<?php echo SITEURL; ?>manage-list.php">Управление направлениями</a>
        <h3>Изменить направление</h3>
        <p>
            <?php 
                if(isset($_SESSION['update_fail'])){
                    echo $_SESSION['update_fail'];
                    unset($_SESSION['update_fail']);
                }
            ?>
        </p>
        <form method="POST" action="">
            <table class="tbl-half">
                <tr>
                    <td>Название направлении</td>
                    <td><input type="text" name="list_name" value="<?php echo $list_name; ?>" required="required" /></td>
                </tr>
                <tr>
                    <td><input class="btn-lg btn-primary" type="submit" name="submit" value="Изменить" /></td>
                </tr>
            </table>
        </form>
        </div>
    </body>
</html>
<?php 
    if(isset($_POST['submit'])){
        $list_name = $_POST['list_name'];
        $sql2 = "UPDATE tbl_lists SET list_name = '$list_name' WHERE list_id='$list_id'";
        $res2 = mysqli_query($conn, $sql2);
        if($res2==true){
            $_SESSION['update'] = "List Updated Successfully";
            header('location:'.SITEURL.'manage-list.php');
        }else{
            $_SESSION['update_fail'] = "Failed to Update Lists";
            header('location:'.SITEURL.'update-list.php?list_id='.$list_id);
        }
    }
?>