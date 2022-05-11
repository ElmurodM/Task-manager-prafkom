<?php 
    include('config/constants.php');
    if(isset($_GET['task_id']))
    {
        $task_id = $_GET['task_id'];
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        $sql = "SELECT * FROM tbl_task WHERE task_id=$task_id";
        $res = mysqli_query($conn, $sql);
        if($res==true){
            $row = mysqli_fetch_assoc($res);
            $task_name = $row['task_name'];
            $task_description = $row['task_description'];
            $list_id = $row['list_id'];
            $start = $row['start'];
            $deadline = $row['deadline'];
        }
    }else{
        header('location: https://it-sfera.uz/Profkom/taskmanager-main/');
    }
?>

<html>
    <head>
        <title>Admin panel</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
    </head>
    <body>
        <div class="wrapper">
        <h1>Admin panel</h1>
        <p>
            <a class="btn-secondary" href="https://it-sfera.uz/Profkom/taskmanager-main/">Главная страница</a>
            <a class="btn-secondary" href="<?php echo SITEURL; ?>">Управление заданиями</a>
        </p>
        <h3>Изменить задание</h3>
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
                    <td>Название задание:</td>
                    <td><input type="text" name="task_name" value="<?php echo $task_name; ?>" required="required" /></td>
                </tr>
                <tr>
                    <td>Описание: </td>
                    <td>
                        <textarea name="task_description">
                        <?php echo $task_description; ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Направление: </td>
                    <td>
                        <select name="list_id">
                            
                            <?php 
                                $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                                $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
                                $sql2 = "SELECT * FROM tbl_lists";
                                $res2 = mysqli_query($conn2, $sql2);
                                if($res2==true){
                                    $count_rows2 = mysqli_num_rows($res2);
                                    if($count_rows2>0)
                                    {
                                        while($row2=mysqli_fetch_assoc($res2)){
                                            $list_id_db = $row2['list_id'];
                                            $list_name = $row2['list_name'];
                                            ?>
                                            <option <?php if($list_id_db==$list_id){echo "selected='selected'";} ?> value="<?php echo $list_id_db; ?>"><?php echo $list_name; ?></option>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        <option <?php if($list_id=0){echo "selected='selected'";} ?> value="0">Нет направление</option>p
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
            <tr>
                    <td>С какого : </td>
                    <td><input type="date" name="start" value="<?php echo $deadline; ?>" /></td>
                </tr>
                <tr>
                    <td>До какого: </td>
                    <td><input type="date" name="deadline" value="<?php echo $deadline; ?>" /></td>
                </tr>
                <tr>
                    <td><input class="btn-primary btn-lg" type="submit" name="submit" value="Сохранить" /></td>
                </tr>
            </table>
        </form>
        </div>
    </body>
</html>
<?php 
    if(isset($_POST['submit'])){
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $start = $_POST['start'];
        $deadline = $_POST['deadline'];
        $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select3 = mysqli_select_db($conn3, DB_NAME) or die(mysqli_error());
        $sql3 = "UPDATE tbl_task SET 
        task_name = '$task_name',
        task_description = '$task_description',
        list_id = '$list_id',
        start = '$start',
        deadline = '$deadline'
        WHERE 
        task_id = $task_id
        ";
        $res3 = mysqli_query($conn3, $sql3);
        if($res3==true)
        {
            $_SESSION['update'] = "Task Updated Successfully.";
            header('location:'.SITEURL);
        }else{
            $_SESSION['update_fail'] = "Failed to Update Task";
            header('location:'.SITEURL.'update-task.php?task_id='.$task_id);
        }
    }
?>
