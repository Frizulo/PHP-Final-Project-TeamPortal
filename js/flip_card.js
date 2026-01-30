// 所有.card
var cards = document.querySelectorAll('.card');

//
cards.forEach(function(card){
  card.addEventListener('click', function(){
    this.classList.toggle('flipped'); // 翻面
  });
});
