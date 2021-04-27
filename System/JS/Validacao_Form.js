function valida_form() {
    var senha = document.getElementById("senha").value.replace(/\s/g, "");
    var nome  = document.getElementById("nome").value.replace(/\s/g, "");
    var sobrenome = document.getElementById("sobrenome").value.replace(/\s+/g, " ").trim();
    var codigo_acesso = document.getElementById("codigo").value.replace(/\s/g, "");
    var estado = document.getElementById("estado").value;
    
    var validacao = false;

    if(senha.length < 8 || senha.length > 10 || senha == "")
        alert("Senha inválida");
    else if(nome.length > 30 || nome == "")
        alert("Nome inválido.");
    else if(sobrenome.length > 50 || sobrenome == "")
        alert("Sobrenome inválido.");
    else if(codigo_acesso.length < 10 || codigo_acesso.length > 10 || codigo_acesso == "")
        alert("Código de acesso inválido.");
    else if(estado == "" || estado == "...")
        alert("Digite um CEP válido.");
    else
        validacao = true;

    if(validacao)
        return true;
    else
        return false;
}