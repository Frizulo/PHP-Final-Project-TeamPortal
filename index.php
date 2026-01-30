<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>程式培訓隊 | 介紹</title>
    <meta name="author" content="Frizulo"/>
    <meta name="description" content="歡迎來到臺東大學程式培訓隊的官方網站，這裡將為您介紹我們組織，還有程式檢定或競賽的介紹，希望對你有幫助(❁´◡`❁)">
    <meta name="keywords" content=" 程式培訓隊, 程式檢定, 程式競賽, 臺東大學, 台東大學,">
    <meta name=”robots” content="index, follow">
    <meta name="google-site-verification" content="8cLjjhQ6va5CSJqG3TpzIlVdGf0bWxoC-QhMSDReZDY" />
    <link rel="stylesheet" href="style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./pic/logo.svg" type="image/svg+xml"/>
</head>
<body>
    <!-- 上面打字機 -->
    <div class="center" style="height: auto; padding: 20px;">
        <div class="typewriter" id="typewriter"></div>
    </div>
    <!-- 可愛nav >< -->
    <div class="nav1">
        <div>
            <a href="javascript:location.reload();">
                <img src="./pic/logo.svg" alt="logo">
            </a>
            <p>程式培訓隊</p> 
        </div>
        <div>
            <a id="login" class="btn1" href="LoginApply.html">登入</a>
            <a id="apply" class="btn2" href="LoginApply.html">申請</a>
        </div>
    </div>

    <!-- 翻頁豬豬 -->
    <div class="all">
        <img src="./pic/PTT.png" alt="Porgramming Training Team">
        <div class="image-container" id="image-container">
            <img src="./pic/none.svg" alt="Image 1" class="image" id="image1">
            <img src="./pic/open-eye.svg" alt="Image 2" class="image" id="image2">
            <img src="./pic/close-eye.svg" alt="Image 3" class="image" id="image3">
        </div>
    </div>

    <!-- 相關指引 -->
    <section>
        <div class="topic">
            <div class="dashed-line"></div>
            <p>about us(*^▽^*)┛</p>
            <div class="dashed-line2"></div>
        </div>
        <div class="pic-text center">
            <div class="pic center">
                <img alt="who are we?" title="who are we?" src="pic/WhoAreWe.svg" style="background-color:#FFFFFF80; border-radius: 20px; border: 3.5px solid #36382E;">
            </div>
            <div class="text">
                <div class="subtitle">程式競賽培訓隊!</div>
                <hr></hr>
                <p>主要是培訓參加相關程式能力檢定或程式競賽之團隊～</p>
                <p>想提升能力，互相切磋、學習，都很歡迎喔～ </p>
                <p>希望大家能取得好成績！</p>
            </div>
        </div>
    </section>
    <br>
    
    <!-- 程式相關檢定/競賽 -->
    <section>
        <div>
            <div class="topic">
                <div class="dashed-line"></div>
                <p>程式檢定/競賽</p>
                <div class="dashed-line2"></div>
            </div>
            <h2 class="center">點擊卡片!翻頁看說明(´▽`ʃ♡ƪ)</h2>
            <br>
            <div class="multiple_cards center">
                <!-- CPE -->
                <div class="card">
                    <div class="cover">
                        <div class="front center">
                            <h3>CPE</h3>
                            <img src="./pic/logo.svg"  alt="logo">
                        </div>
                        <div class="back center">
                            <h3 style="margin: 0;">CPE&nbsp不專業解說</h3>
                            <ol>
                                <li>每年均舉辦 4 次</li>
                                <li>每次題目共 7 題</li>
                                <li>考試時間 3 小時</li>
                                <li>上機考試封閉網路</li>
                                <li>不能攜帶任何資料</li>
                            </ol>
                            更多詳細資料
                            <div>
                                <a title="CPE" class="link" href="https://cpe.cse.nsysu.edu.tw/" target="_blank">CPE 官網</a>
                            </div>
                        </div>
                    </div>
                </div>      

                <!-- NCPC -->
                <div class="card">
                    <div class="cover">
                        <div class="front center">
                            <h3>NCPC</h3>
                            <img src="./pic/logo.svg"  alt="logo">
                        </div>
                        <div class="back center">
                            <h3 style="margin: 0;">NCPC&nbsp不專業解說</h3>
                            <ol>
                                <li>初賽方式：線上(3 hr)</li>
                                <li>決賽方式：實機(5 hr)</li>
                                <li> 3 人一隊(可+1預備)</li>
                                <li>不得改變預設環境</li>
                                <li>僅可帶A4大小單面25頁</li>
                            </ol>
                            更多詳細資料
                            <div>
                                <a title="NCPC" class="link" href="https://ncpc.ntnu.edu.tw/" target="_blank">NCPC 官網</a>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
    <br>
    <section>
        <div class="topic">
            <div class="dashed-line"></div>
            <p>( ﾉ ﾟｰﾟ)ﾉactivity photos</p>
            <div class="dashed-line2"></div>
        </div>
        <div class="carousel">
            <div class="slides">
                <img src="./pic/slides/image1.jpg" alt="Slide 1" class="slide">
                <img src="./pic/slides/image2.jpg" alt="Slide 2" class="slide">
                <img src="./pic/slides/image3.jpg" alt="Slide 3" class="slide">
                <img src="./pic/slides/image4.jpg" alt="Slide 4" class="slide">
                <img src="./pic/slides/image5.jpg" alt="Slide 5" class="slide">
            </div>
            <button type="button" class="prev" onclick="changeSlide(-1)">&#10094;</button>
            <button type="button" class="next" onclick="changeSlide(1)">&#10095;</button>
        </div>        
    </section>
    <br>

    <!-- footer!! -->
    <footer>
        <p>Copyright &copy; 2024 程式培訓隊</p>
        <p style="padding: 2px;">Designed by 林莅紋(Frizulo)</p>
        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fweb.nttu.edu.tw%2Fc02%2F&width=174&layout=button_count&action=like&size=large&share=true&height=46&appId" width="130" height="30" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        <div class="pic-text center">
            <div style="margin-top:0px;">
                <?php 
                include_once('db/03_visitor_update.php'); 
                ?>
            </div>
            <div style="margin-top:-30px;">
                <p>謝謝大家(*￣3￣)╭</p>
                <a style="margin-top:10px;" class="btn3" href="contant_us.html">contact us</a>
            </div>
        </div>
        <div style="margin-top:10px;"><a style=" padding: 10px" class="btn2" href="https://www.canva.com/design/DAGIVEueYIM/DJln-Q80HpdvlrZh2RcUhg/view?utm_content=DAGIVEueYIM&utm_campaign=designshare&utm_medium=link&utm_source=editor">期末PPT</a></div>
    </footer>
    
    <!--scroll to top-->
    <div id="scroll-to-top-btn">⩑</div>

    <!-- JS -->
    <script src="js/btn_to_LA.js"></script>
    <script src="js/stp.js"></script>
    <script src="js/typewriter.js"></script>
    <script src="js/flip_card.js"></script>
    <script src="js/logo-move.js"></script>
    <script src="js/slides.js"></script>
    <script src="js/mouse.js"></script>
</body>
</html>