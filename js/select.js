function calcular(){
    try{
        var a = parseFloat(document.getElementById("listprecios").value) || 0;
        var b = parseFloat(document.getElementById("cantidad").value) || 0;
        document.getElementById("total").innerText = a * b;
    }catch(e){}
}