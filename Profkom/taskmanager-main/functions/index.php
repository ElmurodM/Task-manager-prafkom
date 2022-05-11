<?php 
    include('config/constants.php');
?>
<html>
    <head>
        <title>Admin panel
        </title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
    </head>
    <body>
    <div class="wrapper">
    <h1>Admin panel</h1>
    <div class="menu">
        <a class="btn-secondary" href="https://it-sfera.uz/Profkom/taskmanager-main/">Главная страница</a>
        <a class="btn-secondary" href="<?php echo SITEURL; ?>manage-list.php">Управление направлениями</a>
        <a class="btn-secondary" href="<?php echo SITEURL; ?>list-task.php">Задание по направлению</a>
        <a class="btn-primary" href="<?php SITEURL; ?>add-task.php">Добавить задание</a>
       
    </div>
    <p>
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['delete_fail'])){
                echo $_SESSION['delete_fail'];
                unset($_SESSION['delete_fail']);
            }
        ?>
    </p>
    <div class="all-tasks">
        <table class="tbl-full">
            <tr>
                <th>No</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Состояние</th>
                <th>С какого</th>
                <th>До какого</th>
                <th>Действии</th>
            </tr>
            <?php 
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                $sql = "SELECT * FROM tbl_task";
                $res = mysqli_query($conn, $sql);
                if($res==true){
                    $count_rows = mysqli_num_rows($res);
                    $sn=1;
                    if($count_rows>0){
                        while($row=mysqli_fetch_assoc($res)){
                            $task_id = $row['task_id'];
                            $task_name = $row['task_name'];
                            $desc = $row['task_description'];
                            $priority = $row['start'];
                            $deadline = $row['deadline'];
                            $sost = $row['sost'];
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $desc; ?></td>
                                <td><?php echo $sost; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Изменить </a>
                                    <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Удалить </a>
                                </td>
                            </tr>
                            <?php
                        }
                    }else{
                        ?>
                        <tr>
                            <td colspan="5">Нет задании</td>
                        </tr>
                        <?php
                    }
                }
            ?>
        </table>
    </div>
    </div>
    </body>
</html>