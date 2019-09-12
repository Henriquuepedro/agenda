//LOGIN
$("#loginSystem").submit(function() {

    var code = $('#code').val();
    var pass = $('#pass').val();

    if(code < 6){
        $('#code').css({"border-color": "#ef3c59","border-weight":"1px","border-style":"solid"});
    }
    if(pass < 6){
        $('#pass').css({"border-color": "#ef3c59","border-weight":"1px","border-style":"solid"});
    }
    if((code < 6) || (pass < 6)){
        $('#erro').html('<div class="alert alert-danger text-center">Código e senha precisam conter 6 caracteres!</div>');
        exit();
    }

    $.ajax({
        type: "POST",
        data: {code: code, pass: pass},
        url: "src/config.php",
        cache: false,
        dataType: "json",
        success: function (data){
            if(data === 1){
                window.location.replace("index.php?url=home");
            }
        },
        error: function (erro) {
            $('#erro').html('<div class="alert alert-danger text-center">Código ou senha incorretas!</div>');
            $('#pass').css({"border-color": "#ef3c59","border-weight":"1px","border-style":"solid"});
            $('#code').css({"border-color": "#ef3c59","border-weight":"1px","border-style":"solid"});
            exit();
        }
    }); 
});

//LOGOUT
$("#logout").click(function() {
    var logout = true;
    $.ajax({
        type: "POST",
        data: {logout: logout},
        url: "src/config.php",
        cache: false,
        dataType: "json",
        success: function (data){
            if(data === 1){
                window.location.replace("index.php?url=login");
            }
        },
        error: function (erro) {
            alert('Erro ao enviar'+erro);
        }
    }); 
});
//ACTIVE NO MENU
var url_atual = window.location.href;
url_atual = url_atual.split('=')[1];
if(url_atual == null) { url_atual='home' };
$(document).ready(function(){
    $("."+url_atual.split('&')[0]).addClass("active");
});
//MASCARA
function fMasc(objeto,mascara){
    obj=objeto
    masc=mascara
    setTimeout("fMascEx()",1)
}
function fMascEx(){
    obj.value=masc(obj.value)
}
function mTel(tel){
    tel=tel.replace(/\D/g,"")
    tel=tel.replace(/^(\d)/,"($1")
    tel=tel.replace(/(.{3})(\d)/,"$1)$2")
    if(tel.length == 9) {
        tel=tel.replace(/(.{1})$/,"-$1")
    } else if (tel.length == 10) {
        tel=tel.replace(/(.{2})$/,"-$1")
    } else if (tel.length == 11) {
        tel=tel.replace(/(.{3})$/,"-$1")
    } else if (tel.length == 12) {
        tel=tel.replace(/(.{4})$/,"-$1")
    } else if (tel.length > 12) {
        tel=tel.replace(/(.{4})$/,"-$1")
    }
    return tel;
}
function mCEP(cep){
    cep=cep.replace(/\D/g,"")
    cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
    cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
    return cep
}
function mNum(num){
    num=num.replace(/\D/g,"")
    return num
}
//CONSULTA AJAX CONTATOS
function searchContact(result) {

    if(window.XMLHttpRequest) {
       req = new XMLHttpRequest();
    }
    else if(window.ActiveXObject) {
       req = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    $('#contactsResult').show();
    $('#contacts').hide();
    var url = "src/searchContact.php?result="+result;
    req.open("Get", url, true); 
    req.onreadystatechange = function() {
        if(req.readyState == 1) {
            document.getElementById('contactsResult').innerHTML = '<h4 align="center">Buscando contatos Aguarde...</h4>';
        }
        if(req.readyState == 4 && req.status == 200) {
            var resposta = req.responseText;
            document.getElementById('contactsResult').innerHTML = resposta;
        }
    }
    req.send(null);
}
//MOSTRAR NOME IMG
function mostraImagem() {
    var showName = $("#showImg");
    var diretorio = $("#newImg").val();
    var nomeImg = diretorio.split("\\");
    showName.html(nomeImg[2]);
}

function mostraImagemAlter() {
    var showName = $("#showImgAlter");
    var diretorio = $("#newImgAlter").val();
    var nomeImg = diretorio.split("\\");
    showName.html(nomeImg[2]);
}
//NOVO CONTATO
$("#formNewContact").submit(function() {

    var nameContact = $('input[name="nameContact"]').val();
    var nameCompany = $('input[name="nameCompany"]').val();
    var numTel = $('input[name="numTel"]').val();
    var email = $('input[name="email"]').val();
    var nameOffice = $('input[name="nameOffice"]').val();
    var msgErro = '<div class="alert alert-danger" align="center">Preencha todos os campos de texto para adicionar o contato!</div>';
    
    if((nameContact == '') || (nameCompany == '') || (numTel == '') || (email == '') || (nameOffice == '')){
        $('#erroRegister').html(msgErro);
        exit();
    }
    if(numTel.length < 13){
        $('#erroRegister').html(msgErro);
        exit();
    }

    var form_data = new FormData();

    form_data.append('newImg', $('#newImg').prop('files')[0]);
    form_data.append('nameContact', $('input[name="nameContact"]').val());
    form_data.append('nameCompany', $('input[name="nameCompany"]').val());
    form_data.append('numTel', $('input[name="numTel"]').val());
    form_data.append('email', $('input[name="email"]').val());
    form_data.append('nameOffice', $('input[name="nameOffice"]').val());
    form_data.append('insertContact', 'true');


    $.ajax({
        url: 'src/config.php',
        dataType: 'text', 
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(data){
            switch(data){
                case '0':
                    window.location.replace("index.php?url=myContacts");
                    break;
                case '1':
                    alert("Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita!");
                    break;
                case '2':
                    alert("Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"!");
                    break;
                case '':
                    alert("Ocorreu um erro inesperado, atualize a página e tente novamente!");
                    break;
            }
        },
        error: function (erro) {
            alert('Erro ao enviar'+erro);
        }
    }); 
});
function mascaraTelefone(value){
    value = value.replace(/\D/g,"");                  //Remove tudo o que não é dígito
    value = value.replace(/^(\d{2})(\d)/g,"($1)$2"); //Coloca parênteses em volta dos dois primeiros dígitos
    value = value.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    value = value.substr(0, 15);
    return value;
}
//MOSTRAR DADOS NO MODAL DE ATUALIZAÇÃO
function showDataModal(codContactsModal){

    $.ajax({
        type: "POST",
        data: {codContactsModal: codContactsModal},
        url: "src/config.php",
        cache: false,
        dataType: "json",
        success: function (data){
            $('#nameContact').val(data.CNAME);
            $('#nameCompany').val(data.CEMPRESA);
            $('#numTel').val(mascaraTelefone(data.NTEL));
            $('#email').val(data.CEMAIL);
            $('#nameOffice').val(data.CCARGO);
            $('#codContact').val(data.NCODCONTACT);

        },
        error: function (erro) {
            alert('Erro ao enviar'+erro);
        }
    }); 
}
//ATUALIZAR CONTATO
$("#formUpdateContact").submit(function() {

    var nameContact = $('#nameContact').val();
    var nameCompany = $('#nameCompany').val();
    var numTel = $('#numTel').val();
    var email = $('#email').val();
    var nameOffice = $('#nameOffice').val();
    var codContact = $('#codContact').val();
    var msgErro = '<div class="alert alert-danger" align="center">Preencha todos os campos de texto para alterar o contato!</div>';
    
    if(codContact == ''){
        alert("Erro inesperado, atualizaremos sua página!");
        window.location.replace("index.php?url=myContacts");
        exit();
    }
    if((nameContact == '') || (nameCompany == '') || (numTel == '') || (email == '') || (nameOffice == '') || (codContact == '')){
        $('#erroRegister').html(msgErro);
        exit();
    }
    if(numTel.length < 13){
        $('#erroRegister').html(msgErro);
        exit();
    }

    var form_data = new FormData();

    form_data.append('newImg', $('#newImgAlter').prop('files')[0]);
    form_data.append('nameContact', $('#nameContact').val());
    form_data.append('nameCompany', $('#nameCompany').val());
    form_data.append('numTel', $('#numTel').val());
    form_data.append('email', $('#email').val());
    form_data.append('nameOffice', $('#nameOffice').val());
    form_data.append('codContact', $('#codContact').val());
    form_data.append('updateContact', 'true');


    $.ajax({
        url: 'src/config.php',
        dataType: 'text', 
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(data){
            switch(data){
                case '0':
                    window.location.replace("index.php?url=myContacts");
                    break;
                case '1':
                    alert("Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita!");
                    break;
                case '2':
                    alert("Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"!");
                    break;
                case '':
                    alert("Ocorreu um erro inesperado, atualize a página e tente novamente!");
                    break;
            }
        },
        error: function (erro) {
            alert('Erro ao enviar'+erro);
        }
    }); 
});
//EXCLUIR CONTATO
$("#deleteContact").click(function() {

    var codContact = $('#codContact').val();
    
    if(codContact == ''){
        alert("Erro inesperado, atualizaremos sua página!");
        window.location.replace("index.php?url=myContacts");
        exit();
    }

    var form_data = new FormData();

    form_data.append('codContact', $('#codContact').val());
    form_data.append('deleteContact', 'true');


    $.ajax({
        url: 'src/config.php',
        dataType: 'text', 
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(data){
            switch(data){
                case '0':
                    window.location.replace("index.php?url=myContacts");
                    break;
                case '':
                    alert("Ocorreu um erro inesperado, atualize a página e tente novamente!");
                    break;
            }
        },
        error: function (erro) {
            alert('Erro ao enviar'+erro);
        }
    }); 
});