import { ID_FROM_URL_CRUD, URL_PATH_API } from '../structure/consts/consts.js';
import { ajaxRequest } from '../structure/functions/ajax.js';
import { getInputValues, hideModal } from '../structure/functions/functions.js';
import { deleteLineOnDataTable } from '../structure/functions/datatable.js';
import { deletedSuccessSweetAlert, insertedSuccessSweetAlert, updatedSuccessSweetAlert } from '../structure/functions/sweetalert.js';


$(document).ready(function () {

    const SECTION  = 'usuario_atendimento_js';
    const NAME_INPUTS = ['nome', 'descricao', 'usuario'];

    $(function () {

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

        $(document).on('click', '#button_update', function(event){
            let dataValues = getInputValues(NAME_INPUTS);

            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}`,
                type: 'PUT',
                data: {
                    id: ID_FROM_URL_CRUD,
                    ...dataValues
                },
                success: function (response) {
                    hideModal('#modalUpdate');
                    updatedSuccessSweetAlert(response.message);
                }
            }, {
                inputs: NAME_INPUTS
            });
        });

        $(document).on('click', '#button_delete', function(event){
            event.preventDefault();
            var id_municipio  = this.getAttribute('codigo_cidade'),
                id_usuario    = this.getAttribute('codigo_usuario'),
                CSRF_TOKEN    = $('meta[name="csrf-token"]').attr('content');

            ajaxRequest({
                url: '/api/usuario_atendimento_js/'+id_municipio+'/'+id_usuario,
                type: 'DELETE',
                data: {
                    _token: CSRF_TOKEN
                },
                success: function (response) {

                    deletedSuccessSweetAlert('Removido!', 'usuario_atendimento');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        });

        $(document).on('click', '#excluir_todos', function(event){
            event.preventDefault();
            var id_usuario    = this.getAttribute('codigo_usuario'),
                CSRF_TOKEN    = $('meta[name="csrf-token"]').attr('content');

            ajaxRequest({
                url: '/api/usuario_atendimento_remove_todos/'+id_usuario,
                type: 'DELETE',
                data: {
                    _token: CSRF_TOKEN
                },
                success: function (response) {
                    deletedSuccessSweetAlert('Todos registros foram removidos!', 'usuario_atendimento');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        });
    });

});
