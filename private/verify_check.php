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
  <title>程式培訓隊 | 審核 - checking</title>
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
  <div class="container mt-4">
    <div class="row center">
      <div class="col-md-3 mt-4">
          <div class="d-flex align-items-center" style="gap: 5px;">
            <img src="../pic/icon/sign_B.svg" alt="form" class="d-inline-block align-text-top">
            <span class="ml-2">基礎資料</span>
          </div>
          <!-- 基礎資料 -->
          <?php
                ini_set('display_errors','off');
                error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
                include_once("../db/01_conn.php");
                
                $id = $_GET["id"];

                $sql = "SELECT * FROM review where id = $id";
                $connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
                $result = $connect->query($sql);
                $result->setFetchMode(PDO::FETCH_BOTH);
                $row = $result->fetch();
            ?>
            <table>
                <tbody>
                    <tr>
                        <th>學號</th>
                        <td><?php echo $row["stu_id"] ?></td>
                    </tr>
                    <tr>
                        <th>姓名</th>
                        <td><?php echo $row["fullname"] ?></td>
                    </tr>
                    <tr>
                        <th>電子信箱</th>
                        <td><?php echo $row["email"] ?></td>
                    </tr>
                    <tr>
                        <th>申請時間</th>
                        <td><?php echo $row["create_time"] ?></td>
                    </tr>
                </tbody>
            </table>
      </div>
      <div style="width: 10px;"></div>
      <div style="height: 60vh;" class="col-md-4 mt-4 scroll-y-only">
          <div>
            <table>
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>問題</th>
                        <th>回答</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Q1</td>
                        <td>是否參加過APCS？</td>
                        <td><?php echo $row["q1"] ?></td>
                    </tr>
                    <tr>
                        <td>Q1-1</td>
                        <td>最高級分(觀念/實作)</td>
                        <td><?php echo $row["ApcsC"] . "/" . $row["ApcsP"] ?></td>
                    </tr>
                    <tr>
                        <td>Q1-2</td>
                        <td>最高原始分數(觀念/實作)</td>
                        <td><?php echo $row["rawApcsC"] . "/" . $row["rawApcsP"] ?></td>
                    </tr>
                    <tr>
                        <td>Q1-3</td>
                        <td>參加 APCS 的原因</td>
                        <td><?php echo $row["ApcsReason"] ?></td>
                    </tr>
                    <tr>
                        <td>Q2</td>
                        <td>是否參加過其他程式競賽？</td>
                        <td><?php echo $row["q2"] ?></td>
                    </tr>
                    <tr>
                        <td>Q3</td>
                        <td>是否參加過CPE？</td>
                        <td><?php echo $row["q3"] ?></td>
                    </tr>
                    <tr>
                        <td>Q3-1</td>
                        <td>CPE 最高級分</td>
                        <td><?php echo $row["q3_1"] ?></td>
                    </tr>
                    <tr>
                        <td>Q3-2</td>
                        <td>CPE 最高排名百分比</td>
                        <td><?php echo $row["q3_2"] ?></td>
                    </tr>
                    <tr>
                        <td>Q3-3</td>
                        <td>參加 CPE 的原因</td>
                        <td><?php echo $row["q3_3"] ?></td>
                    </tr>
                    <tr>
                        <td>Q4</td>
                        <td>練習程式的管道</td>
                        <td><?php echo $row["q4"] ?></td>
                    </tr>
                    <tr>
                        <td>Q5</td>
                        <td>學程式多久了？</td>
                        <td><?php echo $row["q5"] ?></td>
                    </tr>
                    <tr>
                        <td>Q6</td>
                        <td>遇到的困難？</td>
                        <td><?php echo $row["q6"] ?></td>
                    </tr>
                    <tr>
                        <td>Q7</td>
                        <td>其他程式相關的表現</td>
                        <td><?php echo $row["q7"] ?></td>
                    </tr>
                    <tr>
                        <td>Q8</td>
                        <td>報名培訓隊的原因</td>
                        <td><?php echo $row["q8"] ?></td>
                    </tr>
                    <tr>
                        <td>Q9</td>
                        <td>其他想說的話</td>
                        <td><?php echo $row["q9"] ?></td>
                    </tr>
                </tbody>
            </table>
          </div>
      </div>
      <div class="center" style="margin:20px">
        <a class="btn btn-primary" href=<?php echo "'verify_pass.php?id=$id'"?>>通過</a>
        <a class="btn btn-danger ms-2" href=<?php echo "'verify_fail.php?id=$id'"?>>淘汰</a>
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