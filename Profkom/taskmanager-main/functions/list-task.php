<?php 
    include('config/constants.php');
    $list_id_url = $_GET['list_id'];
?>

<html>
    <head>
        <title>Admin panel</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
    </head>
    <body>
        <div class="wrapper">
        <h1>Admin panel</h1>
        <div class="menu">
            <a href="<?php echo SITEURL; ?>">Назад</a>
            <?php 
                $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
                $sql2 = "SELECT * FROM tbl_lists";
                $res2 = mysqli_query($conn2, $sql2);
                if($res2==true)
                {
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $list_id = $row2['list_id'];
                        $list_name = $row2['list_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                        <?php
                        
                    }
                }
                
            ?>
            <a href="<?php echo SITEURL; ?>manage-list.php">Список задании</a>
        </div>
        <div class="all-task">
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
                    $sql = "SELECT * FROM tbl_task WHERE list_id=$list_id_url";
                    $res = mysqli_query($conn, $sql);
                    if($res==true)
                    {
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
                                        <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Изменить</a>
                                    
                                    <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Удалить</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }else{
                            ?>
                            
                            <tr>
                                <td colspan="5">Нажимай на какую нибудь направление</td>
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