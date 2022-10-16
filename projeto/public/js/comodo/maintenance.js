import { ID_FROM_URL_CRUD, URL_PATH_API } from '../structure/consts/consts.js';
import { ajaxRequest } from '../structure/functions/ajax.js';
import { getInputValues, hideModal } from '../structure/functions/functions.js';
import { deleteLineOnDataTable } from '../structure/functions/datatable.js';
import { deletedSuccessSweetAlert, insertedSuccessSweetAlert, updatedSuccessSweetAlert, errorAlert } from '../structure/functions/sweetalert.js';


$(document).ready(function () {

    const SECTION  = 'comodo';
    const NAME_INPUTS = ['id_projeto', 'nome', 'descricao'];

    function camposValidos() {
        let aCampos = ['Projeto', 'Nome', 'Descrição'];
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

        $(document).on('click', '#comodo', function(event){
            event.preventDefault();
            var oForm = document.getElementById('formulario');
            let data = getInputValues(NAME_INPUTS);
            if (camposValidos()) {
                ajaxRequest({
                    url: `${URL_PATH_API}/${SECTION}`,
                    type: 'POST',
                    data: {nome: data.nome, descricao: data.descricao, id_projeto: oForm.getAttribute('id_projeto')},
                    success: function (response) {
                        console.log(response);
                        insertedSuccessSweetAlert(response.message, 'http://localhost:8000/comodos/'+ oForm.getAttribute('id_projeto'));
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
                dataValues['id'] = oFormulario.getAttribute('id_comodo');

            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}`,
                type: 'PUT',
                data: {
                    ...dataValues
                },
                success: function (response) {
                    updatedSuccessSweetAlert('Atualizado!', 'http://localhost:8000/comodos/'+ oFormulario.getAttribute('id_projeto'));
                }
            });
        });

        
        $(document).on('click', '#button_delete', function(event){
            event.preventDefault();
            var id_comodo  = this.getAttribute('id_comodo'),
                id_projeto    = this.getAttribute('id_projeto');
     
            ajaxRequest({
                url: '/api/comodo/'+id_comodo+'/'+id_projeto,
                type: 'DELETE',
                success: function (response) {
                    console.log(response);
                    deletedSuccessSweetAlert('Removido!', 'http://localhost:8000/comodos/'+id_projeto);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        });
    });
});
