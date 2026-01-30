// 放要出來的字!
const texts = [
    "nice to meet you!",
    "嘿嘿~歡迎光臨♪(´▽｀)",
    "這裡是程式培訓隊（？",
    "快點來加入我們ヾ(⌐■_■)ノ♪",
    "你好呀~"
];
  
const typewriter = document.getElementById('typewriter');
function typeWriter(text, i){
    // 清光光(╯‵□′)╯︵┻━┻
    typewriter.textContent = '';
    typewriter.classList.remove('slide-up');
    // 打字
    function printChar(){
        if(i<text.length){
            typewriter.textContent += text.charAt(i);
            i++;
            setTimeout(printChar, 100);
        }
        else{
            //延遲1秒 換字中間縫隙
            setTimeout(()=>{
              // 打完向上滑出消失
            typewriter.classList.add('slide-up');
            // random下一個
            setTimeout(() => {
            typeWriter(texts[Math.floor(Math.random() * texts.length)], 0);
            }, 1500);
            }, 1000);
        }
    }
    // 讓他一直一直跑
    printChar();
  }
  
  // 第一個都是第一句~
  typeWriter(texts[0], 0);
  