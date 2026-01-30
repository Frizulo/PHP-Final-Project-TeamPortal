<?php
// 開始會話
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../LoginApply.html");
    exit;
}
if (!isset($_GET['id'])) {
    header("Location: discuss.php");
    exit;
}
include_once('../db/01_conn.php');

$post_id = $_GET['id'];
$sql = "SELECT posts.*, personal_info.name 
        FROM posts 
        LEFT JOIN personal_info ON posts.acc_id = personal_info.acc_id 
        WHERE posts.id = '$post_id'";
$connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
$result = $connect->query($sql);
$result->setFetchMode(PDO::FETCH_BOTH);
$announcement = $result->fetch();

if (!$announcement) {
    header("Location: bulletin.php");
    exit;
}

// 獲取留言列表

$sql_comments = "SELECT comments.*, personal_info.name 
                FROM comments 
                LEFT JOIN personal_info ON comments.acc_id = personal_info.acc_id 
                WHERE comments.post_id = '$post_id' 
                ORDER BY comments.created_at DESC";
$connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
$result_comments = $connect->query($sql_comments);
$result_comments ->setFetchMode(PDO::FETCH_BOTH);
$comments = $result_comments->fetchAll();

//總數量
$comment_count = count($comments);
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>程式培訓隊 | 討論</title>
    <meta name="author" content="Frizulo" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="styleBLT.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../pic/logo.svg" type="image/svg+xml" />
</head>

