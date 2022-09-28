import { ID_FROM_URL_CRUD, URL_PATH_API } from '../structure/consts/consts.js';
import { ajaxRequest } from '../structure/functions/ajax.js';
import { getInputValues, hideModal } from '../structure/functions/functions.js';
import { deleteLineOnDataTable } from '../structure/functions/datatable.js';
import { deletedSuccessSweetAlert, insertedSuccessSweetAlert, updatedSuccessSweetAlert } from '../structure/functions/sweetalert.js';


$(document).ready(function () {

    const SECTION  = 'check_list_js';
    const NAME_INPUTS = ['nome', 'descricao'];

    $(function () {

        $(document).on('click', '#checklist', function(event){
            event.preventDefault();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var oFormulario = document.getElementById('formulario');
            let data = getInputValues(NAME_INPUTS);
  
            ajaxRequest({
                
                url: `${URL_PATH_API}/${SECTION}`,
                type: 'POST',
                data: {_token: CSRF_TOKEN, nome: data.nome, descricao: data.descricao, id_usuario: oFormulario.getAttribute('usuario')},
                success: function (response) {
                    insertedSuccessSweetAlert(response.message, 'check_list');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            }, {
                inputs: NAME_INPUTS
            });
        });

        $(document).on('click', '#button_update', function(event){
            event.preventDefault();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
                oFormulario = document.getElementById('formulario'),
                dataValues = getInputValues(NAME_INPUTS);
                dataValues['id_usuario'] = oFormulario.getAttribute('usuario');
                dataValues['id'] = oFormulario.getAttribute('checklist');
            console.log(this);
            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}`,
                type: 'PUT',
                data: {
                    _token: CSRF_TOKEN,
                    ...dataValues
                },
                success: function (response) {
                    updatedSuccessSweetAlert('Atualizado!', 'check_list');
                }
            }, {
                inputs: NAME_INPUTS
            });
        });

        $(document).on('click', '#button_delete', function(event){
            event.preventDefault();
            var id_usuario  = this.getAttribute('id_usuario'),
                id_checklist    = this.getAttribute('id_checklist'),
                CSRF_TOKEN    = $('meta[name="csrf-token"]').attr('content');
                console.log(this);
            ajaxRequest({
                url: '/api/check_list_js/'+id_checklist+'/'+id_usuario,
                type: 'DELETE',
                data: {
                    _token: CSRF_TOKEN
                },
                success: function (response) {
                    console.log(response);
                    deletedSuccessSweetAlert('Removido!', 'check_list');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        });
    });

});
