
function checkAll() {  //全选
    var code_Values = document.getElementsByTagName("input"); 
    for(i = 0;i < code_Values.length;i++){ 
        if(code_Values[i].type == "checkbox") { 
            code_Values[i].checked = true; 
        } 
    } 
} 
function uncheckAll() { //全不选
    var code_Values = document.getElementsByTagName("input"); 
    for(i = 0;i < code_Values.length;i++){ 
        if(code_Values[i].type == "checkbox") { 
            code_Values[i].checked = false; 
        } 
    } 
} 
