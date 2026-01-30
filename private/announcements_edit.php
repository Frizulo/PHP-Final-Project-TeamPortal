<?php
  session_start();
  if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
      header("Location: ../LoginApply.html");
      exit;
  }
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <title>程式培訓隊 | 公佈欄</title>
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
          <p style="margin: 0;">程式培訓隊</p>
        </div> 
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex align-items-center" style="gap: 8px;">
          <li class="nav-item">
            <a class="changeliner nav-link active" aria-current="page" href="javascript:location.reload();">
              <div class="d-flex align-items-center" style="gap: 5px;">
                <img src="../pic/icon/home_B.svg" alt="home" class="d-inline-block align-text-top">
                <span class=" ml-2">首頁</span>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a class="changeliner nav-link" aria-current="page" href="discuss.html">
              <div class="d-flex align-items-center" style="gap: 5px;">
                <img src="../pic/icon/forum_B.svg" alt="discuss" class="d-inline-block align-text-top">
                <span class="ml-2">討論</span>
              </div>
            </a>
          </li>
        </ul>
        <!-- 右側 -->
        <span class="navbar-text">
          <ul  class="navbar-nav">            
            <li class="nav-item">
              <a class="nav-link" href="#">個人資訊</a>
            </li>
            <li class="nav-item">
                <a class="changeliner nav-link" href="../db/sign_out.php">
                  <img src="../pic/icon/SignOut_B.svg" alt="signOut" class="d-inline-block align-text-top">
                </a>
            </li>
          </ul>
        </span>
      </div>
    </div>
  </nav>
  
  <!-- 主要內容區域 -->
  <div class="container mt-4">
    <div class="row flex-row-reverse">
      <div class="col-md-4">
          <!-- 日歷 -->
          <div style="height: 100px;"></div>
          <div style="height: 325px;" class="card mb-4 bd">
            <p style=" color: #fff; background-color: #9bb4b3; margin-top: 10px; padding: 10px; width: 80%; border-radius: 20px; display: flex; justify-content: center; align-items: center;">今天是...</p>
            <div class="card-body">
              <div id="date-container" style="font-size: 3rem; font-weight: bold; color: #fa824c;">
                <div id="month"></div>
                <div id="day"></div>
                <div id="weekday"></div>
              </div>
            </div>
          </div>
      </div>
      <div style="width: 10px;"></div>
      <div style="height: 425px;" class="col-md-7">
          <!-- 公佈欄  -->
          <div class="d-flex align-items-center" style="gap: 5px;">
            <img src="../pic/icon/billboard.svg" alt="billboard" class="d-inline-block align-text-top">
            <span class="ml-2">公佈欄</span>
          </div>
          <div id="announcement-list" style="margin-top: 20px;">
            <!-- 公告會顯示在這裡 -->
            <?php
                ini_set('display_errors','off');
                error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
                include_once("../db/01_conn.php");

                $id = $_GET["id"];

                try{
                    $sql = "SELECT * FROM announcements where id = '$id'";
                    $connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
                    $result = $connect->query($sql);
                    $result->setFetchMode(PDO::FETCH_BOTH);
                    $row = $result->fetch();
                    echo "<form action='announcements_update.php?id=$id' method='post'>";
                    echo "<input type='text' id='announcement-title' name = 'title' maxlength='30' placeholder='輸入公告標題' value=\"" . $row["title"] . "\" required>";
                    echo "<input type='submit' value='更新'><br>";
                    echo "<textarea id='announcement-content' name='content' rows='10' cols='40' placeholder='輸入公告內容' required>" . $row["content"] . "</textarea>";
                    echo "</form>";
                }catch (PDOException $e){
                  echo "<script>";
                  echo "alert('公告載入失敗。');";
                  echo "window.location.href = \'announcements.php?id=$id';";
                  echo "</script>";
                }
            ?>
          </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var currentDate = new Date();

      var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
      var month = monthNames[currentDate.getMonth()];
      var day = currentDate.getDate();
      var weekdayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      var weekday = weekdayNames[currentDate.getDay()];

      document.getElementById('month').innerText =month;
      document.getElementById('day').innerText =day;
      document.getElementById('weekday').innerText =weekday;
    });
  </script> 

  <!-- footer!! -->
  <footer>
    <p>Copyright &copy; 2024 程式培訓隊</p>
    <p style="padding: 2px;">Designed by Frizulo</p>
  </footer>

  <!-- JS -->
  <script src="js/announcements.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>