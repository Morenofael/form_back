const body = document.querySelector("body");
function validar(){
    let nome = document.getElementById("nome").value;
    let endereco = document.getElementById("endereco").value;
    if(nome == "" || endereco == ""){
        let avisoDiv = document.createElement("div");
        avisoDiv.innerHTML = "Dê todas as informações";
        avisoDiv.style.color = "red";
        body.appendChild(avisoDiv);
        return false
    }
    return true;
}