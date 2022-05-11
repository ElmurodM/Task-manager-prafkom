<?php 
    include('config/constants.php');
?>
<html>
    <head>
        <title>Admin panel</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
    </head>
    <body>
        <div class="wrapper">
        <h1>Admin panel</h1>
        <a class="btn-secondary" href="<?php echo SITEURL; ?>">Назад</a>
        <h3>Добавление направление</h3>
        <p>
        <?php 
            if(isset($_SESSION['add_fail']))
            {
                echo $_SESSION['add_fail'];
                unset($_SESSION['add_fail']);
            }
        ?>
        </p>
        <form method="POST" action=""
            <table class="tbl-half">
                <tr>
                    <td>Название</td>
                    <td><input type="text" name="list" placeholder="Type list name here" required="required" /></td>
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
        $list_name = $_POST['list'];
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD , DB_NAME);
        $res = mysqli_query($conn, "INSERT INTO tbl_lists (list_name) VALUES('$list_name')");
        if($res==true)
        {
            $_SESSION['add'] = "List Added Successfully";
            header('location:'.SITEURL.'manage-list.php');
            
        }else{
            $_SESSION['add_fail'] = "Failed to Add List $list_name ";
            header('location:'.SITEURL.'add-list.php');
        }
    }
?>
