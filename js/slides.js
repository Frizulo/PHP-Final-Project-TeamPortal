let slideIndex = 0;
function showSlide(n){
    const slides = document.querySelectorAll('.slide');
    if (n >= slides.length) { slideIndex = 0; }
    if (n < 0) { slideIndex = slides.length - 1; }
    slides.forEach(slide => slide.style.transform = `translateX(-${slideIndex * 100}%)`);
}

function changeSlide(n){
    showSlide(slideIndex += n);
}
//預設3秒交換
setInterval(() =>{
    changeSlide(1);
}, 3000);
//初始化
showSlide(slideIndex);
