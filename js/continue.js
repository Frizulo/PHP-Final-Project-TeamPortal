function handleSubset(subsetId, radioYesId, radioNoId){
    var yesRadio = document.getElementById(radioYesId);
    var noRadio = document.getElementById(radioNoId);
    var subset = document.getElementById(subsetId);
    function handleChange(){
        if(yesRadio.checked){
            subset.style.display = "block";
        }
        else if(noRadio.checked){
            subset.style.display = "none";
        }
    }
    handleChange();
    yesRadio.addEventListener("change", handleChange);
    noRadio.addEventListener("change", handleChange);
}
  
handleSubset("q1_yes", "q1_yes_radio", "q1_no_radio");
handleSubset("q3_yes", "q3_yes_radio", "q3_no_radio");
  