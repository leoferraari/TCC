import { ID_FROM_URL_CRUD, URL_PATH_API } from '../structure/consts/consts.js';
import { ajaxRequest } from '../structure/functions/ajax.js';
import { getInputValues, hideModal } from '../structure/functions/functions.js';
import { deleteLineOnDataTable } from '../structure/functions/datatable.js';
import { deletedSuccessSweetAlert, insertedSuccessSweetAlert, updatedSuccessSweetAlert, errorAlert } from '../structure/functions/sweetalert.js';


$(document).ready(function () {

    const SECTION  = 'arquivo_projeto';
    const NAME_INPUTS = ['id_projeto', 'endereco_url', 'descricao'];

    function camposValidos() {
        let aCampos = ['Projeto', 'Endereço', 'Descrição'];
        let data = getInputValues(NAME_INPUTS);

        for (let index = 0; index < NAME_INPUTS.length; index++) {
            if (data[NAME_INPUTS[index]] == '') {
                errorAlert('O campo '+ aCampos[index]+' deve ser preenchido!');
                return false;
            }
        }
        return true;
    }

    $(function () {

        $(document).on('click', '#arquivo_projeto', function(event){
            event.preventDefault();
            var oForm = document.getElementById('formulario');
            let data = getInputValues(NAME_INPUTS);
            if (camposValidos()) {
                ajaxRequest({
                    url: `${URL_PATH_API}/${SECTION}`,
                    type: 'POST',
                    data: {endereco_url: data.endereco_url, descricao: data.descricao, id_projeto: oForm.getAttribute('id_projeto')},
                    success: function (response) {
                        insertedSuccessSweetAlert(response.message, 'http://localhost:8000/arquivo_projeto/'+ oForm.getAttribute('id_projeto'));
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                    }
                }, {
                    inputs: NAME_INPUTS
                });
            }
        });

        $(document).on('click', '#button_update', function(event){
            event.preventDefault();
            var oFormulario = document.getElementById('formulario'),
                dataValues = getInputValues(NAME_INPUTS);
                dataValues['id_projeto'] = oFormulario.getAttribute('id_projeto');
                dataValues['id'] = oFormulario.getAttribute('id_arquivo');

            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}`,
                type: 'PUT',
                data: {
                    ...dataValues
                },
                success: function (response) {
                    updatedSuccessSweetAlert(response.message, 'http://localhost:8000/arquivo_projeto/'+oFormulario.getAttribute('id_projeto'));
                }
            });
        });

        
        $(document).on('click', '#button_delete', function(event){
            event.preventDefault();
            var id_arquivo  = this.getAttribute('id_arquivo'),
                id_projeto    = this.getAttribute('id_projeto');
     
            ajaxRequest({
                url: '/api/arquivo_projeto/'+id_arquivo+'/'+id_projeto,
                type: 'DELETE',
                success: function (response) {
                    console.log(response);
                    deletedSuccessSweetAlert(response.message, 'http://localhost:8000/arquivo_projeto/'+id_projeto);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        });
    });
});
