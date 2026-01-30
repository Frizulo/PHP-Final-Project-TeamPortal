<?php
  session_start();
  if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
      header("Location: bulletin.php");
      exit;
  }
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <title>程式培訓隊 | 審核</title>
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
            <a class="changeliner nav-link" aria-current="page" href="javascript:location.reload();">
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

  <div style="margin: 10px; margin-left: 70px">
    <div style="text-align: center; /* 文字置中 */">
      <div class="d-flex align-items-center" style="gap: 5px;">
        <img src="../pic/icon/list_B.svg" alt="list" class="d-inline-block align-text-top">
        <span class="ml-2">快看這些新朋友!!</span>
      </div>
      <div id="announcement-list" style="margin-top: 20px;">
        <table>
          <tbody>
            <thead>
              <tr>
                <th>編號</th>
                <th>學號</th>
                <th>姓名</th>
                <th>電子信箱</th>
                <th>申請時間</th>
                <th></th>
              </tr>
            </thead>
            <?php
              ini_set('display_errors','off');
              error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
              include_once("../db/01_conn.php");
              
              $sql = "SELECT id, stu_id, fullname, email, create_time FROM review where NOT checked";
              $connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
              $result = $connect->query($sql);
              $result->setFetchMode(PDO::FETCH_BOTH);
              
              $row_count = 0; 
              while ($row = $result->fetch()){
                $class = ($row_count % 2 == 0) ? 'A' : 'B'; // 奇偶背景差異
                echo "<tr class='$class'>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["stu_id"] . "</td>";
                echo "<td>" . $row["fullname"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["create_time"] . "</td>";
                echo "<td><a href='verify_check.php?id=" . $row["id"] . "'>審核</a></td>";
                echo "</tr>";
                
                $row_count++;   
              }
              
            ?>
          </tbody>
        </table>
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