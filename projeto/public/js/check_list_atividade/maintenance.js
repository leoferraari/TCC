import { ID_FROM_URL_CRUD, URL_PATH_API } from '../structure/consts/consts.js';
import { ajaxRequest } from '../structure/functions/ajax.js';
import { getInputValues, hideModal } from '../structure/functions/functions.js';
import { deleteLineOnDataTable } from '../structure/functions/datatable.js';
import { deletedSuccessSweetAlert, insertedSuccessSweetAlert, updatedSuccessSweetAlert } from '../structure/functions/sweetalert.js';


$(document).ready(function () {

    const SECTION  = 'check_list_atividade';
    const NAME_INPUTS = ['id_checklist', 'descricao'];

    $(function () {

        $(document).on('click', '#check_list_atividade', function(event){
            event.preventDefault();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'),
                atividades = [];

            for (let i = 1; i <= document.getElementsByName("descricao[]").length; i++) {
                atividades.push(document.getElementById(i).value);
            }

            console.log(document.getElementById('id_checklist'));

            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}`,
                type: 'POST',
                data: {_token: CSRF_TOKEN, id_checklist: document.getElementById('id_checklist').value, atividades: atividades},
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
                dataValues['atividade'] = oFormulario.getAttribute('atividade');

            console.log(this);

            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}`,
                type: 'PUT',
                data: {
                    _token: CSRF_TOKEN,
                    ...dataValues
                },
                success: function (response) {
                    updatedSuccessSweetAlert('Atualizado!', 'check_list_atividade');
                }
            }, {
                inputs: NAME_INPUTS
            });
        });

        $(document).on('click', '#button_delete', function(event){
            event.preventDefault();
            var id_atividade  = this.getAttribute('atividade'),
                id_checklist    = this.getAttribute('check_list'),
                CSRF_TOKEN    = $('meta[name="csrf-token"]').attr('content');

                console.log(id_atividade);
                console.log(id_checklist);
  
            ajaxRequest({
                url: '/api/check_list_atividade/'+id_checklist+'/'+id_atividade,
                type: 'DELETE',
                data: {
                    _token: CSRF_TOKEN
                },
                success: function (response) {
                    console.log(response);
                    deletedSuccessSweetAlert('Removido!', 'check_list_atividade');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        });
    });

});
