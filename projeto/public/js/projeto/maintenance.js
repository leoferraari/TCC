import { ID_FROM_URL_CRUD, URL_PATH_API } from '../structure/consts/consts.js';
import { ajaxRequest } from '../structure/functions/ajax.js';
import { getInputValues, hideModal } from '../structure/functions/functions.js';
import { deleteLineOnDataTable } from '../structure/functions/datatable.js';
import { deletedSuccessSweetAlert, insertedSuccessSweetAlert, updatedSuccessSweetAlert } from '../structure/functions/sweetalert.js';


$(document).ready(function () {

    const SECTION  = 'projeto';
    const NAME_INPUTS = ['nome', 'descricao', 'usuario'];

    

    $(function () {

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
            var oListagem = document.getElementById('listagem_projeto');
            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}/concluir`,
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

            let id = $('#button-confirm-delete').data('value');
            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}`,
                type: 'DELETE',
                data: {
                    id: id
                },
                success: function (response) {
                    hideModal('#modalDelete');
                    deleteLineOnDataTable('#data-table', id);
                    deletedSuccessSweetAlert(response.message);
                }
            });
        });
    });
});
