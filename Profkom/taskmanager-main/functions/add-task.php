<?php 
    include('config/constants.php');
?>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
    </head>
    <body>
        <div class="wrapper">
        <h1>Admin panel</h1>
        <a class="btn-secondary" href="<?php echo SITEURL; ?>">Назад</a>
        <h3>Добавление задании</h3>
        <p>
            <?php 
                if(isset($_SESSION['add_fail']))
                {
                    echo $_SESSION['add_fail'];
                    unset($_SESSION['add_fail']);
                }
            ?>
        </p>
        <form method="POST" action="">
            <table class="tbl-half">
                <tr>
                    <td>Название</td>
                    <td><input type="text" name="task_name" placeholder="Type your Task Name" required="required" /></td>
                </tr>
                <tr>
                    <td>Описание</td>
                    <td><textarea name="task_description" placeholder="Type Task Description"></textarea></td>
                </tr>
                <tr>
                    <td>Направление</td>
                    <td>
                        <select name="list_id">
                            <?php 
                                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                                $sql = "SELECT * FROM tbl_lists";
                                $res = mysqli_query($conn, $sql);
                                if($res==true)
                                {
                                    $count_rows = mysqli_num_rows($res);
                                    if($count_rows>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $list_id = $row['list_id'];
                                            $list_name = $row['list_name'];
                                            ?>
                                            <option value="<?php echo $list_id ?>"><?php echo $list_name; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="0">Нету ничего</option>p
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>С какого</td>
                    <td><input type="date" name="start" /></td>
                </tr>
                <tr>
                    <td>До какого</td>
                    <td><input type="date" name="deadline" /></td>
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
    if(isset($_POST['submit']))
    {
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $start = $_POST['start'];
        $deadline = $_POST['deadline'];
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
        $sql2 = "INSERT INTO tbl_task SET 
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = $list_id,
            start = '$start',
            deadline = '$deadline',
            sost = 'bez'
        ";
        $res2 = mysqli_query($conn2, $sql2);
        if($res2==true)
        {
            $_SESSION['add'] = "Task Added Successfully.";
            header('location:'.SITEURL);
        }
        else
        {
            $_SESSION['add_fail'] = "Failed to Add Task";
            header('location:'.SITEURL.'add-task.php');
        }
    }

?>