<?php
  session_start();
  if (!isset($_SESSION['user_id'])) {
      header("Location: ../LoginApply.html");
      exit;
  }

  include_once('../db/01_conn.php');

  if (isset($_GET["category"])){
    $category = [
      'question' => 0,
      'solution' => 0,
      'challenge' => 0,
      'practice' => 0
    ];
    $c = $_GET["category"];
    foreach ($c as $c) {
      $category[$c] = 1;
    }
  }
  else{
    $category = [
      'question' => 1,
      'solution' => 1,
      'challenge' => 1,
      'practice' => 1
    ];
  }
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <title>程式培訓隊 | 討論</title>
  <meta name="author" content="Frizulo" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <link rel="stylesheet" href="styleBLT.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../pic/logo.svg" type="image/svg+xml"/>
</head>
<body  style="margin: 8px;">

  <!-- navbar -->
  <nav class="nav1 navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="javascript:location.reload();">
        <div class="center" style="gap: 5px;">
          <img src="../pic/logo.svg" alt="logo">
          <p class="MinScrDis" style="margin: 0;">程式培訓隊</p>
        </div> 
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
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
                <img src="../pic/icon/forum_B.svg" alt="discuss" class="d-inline-block align-text-top">
                <span class="ml-2">討論</span>
              </div>
            </a>
          </li>
          <!-- 僅管理員有審核的功能 -->
          <?php if ($_SESSION['role'] == 'admin'): ?>
          <li class="nav-item">
            <a class="changeliner nav-link" aria-current="page" href="verify.php">
              <div class="d-flex align-items-center" style="gap: 5px;">
                <img src="../pic/icon/verify_B.svg" alt="verify" class="d-inline-block align-text-top">
                <span class="ml-2">審核</span>
              </div>
            </a>
          </li>
          <?php endif; ?>
        </ul>
        <!-- 右側 -->
        <span class="navbar-text">
          <ul  class="navbar-nav">   
            <li class="nav-item">
              <a class="nav-link pi" href="personal_info.php">
                <img src="../pic/icon/personal_info.svg" alt="personal_info">
              </a>
            </li>
            <li class="nav-item text-end" style="margin-right:10px">
                <a class="changeliner nav-link" style="padding-right: 16px" href="../db/sign_out.php">
                  <img src="../pic/icon/SignOut_B.svg" alt="signOut" class="d-inline-block align-text-top">
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
              <span class="ml-2" style="font-size:1.5rem">發佈</span>
            </button>
          </div>
          
          <div style='height: 275px;' class='card mb-4 bd'>
            <div class='card-body' style='padding-top: 0;'>
              <p style='font-weight: bold;'>分類選擇：</p>
              <!-- 全選和全不選按鈕，背景顏色設置 -->
              <div class='d-flex justify-content-center'>
                <button type='button' class='btn btn-sm btn-primary me-2' id='category-all'>全選</button>
                <button type='button' class='btn btn-sm btn-secondary' id='category-none'>全不選</button>
              </div>
              <form action="discuss.php"  method="get">
                <!-- 勾選框和分類名稱，使用不同顏色 -->
                <div class='form-check mt-3'>
                  <input class='form-check-input category-checkbox' type='checkbox' id='category-question' name='category[]' value='question' data-color='#ffcccb' <?php if ($category["question"]) echo "checked"?>>
                  <label class='form-check-label' for='category-question'>提問</label>
                </div>
                <div class='form-check'>
                  <input class='form-check-input category-checkbox' type='checkbox' id='category-solution' name='category[]' value='solution' data-color='#ffefd5' <?php if ($category["solution"]) echo "checked"?>>
                  <label class='form-check-label' for='category-solution'>題解</label>
                </div>
                <div class='form-check'>
                  <input class='form-check-input category-checkbox' type='checkbox' id='category-challenge' name='category[]' value='challenge' data-color='#e0ffff' <?php if ($category["challenge"]) echo "checked"?>>
                  <label class='form-check-label' for='category-challenge'>挑戰</label>
                </div>
                <div class='form-check'>
                  <input class='form-check-input category-checkbox' type='checkbox' id='category-practice' name='category[]' value='practice' data-color='#d8bfd8' <?php if ($category["practice"]) echo "checked"?>>
                  <label class='form-check-label' for='category-practice'>練習</label>
                </div>
                <button type='submit' class='btn btn-primary'>重新整理</button>
              </form>
            </div>
          </div>
        </div>
        <div style='width: 10px;'></div>
        <div style='min-height: 425px;' class='col-md-7'>
          <!-- 公告卡片 -->
          <div id='announcement-list' style='margin-top: 20px;'>
            <?php
              $sql = 'SELECT posts.*, personal_info.name FROM posts LEFT JOIN personal_info ON posts.acc_id = personal_info.acc_id';
              if (!($category["question"] && $category["solution"] && $category["challenge"] && $category["practice"])){
                $sql = $sql . " WHERE";
                $first = 1;
                if (!$category["question"]){
                  $sql = $sql . " posts.category != '提問'";
                  $first = 0;
                }
                if (!$category["solution"]){
                  if (!$first) $sql = $sql . " AND";
                  $sql = $sql . " posts.category != '題解'";
                  $first = 0;
                }
                if (!$category["challenge"]){
                  if (!$first) $sql = $sql . " AND";
                  $sql = $sql . " posts.category != '挑戰'";
                  $first = 0;
                }
                if (!$category["practice"]){
                  if (!$first) $sql = $sql . " AND";
                  $sql = $sql . " posts.category != '練習'";
                  $first = 0;
                }
              }
              
              $stmt = $connect->prepare($sql);
              $stmt->execute();
              $announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);

              foreach ($announcements as $announcement) {
                // 根據分類設置顏色和粗細
                $category_style = [
                  '提問' => 'border-left: 8px solid #ffcccb; font-weight: bold;',
                  '題解' => 'border-left: 8px solid #ffefd5; font-weight: bold;',
                  '挑戰' => 'border-left: 8px solid #e0ffff; font-weight: bold;',
                  '練習' => 'border-left: 8px solid #d8bfd8; font-weight: bold;'
                ];

                // 獲取留言數量
                $comment_count_sql = 'SELECT COUNT(*) AS comment_count FROM comments WHERE post_id = :post_id';
                $comment_count_stmt = $connect->prepare($comment_count_sql);
                $comment_count_stmt->bindParam(':post_id', $announcement['id'], PDO::PARAM_INT);
                $comment_count_stmt->execute();
                $comment_count = $comment_count_stmt->fetch(PDO::FETCH_ASSOC)['comment_count'];

                // Card 樣式的公告顯示，加上點擊跳轉到 detailpost.php
                echo "<a href='detailpost.php?id=" . $announcement['id'] . "' class='card mb-3 d-flex' style= 'text-decoration: none; " . $category_style[$announcement['category']] . " ' cursor: pointer;'>";
                echo "<div class='card-body d-flex flex-column row justify-content-between'>";
                echo "<div>";
                echo "<h5 class='card-title mb-2'>" . htmlspecialchars($announcement['title']) . "</h5>";
                echo "<h6 class='card-subtitle mb-2 text-muted'>" . htmlspecialchars($announcement['keywords']) . "</h6>";
                echo "<p class='card-text mb-0'>分類：" . htmlspecialchars($announcement['category']) . "</p>";
                echo "</div>";
                echo "<div class='d-flex flex-column text-end' style='margin-top:-5rem'>";
                echo "<p class='card-text mb-2'>留言數量：" . htmlspecialchars($comment_count) . "</p>";
                echo "<p class='card-text mb-0'>" . htmlspecialchars($announcement['name']) . "</p>";
                echo "<p class='card-text mb-0'>" . htmlspecialchars($announcement['created_at']) . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</a>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript 部分，用於控制分類的顯示和全選功能 -->
    <script>
      // 全選和全不選按鈕的點擊事件
      document.getElementById('category-all').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('.category-checkbox');
        checkboxes.forEach(function(checkbox) {
          checkbox.checked = true;
        });
      });

      document.getElementById('category-none').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('.category-checkbox');
        checkboxes.forEach(function(checkbox) {
          checkbox.checked = false;
        });
      });
    </script>

    <!-- 發布的 Modal -->
    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="announcementModalLabel">發布新討論</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="../db/publish_post.php" method="post">
              <div class="mb-3">
                <label for="title" class="form-label">標題</label>
                <input type="text" class="form-control" id="title" name="title" required>
              </div>
              <div class="mb-3">
                <label for="keywords" class="form-label">關鍵字</label>
                <input type="text" class="form-control" id="keywords" name="keywords">
              </div>
              <div class="mb-3">
                <label for="category" class="form-label">分類</label>
                <select class="form-select" id="category" name="category" required>
                  <option selected disabled value="">選擇分類</option>
                  <option value="提問">提問</option>
                  <option value="題解">題解</option>
                  <option value="挑戰">挑戰</option>
                  <option value="練習">練習</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="content" class="form-label">內容</label>
                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">發布</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  </body>
  </html>