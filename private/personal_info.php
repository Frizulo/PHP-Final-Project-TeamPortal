
<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../LoginApply.html");
        exit;
    }
    ini_set('display_errors','on');
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    include_once("../db/01_conn.php");

    $sql2 = "SELECT * FROM personal_info WHERE acc_id='" . $_SESSION["user_id"]."'";
    $connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
    $rs2 = $connect->query($sql2);
    $rs2->setFetchMode(PDO::FETCH_BOTH);
    $row2 = $rs2->fetch();
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <title>程式培訓隊 | 個人資訊</title>
    <meta name="author" content="Frizulo" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="styleBLT.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./pic/logo.svg" type="image/svg+xml"/>
</head>
<body style="margin: 8px;">
    <h1 class="center">個人資料(●'◡'●)</h1>
    <div class="container" style="font-size: 1.5rem">
        <div class="row flex-column flex-sm-row">
            <div class="col-12 col-sm-4 d-flex justify-content-center align-items-centerr">
                <?php
                $role = $_SESSION['role'];
                $imgSrc = ($role == 'admin') ? '../pic/icon/admin.svg' : '../pic/icon/user.svg';
                ?>
                <img style="min-height: 200px" src="<?php echo $imgSrc; ?>" alt="Profile Picture">
                
            </div>
            <div class="col-12 col-sm-8">
                <form method="post" action="">
                    <div class="mb-3 row">
                        <label for="stu_id" class="col-sm-2 col-form-label">學號</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="stu_id" value="<?php echo $row2['stu_id']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">姓名</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="name" value="<?php echo $row2['name']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="mail" class="col-sm-2 col-form-label">Mail</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mail" name="mail" value="<?php echo $row2['mail']; ?>">
                        </div>
                    </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">修改</button>
                </form>
            </div>
        </div>
    </div>
    <hr></hr>
    <?php
    if(isset($_POST['submit']) && $_POST['submit'] == 'submit') {
        $mail = $_POST['mail'];
        $sql = "UPDATE personal_info SET mail='$mail' WHERE acc_id='" . $_SESSION["user_id"] . "'";
        $connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $connect->query($sql);
        echo "<script>alert('修改成功');</script>";
        header("refresh:0;url=personal_info.php");
    }
    ?>
    <?php
    try {
        // count 發布的討論
        $count_posts_sql = "SELECT COUNT(*) AS post_count FROM posts WHERE acc_id = :user_id";
        $count_posts_stmt = $connect->prepare($count_posts_sql);
        $count_posts_stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $count_posts_stmt->execute();
        $post_count = $count_posts_stmt->fetch(PDO::FETCH_ASSOC)['post_count'];

        // count 貼文被留言
        $count_post_comments_sql = "SELECT COUNT(*) AS post_comment_count FROM comments WHERE post_id IN (SELECT id FROM posts WHERE acc_id = :user_id)";
        $count_post_comments_stmt = $connect->prepare($count_post_comments_sql);
        $count_post_comments_stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $count_post_comments_stmt->execute();
        $post_comment_count = $count_post_comments_stmt->fetch(PDO::FETCH_ASSOC)['post_comment_count'];

        // count 發表的留言 
        $count_comments_sql = "SELECT COUNT(*) AS comment_count FROM comments WHERE acc_id = :user_id";
        $count_comments_stmt = $connect->prepare($count_comments_sql);
        $count_comments_stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $count_comments_stmt->execute();
        $comment_count = $count_comments_stmt->fetch(PDO::FETCH_ASSOC)['comment_count'];
        ?>
        <div class="center">
            <h2 class="center" style="width:auto; margin: 10px; border: #9bb4b3 inset 5px; border-radius:5px; background-color: #eff1e4; color: #385858; padding: 20px;">統計資訊φ(゜▽゜*)♪</h2>
        </div>
        
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="text-center">
                        <ul class="list-group list-group-flush" style="font-size: 1.5rem;">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                發布的討論
                                <span class="badge bg-primary rounded-pill"><?php echo $post_count; ?> 篇</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                貼文被留言
                                <span class="badge bg-info rounded-pill"><?php echo $post_comment_count; ?> 則</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                發表的留言
                                <span class="badge bg-success rounded-pill"><?php echo $comment_count; ?> 則</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <?php
    } catch (PDOException $e) {
        // Handle database errors if any
        echo "Error counting posts or comments: " . $e->getMessage();
    }
    ?>

    
    <a href="bulletin.php"><div class="b2home"><img src="../pic/home_W.svg"></div></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
