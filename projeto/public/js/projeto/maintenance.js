import { ID_FROM_URL_CRUD, URL_PATH_API } from '../structure/consts/consts.js';
import { ajaxRequest } from '../structure/functions/ajax.js';
import { getInputValues, hideModal } from '../structure/functions/functions.js';
import { deleteLineOnDataTable } from '../structure/functions/datatable.js';
import { deletedSuccessSweetAlert, insertedSuccessSweetAlert, updatedSuccessSweetAlert, errorAlert } from '../structure/functions/sweetalert.js';


$(document).ready(function () {

    const SECTION  = 'projeto';
    const NAME_INPUTS = ['nome', 'descricao', 'usuario'];

    

    $(function () {



        $(document).on('click', '#button-confirm-reabrir', function(event){
            event.preventDefault();  
         
            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}/reabrir`,
                type: 'PATCH',
                data: {id_projeto: this.getAttribute('id_projeto')},
                success: function (response) {
                    insertedSuccessSweetAlert(response.message, 'http://localhost:8000/dashboard');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        });

        $(document).on('click', '#cancelar_projeto', function(event){
            event.preventDefault();  
            var oListagem = document.getElementById('listagem_projeto');
            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}/cancelar`,
                type: 'PATCH',
                data: {id_projeto: this.getAttribute('id_projeto')},
                success: function (response) {
                    insertedSuccessSweetAlert(response.message, 'http://localhost:8000/projeto/'+oListagem.getAttribute('id_situacao'));
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        });


        $(document).on('click', '#aceitar_projeto', function(event){
            event.preventDefault();  
            var oListagem = document.getElementById('listagem_projeto');
            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}/aceitar`,
                type: 'PATCH',
                data: {id_projeto: this.getAttribute('id_projeto')},
                success: function (response) {
                    insertedSuccessSweetAlert(response.message, 'http://localhost:8000/projeto/'+oListagem.getAttribute('id_situacao'));
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        });


        $(document).on('click', '#recusar_projeto', function(event){
            event.preventDefault();  
            var oListagem = document.getElementById('listagem_projeto');
            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}/recusar`,
                type: 'PATCH',
                data: {id_projeto: this.getAttribute('id_projeto')},
                success: function (response) {
                    insertedSuccessSweetAlert(response.message, 'http://localhost:8000/projeto/'+oListagem.getAttribute('id_situacao'));
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        });

        $(document).on('click', '#concluir_projeto', function(event){
            event.preventDefault();  
            var oListagem = document.getElementById('listagem_projeto'),
                bPermiteConcluir = true,
                id_projeto = this.getAttribute('id_projeto');

            
            $.ajax({
                url: '/api/projeto/atividade_pendente/'+id_projeto,
                type: 'GET',
                success: function(result) {
                    console.log(result);
                    if(result.length > 0) {
                        bPermiteConcluir = false;
                        errorAlert('Existem atividades para serem concluídas ainda.');
                    }
                },
                
                complete: function(data) {
                    if (bPermiteConcluir) {
                        ajaxRequest({
                            url: `${URL_PATH_API}/${SECTION}/concluir`,
                            type: 'PATCH',
                            data: {id_projeto: id_projeto},
                            success: function (response) {
                                insertedSuccessSweetAlert(response.message, 'http://localhost:8000/projeto/'+oListagem.getAttribute('id_situacao'));
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                console.log(thrownError);
                            }
                        });

                    }
                }
            });
        });


        $(document).on('click', '#checklist', function(event){
            event.preventDefault();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var oFormLogin = document.getElementById('formLogin');
            let data = getInputValues(NAME_INPUTS);
  
            ajaxRequest({
                
                url: `${URL_PATH_API}/${SECTION}`,
                type: 'POST',
                data: {_token: CSRF_TOKEN, nome: data.nome, descricao: data.descricao, id_usuario: oFormLogin.getAttribute('usuario')},
                success: function (response) {
                    insertedSuccessSweetAlert(response.message);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            }, {
                inputs: NAME_INPUTS
            });
        });

        $(document).on('click', '#button_alterar', function(event){
            window.location.href = 'http://localhost:8000/projeto/'+this.getElementById('button_alterar').value;
        });

        $(document).on('click', '#button-confirm-delete', function(event){

            let id = this.getAttribute('id_projeto'),
                situacao = this.getAttribute('situacao');
            
            
            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}`,
                type: 'DELETE',
                data: {
                    id_projeto: id
                },
                success: function (response) {
                    insertedSuccessSweetAlert(response.message, 'http://localhost:8000/projeto/'+situacao);
                }
            });
        });



        $(document).on('click', '#concluir_atividade', function(event){
            event.preventDefault();
            var aValores = [];
            var oForm = document.getElementById('formulario');

            for (let i = 1; i <= document.getElementsByName("concluido[]").length; i++) {
                aValores[document.getElementsByName("concluido[]").item(i-1).id] = document.getElementsByName("concluido[]").item(i-1).checked ? 1 : 0;
            }


            ajaxRequest({
                url: '/api/check_list_atividade/concluir_atividades',
                type: 'POST',
                data: {id_checklist: oForm.getAttribute('id_checklist'), 
                        id_projeto: oForm.getAttribute('id_projeto'), 
                        atividades: aValores},
                success: function (response) {
                    insertedSuccessSweetAlert(response.message, 'http://localhost:8000/projeto/'+oForm.getAttribute('id_projeto'));
                   
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            }, {
                inputs: NAME_INPUTS
            });
            
        });
     
    });
});
