<div class="content">
    <div class="card" style="padding:20px">
        <div class="container-fluid">
            <div class="form-group row">
                <h5 class="col-md-3">Localizar Contato</h5>
                <div class="col-md-6">
                    <input type="text" class="form-control" autofocus autocomplete="off" id="busca" onkeyup="searchContact(this.value)">
                </div>
                <div class="col-md-3">
                    <a type="text" class="btn btn-primary btn-fill pull-right" style="width:100%" data-toggle="modal" data-target="#newContact">Novo Contato</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div id="contactsResult"></div>
            </div>
            <div class="row" id="contacts">
                <?php
                $queryContacts = $queries->setSelect('*','contacts',"NCODUSER = {$tokenDecode->coduser}");
                if($queryContacts->rowCount() > 0){
                    while($dataContacts = $queryContacts->fetch()){
                ?>
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <div class="card card-user">
                        <div class="image">
                            <img src="assets/img/fundoContato.jpg" alt="..."/>
                        </div>
                        <div class="content">
                            <div class="author">
                                <a>
                                    <img class="avatar border-gray" src="assets/img/imgsContact/<?=$dataContacts['CIMG'] == "" ? "user.jpg" : $dataContacts['CIMG']?>"/>

                                    <h4 class="title"><?=$dataContacts['CNAME']?><br />
                                        <small><?=$dataContacts['NTEL']?></small>
                                    </h4>
                                </a>
                            </div>
                            <p class="description text-center"><?=$dataContacts['CEMPRESA']?></p>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-simple" data-toggle="modal" data-target="#updateContact" value="<?=$dataContacts['NCODCONTACT']?>" onclick="showDataModal(this.value)"><i class="fa fa-edit"></i></button>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }else{
                    echo "<h4 align='center'>Nenhum contato encontrado</h4>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Novo Contato -->
<div class="modal fade" id="newContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="javascript:func()" method="POST" id="formNewContact">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLongTitle">Atualizar Contato</h3>
                </div>
                <div class="modal-body">
                    <div id="erroRegister"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" placeholder="Entre com seu nome" name="nameContact">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Empresa</label>
                                <input type="text" class="form-control" placeholder="Entre com sua empresa" name="nameCompany">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text" class="form-control" placeholder="Entre com seu telefone" name="numTel" onkeydown="javascript: fMasc( this, mTel );" maxlength="14">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Entre com seu eamil" name="email">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Cargo</label>
                                <input type="text" class="form-control" placeholder="Entre com seu cargo" name="nameOffice">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <label>Selecione a imagem</label>
                            <div class="custom-file col-lg-12 col-sm-12 col-xs-12">
                                <input lang="es" type="file" name="newImg" class="custom-file-input col-lg-12 col-sm-12 col-xs-12" id="newImg" onChange="mostraImagem()">
                                <label class="custom-file-label" for="customFile">Escolha um arquivo</label>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <div id="showImg"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-fill btn-secondary pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-fill btn-primary pull-right">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Editar Contato -->
<div class="modal fade" id="updateContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="javascript:func()" method="POST" id="formUpdateContact">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLongTitle">Novo Contato</h3>
                </div>
                <div class="modal-body">
                    <div id="erroRegister"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" placeholder="Entre com seu nome" name="nameContact" id="nameContact">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Empresa</label>
                                <input type="text" class="form-control" placeholder="Entre com sua empresa" name="nameCompany" id="nameCompany">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text" class="form-control" placeholder="Entre com seu telefone" name="numTel" id="numTel" onkeydown="javascript: fMasc( this, mTel );" maxlength="14">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Entre com seu eamil" name="email" id="email">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Cargo</label>
                                <input type="text" class="form-control" placeholder="Entre com seu cargo" name="nameOffice" id="nameOffice">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <label>Selecione a imagem para alterar</label>
                            <div class="custom-file col-lg-12 col-sm-12 col-xs-12">
                                <input lang="es" type="file" name="newImgAlter" class="custom-file-input col-lg-12 col-sm-12 col-xs-12" id="newImgAlter" onChange="mostraImagemAlter()">
                                <label class="custom-file-label" for="customFile">Escolha um arquivo</label>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <div id="showImgAlter"></div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="modal-footer">
                    <button type="button" class="btn btn-fill btn-danger pull-left" id="deleteContact">Excluir</button>
                    <button type="submit" class="btn btn-fill btn-primary pull-right">Alterar</button>
                </div>
                <input type="hidden" name="codContact" id="codContact">
            </form>
        </div>
    </div>
</div>