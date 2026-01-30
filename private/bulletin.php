<!-- bulletin.html 內首頁 member才可進 #公佈欄 #簽到 #內頁 -->
<?php
  session_start();
  if (!isset($_SESSION['user_id'])) {
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
          <p class="MinScrDis" style="margin: 0;">程式培訓隊</p>
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
        <div style="min-height: 425px;" class="col-md-7">
            <!-- 公佈欄  -->
            <div class="d-flex align-items-center justify-content-between" style="margin-bottom: -16px">
              <div class="d-flex align-items-center" style="gap: 5px;">
                <img src="../pic/icon/billboard.svg" alt="billboard" class="d-inline-block align-text-top">
                <span class="ml-2">公佈欄</span>
              </div>
              <!-- 發佈按鈕 -->
              <?php if ($_SESSION['role'] == 'admin'): ?>
              <div class="center" id="announcement-form">
                <!-- 點擊跳出顯示 -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#announcementModal">
                  <img style="width:20px; height:20px"z src="../pic/icon/post_W.svg" alt="post" class="d-inline-block align-text-top">
                  <span class="ml-2">發佈</span>
                </button>
                <!-- 顯示部分 -->
                <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="announcementModalLabel">新增公告</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="../db/bulletin_process.php" method="post">
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="announcement-title" class="form-label">標題</label>
                            <input type="text" class="form-control" id="announcement-title" name="title" maxlength="30" placeholder="輸入公告標題(字數限制: 30)" required>
                          </div>
                          <div class="mb-3">
                            <label for="announcement-content" class="form-label">公告內容</label>
                            <textarea class="form-control" id="announcement-content" name="content" rows="5" placeholder="輸入公告內容" required></textarea>
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
              </div>
              <?php endif; ?>
            </div>

            <div id="announcement-list" style="margin-top: 20px; height:360px">
              <!-- 公告會顯示在這裡 -->
              <table>
                <tbody>
                  <thead>
                    <tr>
                      <th style="width: 475px">標題</th>
                      <th style="width: 155px" class='publish-date'>發布時間</th>
                    </tr>
                  </thead>
                  <?php
                    ini_set('display_errors','off');
                    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
                    include_once("../db/01_conn.php");
                    
                    $sql = "SELECT COUNT(*) AS total_rows FROM announcements";
                    $connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
                    $result = $connect->query($sql);
                    $result->setFetchMode(PDO::FETCH_BOTH);
                    $row = $result->fetch();
                    $total_rows = $row["total_rows"];

                    $sql = "SELECT * FROM announcements ORDER BY created_at DESC";
                    $connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
                    $result = $connect->query($sql);
                    $result->setFetchMode(PDO::FETCH_BOTH);

                    $max_page = $total_rows / 8;
                    if ($total_rows % 8 > 0) $max_page++;
                    $page = $_GET["page"];
                    if ($page == 0) $page = 1;
                    else if ($page > $max_page) $page = $max_page;
                    else $page = (int)$page;
                    

                    $max_row = 8;
                    $row_count = 0;
                    $start = ($page - 1) * 8;
                    
                    while ($row = $result->fetch()){
                      if ($row_count >= $start + 8) break;
                      if ($row_count >= $start){
                        $class = ($row_count % 2 == 0) ? 'A' : 'B'; // 奇偶背景差異
                        echo "<tr class='$class'>";
                        echo "<td><a href=\"#\" data-bs-toggle=\"modal\" data-bs-target=\"#announcementModal_" . $row["id"] . "\">" . $row["title"] . "</a></td>";
                        echo "<td class='publish-date'>" . $row["created_at"] . "</td>";
                        echo "</tr>";

                        // Modal內容
                        echo "<div class=\"modal fade\" id=\"announcementModal_" . $row["id"] . "\" tabindex=\"-1\" aria-labelledby=\"announcementModalLabel_" . $row["id"] . "\" aria-hidden=\"true\">";
                        echo "<div class=\"modal-dialog\">";
                        echo "<div class=\"modal-content\">";
                        echo "<div class=\"modal-header\">";
                        echo "<h5 class=\"modal-title\" id=\"announcementModalLabel_" . $row["id"] . "\">" . $row["title"] . "</h5>";
                        echo "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>";
                        echo "</div>";
                        echo "<div class=\"modal-body\">";
                        echo "<p>" .  nl2br(htmlspecialchars($row["content"])) . "</p>"; 
                        echo "</div>";
                        echo "<div class=\"modal-footer justify-content-between\">";
                        echo "<p class='text-muted'>發布時間：" . htmlspecialchars($row["created_at"]) . "</p>";
                        echo "<div >"; // 包住button for 分左右
                        if ($_SESSION['role'] == 'admin'):
                          echo "<button type=\"button\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#editModal_" . $row["id"] . "\">編輯</button>";
                          echo "<button type=\"button\" class=\"btn btn-danger ms-2\" data-bs-toggle=\"modal\" data-bs-target=\"#deleteModal_" . $row["id"] . "\">刪除</button>";
                        endif;
                        echo "<button type=\"button\" class=\"btn btn-secondary ms-2\" data-bs-dismiss=\"modal\">關閉</button>";
                        
                        echo "</div>"; // end
                        
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";


                        // Edit Modal
                        echo "<div class=\"modal fade\" id=\"editModal_" . $row["id"] . "\" tabindex=\"-1\" aria-labelledby=\"editModalLabel_" . $row["id"] . "\" aria-hidden=\"true\">";
                        echo "<div class=\"modal-dialog\">";
                        echo "<div class=\"modal-content\">";
                        echo "<div class=\"modal-header\">";
                        echo "<h5 class=\"modal-title\" id=\"editModalLabel_" . $row["id"] . "\">編輯公告</h5>";
                        echo "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>";
                        echo "</div>";
                        echo "<div class=\"modal-body\">";
                        echo "<form action=\"announcements_update.php?id=" . $row["id"] . "\" method=\"post\">";
                        echo "<div class=\"mb-3\">";
                        echo "<label for=\"edit-announcement-title\" class=\"form-label\">標題</label>";
                        echo "<input type=\"text\" class=\"form-control\" id=\"edit-announcement-title\" name=\"title\" value=\"" . $row["title"] . "\" required>";
                        echo "</div>";
                        echo "<div class=\"mb-3\">";
                        echo "<label for=\"edit-announcement-content\" class=\"form-label\">內容</label>";
                        echo "<textarea class=\"form-control\" id=\"edit-announcement-content\" name=\"content\" rows=\"5\" required>" . $row["content"] . "</textarea>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"modal-footer\">";
                        echo "<button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">取消</button>";
                        echo "<button type=\"submit\" class=\"btn btn-primary\">更新</button>";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";

                        // Delete Modal
                        echo "<div class=\"modal fade\" id=\"deleteModal_" . $row["id"] . "\" tabindex=\"-1\" aria-labelledby=\"deleteModalLabel_" . $row["id"] . "\" aria-hidden=\"true\">";
                        echo "<div class=\"modal-dialog\">";
                        echo "<div class=\"modal-content\">";
                        echo "<div class=\"modal-header\">";
                        echo "<h5 class=\"modal-title\" id=\"deleteModalLabel_" . $row["id"] . "\">確認刪除</h5>";
                        echo "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>";
                        echo "</div>";
                        echo "<div class=\"modal-body\">";
                        echo "<p>確定要刪除這則公告嗎？刪了就真的掰掰ㄌψ(._. )></p>";
                        echo "</div>";
                        echo "<div class=\"modal-footer\">";
                        echo "<button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">取消</button>";
                        echo "<a href=\"announcements_delete.php?id=" . $row["id"] . "\" class=\"btn btn-danger\">刪除</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                      }

                      $row_count++; 
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <div id="pagination" style="margin-top: 20px; text-align: center;">
              <!-- 分頁會顯示在這裡 -->
              <?php
                $pre = $page - 1;
                $nxt = $page + 1;
                if ($pre == 0) $pre = 1;
                if ($nxt > $max_page) $nxt = $max_page;
                // echo "<a href='bulletin.php?page=$pre'>上一頁</a>";
                // echo "<a href='bulletin.php?page=$nxt'>下一頁</a>";
                $max_page = floor($max_page);
                // echo $max_page;
              ?>
              <nav aria-label="Page navigation example">
                  <ul class="pagination">
                      <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                          <a class="page-link" href="bulletin.php?page=<?php echo $pre; ?>" tabindex="-1" aria-disabled="true">上一頁</a>
                      </li>
                      <!-- 最多顯示 5 -->
                      <?php for ($i = max(1, $page - 2); $i <= min($page + 2, $max_page); $i++) { ?>
                          <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                              <a class="page-link" href="bulletin.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                          </li>
                      <?php } ?>
                      <li class="page-item <?php echo ($page == $max_page) ? 'disabled' : ''; ?>">
                          <a class="page-link" href="bulletin.php?page=<?php echo $nxt; ?>">下一頁</a>
                      </li>
                  </ul>
              </nav>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  </body>
  </html>