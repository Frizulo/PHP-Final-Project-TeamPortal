// 遍歷all表單
document.querySelectorAll('form').forEach(function(form){
    form.addEventListener('submit', function(event){
        // 獲取現在提交的表單
        var currentForm = this;
        var yes=0;
        // 遍歷當前表單中的所有文本輸入框
        currentForm.querySelectorAll('input[type="text"], input[type="password"], textarea').forEach(function(input){
            var inputText = input.value;
            // 如果輸入的文字包含特殊字符
            if(hasSpecialChars(inputText)){
                yes++;
                event.preventDefault(); // 阻止表單提交
                input.classList.add('error'); // 添加錯誤樣式
            }
            else{
                input.classList.remove('error'); // 移除錯誤樣式
            }
        });
        if(yes){
            alert('表單中有'+yes+'格包含特殊字符，請修改後再提交。');
        }
    });
});

function hasSpecialChars(str){
    var specialChars = "~·`!！@#\$￥%^…&*()（）—-_=+[]{}【】、|\\;:；：'\"“‘,./<>《》?？，。";
    var specialArr = [];
    for(var i = 0; i < specialChars.length; i++){
        specialArr.push(specialChars.charAt(i));
    }
    var arr = [];
    for(var i = 0; i < str.length; i++){
        arr.push(str.charAt(i));
    }
    for(var i = 0; i < arr.length; i++){
        if(specialArr.includes(arr[i])){
            return true;
        }
    }
    return false;
}
