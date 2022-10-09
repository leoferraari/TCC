import { ID_FROM_URL_CRUD, URL_PATH_API } from '../structure/consts/consts.js';
import { ajaxRequest } from '../structure/functions/ajax.js';
import { getInputValues, hideModal } from '../structure/functions/functions.js';
import { deleteLineOnDataTable } from '../structure/functions/datatable.js';
import { deletedSuccessSweetAlert, insertedSuccessSweetAlert, updatedSuccessSweetAlert } from '../structure/functions/sweetalert.js';


$(document).ready(function () {

    const SECTION  = 'comodo';
    const NAME_INPUTS = ['id_projeto', 'nome', 'descricao'];

    

    $(function () {

        $(document).on('click', '#comodo', function(event){
            event.preventDefault();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var oForm = document.getElementById('formulario');
            let data = getInputValues(NAME_INPUTS);
  
            ajaxRequest({
                
                url: `${URL_PATH_API}/${SECTION}`,
                type: 'POST',
                data: {nome: data.nome, descricao: data.descricao, id_projeto: oForm.getAttribute('id_projeto')},
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
