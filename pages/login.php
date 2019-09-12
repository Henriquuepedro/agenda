<style>
body{
    background-image:url('assets/img/fundo.jpg');
    overflow: hidden;
}
</style>
<div class="content" style="margin:15px;margin-top:8%">
    <div class="col-md-4 col-md-offset-4" style="background-color: rgba(255,255,255,0.6);padding:20px">
        <form action="javascript:func()" method="POST" id="loginSystem">
            <div class="row">
                <div class="col-md-12">
                <div id="erro"></div>
                    <div class="form-group">
                        <h2 class="col-md-10 col-md-offset-1">Entrar</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group col-md-10 col-md-offset-1">
                        <label>Código</label>
                        <input type="text" class="form-control" placeholder="Entre com seu código" id="code" name="code">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group col-md-10 col-md-offset-1">
                        <label>Senha</label>
                        <input type="password" class="form-control" placeholder="Entre com sua senha" id="pass" name="pass">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group col-md-10 col-md-offset-1">
                        <button type="submit" class="btn btn-primary btn-fill" style="width:100%">Entrar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>