<body style="margin: 8px;">

    <!-- navbar -->
    <nav class="nav1 navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:location.reload();">
                <div class="center" style="gap: 5px;">
                    <img src="../pic/logo.svg" alt="logo">
                    <p class="MinScrDis" style="margin: 0;">程式培訓隊</p>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex align-items-center" style="gap: 8px;">
                    <li class="nav-item">
                        <a class="changeliner nav-link active" aria-current="page" href="bulletin.php">
                            <div class="d-flex align-items-center" style="gap: 5px;">
                                <img src="../pic/icon/home_B.svg" alt="home" class="d-inline-block align-text-top">
                                <span class=" ml-2">首頁</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="changeliner nav-link" aria-current="page" href="discuss.php">
                            <div class="d-flex align-items-center" style="gap: 5px;">
                                <img src="../pic/icon/forum_B.svg" alt="discuss"
                                    class="d-inline-block align-text-top">
                                <span class="ml-2">討論</span>
                            </div>
                        </a>
                    </li>
                    <!-- 僅管理員有審核的功能 -->
                    <?php if ($_SESSION['role'] == 'admin') : ?>
                    <li class="nav-item">
                        <a class="changeliner nav-link" aria-current="page" href="verify.php">
                            <div class="d-flex align-items-center" style="gap: 5px;">
                                <img src="../pic/icon/verify_B.svg" alt="verify"
                                    class="d-inline-block align-text-top">
                                <span class="ml-2">審核</span>
                            </div>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                <!-- 右側 -->
                <span class="navbar-text">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link pi" href="personal_info.php">
                                <img src="../pic/icon/personal_info.svg" alt="personal_info">
                            </a>
                        </li>
                        <li class="nav-item text-end" style="margin-right:10px">
                            <a class="changeliner nav-link" style="padding-right: 16px"
                                href="../db/sign_out.php">
                                <img src="../pic/icon/SignOut_B.svg" alt="signOut"
                                    class="d-inline-block align-text-top">
                            </a>
                        </li>
                    </ul>
                </span>
            </div>
        </div>
    </nav>

    <!-- 主要內容區域 -->
    <div class="container mt-1">
        <div class="row flex-row-reverse center">
            <div class="col-md-4">
                <div style='height: 150px;'>
                    <button type="button" style="width:100%;padding: 20px; margin-top:50px" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#announcementModal">
                        <img style="width:30px; height:30px; margin-top:-6px;"z src="../pic/icon/post_W.svg" alt="post" class="d-inline-block align-text-top">
                        <span class="ml-2" style="font-size:1.5rem">留言</span>
                    </button>
                </div>
            </div>
            <div style='width: 10px;'></div>
            <div style='min-height: 425px;' class='col-md-7'>
                <!-- 公告詳情卡片 -->
                <div class='card mb-3'style='border-left: 5px solid #FA824C; cursor: pointer;'>
                    <div class='card-body'>
                        <h5 class='card-title'><?php echo htmlspecialchars($announcement['title']); ?></h5>
                        <h6 class='card-subtitle mb-2 text-muted'><?php echo htmlspecialchars($announcement['keywords']); ?></h6>
                        <p class='card-text'>分類：<?php echo htmlspecialchars($announcement['category']); ?></p>
                        <p class='card-text'>發佈人：<?php echo htmlspecialchars($announcement['name']); ?></p>
                        <p class='card-text'>發佈日期：<?php echo htmlspecialchars($announcement['created_at']); ?></p>
                        <p class='card-text'>留言數量：<?php echo htmlspecialchars($comment_count); ?></p>
                        <hr></hr>
                        <p class='card-text' style="font-size:1.3rem"><?php echo nl2br(htmlspecialchars($announcement['content'])); ?></p>
                        <!-- 只有作者和管理員可以看到刪除按鈕 -->
                        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['user_id'] == $announcement['acc_id']) : ?>
                            <div class="modal-footer" style="margin-bottom: -10px; margin-top:10px;">
                                <button type='button' class='btn btn-primary ms-2' data-bs-toggle="modal" 
                                    data-bs-target="#editModal_<?php echo $announcement['id']; ?>">編輯</button>
                                <button type='button' class='btn btn-danger ms-2' data-bs-toggle='modal'
                                    data-bs-target='#deleteModal_<?php echo $announcement['id']; ?>'>刪除</button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- 留言區域 -->
                <div class='mb-3'>
                    <h5>留言</h5>
                    <?php
                    if(!$comment_count){
                        ?><h3 class="center" style="color: #fff;background-color: #9BB4B3"><i>快快搶第一!!來留言ㄅ</i></h3> <?php
                    }
                    ?>
                    <?php foreach ($comments as $comment) : ?>
                        <div class='card mb-3'>
                            <div class='card-body'>
                                <p class='card-text'><?php echo htmlspecialchars($comment['content']); ?></p>
                                <p class='card-text'>留言人：<?php echo htmlspecialchars($comment['name']); ?></p>
                                <p class='card-text'>留言時間：<?php echo htmlspecialchars($comment['created_at']); ?></p>
                                <!-- 只有作者和管理員可以看到刪除按鈕 -->
                                <?php if ($_SESSION['role'] == 'admin' || $_SESSION['user_id'] == $comment['acc_id']) : ?>
                                    <button type='button' class='btn btn-danger' data-bs-toggle='modal'
                                        data-bs-target='#deleteCommentModal_<?php echo $comment['id']; ?>'>刪除</button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- 刪除留言 Model -->
                        <div class="modal fade" id="deleteCommentModal_<?php echo $comment['id']; ?>" tabindex="-1" aria-labelledby="deleteCommentModal_<?php echo $comment['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteCommentModal_<?php echo $comment['id']; ?>">確認刪除</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>確定要刪除這則留言嗎？刪了就真的掰掰ㄌψ(._. )></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                        <a href="../db/comment_delete.php?id=<?php echo $comment['id']; ?>&pid=<?php echo $post_id; ?>" class="btn btn-danger">刪除</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    
    <!-- 新增留言 Model -->
    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="announcementModalLabel">新增留言</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- 改form action -->
                <form action="../db/comment_process.php?id=<?php echo $post_id?>" method="post">
                    <div class="modal-body">
                    <div class="mb-3">
                        <label for="announcement-content" class="form-label">留言內容</label>
                        <textarea class="form-control" id="announcement-content" name="content" rows="5" placeholder="輸入留言內容" required></textarea>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                    <button type="submit" class="btn btn-primary">新增</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 刪除貼文 Model -->
    <div class="modal fade" id="deleteModal_<?php echo $announcement['id']; ?>" tabindex="-1" aria-labelledby="deleteModal_<?php echo $announcement['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModal_<?php echo $announcement['id']; ?>">確認刪除</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>確定要刪除這則貼文嗎？刪了就真的掰掰ㄌψ(._. )></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <a href="../db/delete_post.php?id=<?php echo $announcement['id']; ?>" class="btn btn-danger">刪除</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 編輯 model -->
    <div class="modal fade" id="editModal_<?php echo $announcement['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel_<?php echo $announcement['id']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel_<?php echo $announcement['id']; ?>">編輯討論文</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../db/update_post.php?id=<?php echo $announcement['id']; ?>" method="post">
                        <div class="mb-3">
                            <label for="edit-title" class="form-label">標題</label>
                            <input type="text" class="form-control" id="edit-title" name="title" value="<?php echo htmlspecialchars($announcement['title']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-keywords" class="form-label">關鍵字</label>
                            <input type="text" class="form-control" id="edit-keywords" name="keywords" value="<?php echo htmlspecialchars($announcement['keywords']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="edit-category" class="form-label">分類</label>
                            <select class="form-select" id="edit-category" name="category" required>
                                <option value="提問" <?php if ($announcement['category'] === '提問') echo 'selected'; ?>>提問</option>
                                <option value="題解" <?php if ($announcement['category'] === '題解') echo 'selected'; ?>>題解</option>
                                <option value="挑戰" <?php if ($announcement['category'] === '挑戰') echo 'selected'; ?>>挑戰</option>
                                <option value="練習" <?php if ($announcement['category'] === '練習') echo 'selected'; ?>>練習</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit-content" class="form-label">內容</label>
                            <textarea class="form-control" id="edit-content" name="content" rows="5" required><?php echo  nl2br(htmlspecialchars($announcement['content'])); ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-primary">更新</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- footer!! -->
    <footer>
        <p>Copyright &copy; 2024 程式培訓隊</p>
        <p style="padding: 2px;">Designed by Frizulo</p>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
</body>

</html>

