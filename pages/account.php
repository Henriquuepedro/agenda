<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="content">
                        <form>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Nome da Empresa</label>
                                        <input type="text" disabled class="form-control" placeholder="Empresa" value="<?=$dataUser['CEMPRESA']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <input type="text" disabled class="form-control" placeholder="Telefone" onkeydown="javascript: fMasc( this, mTel );" maxlength="14" value="<?=$dataUser['NTEL']?>" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Usuário</label>
                                        <input type="text" disabled class="form-control" placeholder="Usuário" value="<?=$dataUser['CLOGIN']?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cargo</label>
                                        <input type="text" disabled class="form-control" placeholder="Cargo" value="<?=$dataUser['CCARGO']?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" disabled class="form-control" placeholder="Usuário" value="<?=$dataUser['CNAME']?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Endereço de Email</label>
                                        <input type="email" disabled class="form-control" placeholder="Email" value="<?=$dataUser['CEMAIL']?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Endereço</label>
                                        <input type="text" disabled class="form-control" placeholder="Endereço" value="<?=$dataUser['CENDERECO']?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Número</label>
                                        <input type="text" disabled class="form-control" placeholder="Número" value="<?=$dataUser['NNUMERO']?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <input type="text" disabled class="form-control" placeholder="Cidade" value="<?=$dataUser['CCIDADE']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Estado (sigla)</label>
                                        <input type="text" disabled class="form-control" placeholder="Estado"  maxlength="2" value="<?=$dataUser['CESTADO']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>CEP</label>
                                        <input type="text" disabled class="form-control" placeholder="CEP" onkeydown="javascript: fMasc( this, mCEP );" maxlength="10" value="<?=$dataUser['NCEP']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <textarea disabled rows="5" class="form-control" placeholder="Escreva um pouco sobre você."><?=$dataUser['CSTATUS']?></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- <button type="submit" class="btn btn-info btn-fill pull-right">Atualizar Dados</button> -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="assets/img/bottomProfile.jpg" alt="..."/>
                    </div>
                    <div class="content">
                        <div class="author">
                            <a href="#">
                            <img class="avatar border-gray" src="assets/img/faces/face-0.jpg" alt="..."/>

                            <h4 class="title"><?=$tokenDecode->name?><br />
                                <small><?=$tokenDecode->login?></small>
                            </h4>
                            </a>
                        </div>
                        <p class="description text-center">"<?=$dataUser['CSTATUS']?>"</p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                        <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                        <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>