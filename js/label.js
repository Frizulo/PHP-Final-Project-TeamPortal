var pre='folder1';
document.addEventListener('DOMContentLoaded', function() {
  var start = sessionStorage.getItem('start');
  if(start === 'folder1'){
      toggleFolder('folder1');
  }
  else if (start === 'folder2'){
      toggleFolder('folder2');
  }
});

function toggleFolder(id){
  var showContent = document.getElementById(id + '-content');
  var preContent = document.getElementById(pre + '-content');
  var showLabel = document.getElementById(id);
  var preLabel = document.getElementById(pre);
  if (showContent !== preContent) {
    showContent.style.display = 'block';
    preContent.style.display = 'none';
    var showContent = document.getElementById(id + '-content2');
    var preContent = document.getElementById(pre + '-content2');
    showContent.style.display = 'block';
    preContent.style.display = 'none';
    showLabel.style.backgroundColor = '#EFF1E4';
    showLabel.style.marginBottom = "0";
    preLabel.style.backgroundColor = '#9BB4B3';
    preLabel.style.marginBottom = "0.125rem";
    swapFolders(id, pre); // 交換
    pre = id;
  }
}

// 交換位置
function swapFolders(a, b){
  var contentA = document.getElementById(a);
  var contentB = document.getElementById(b);
  var parent = contentA.parentNode;
  var nextSibling = contentA.nextSibling;
  parent.insertBefore(contentA, contentB);
  parent.insertBefore(contentB, nextSibling);
}
