function calcular(){
    const cop = new Intl.NumberFormat('es-CO',{
        style:'currency',
        currency:'COP',
        minimumFractionDigits:0
    })

    var a = parseFloat(document.getElementById("listprecios").value)
    var b = parseFloat(document.getElementById("cantidad").value)
    document.getElementById("total").innerHTML = cop.format(a*b)
}