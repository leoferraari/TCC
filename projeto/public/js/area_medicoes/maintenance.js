import { ID_FROM_URL_CRUD, URL_PATH_API } from '../structure/consts/consts.js';
import { ajaxRequest } from '../structure/functions/ajax.js';
import { getInputValues, hideModal } from '../structure/functions/functions.js';
import { deleteLineOnDataTable } from '../structure/functions/datatable.js';
import { deletedSuccessSweetAlert, insertedSuccessSweetAlert, updatedSuccessSweetAlert, errorAlert } from '../structure/functions/sweetalert.js';


$(document).ready(function () {

    const SECTION  = 'area_medicoes';
    const NAME_INPUTS = ['id_projeto', 'id_comodo', 'descricao_medida'];

    function camposValidos() {
        let aCampos = ['Projeto', 'Cômodo', 'Descrição'];
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

        $(document).on('click', '#area_medicao', function(event){
            event.preventDefault();
            var oForm = document.getElementById('formulario');
            let data = getInputValues(NAME_INPUTS);
            if (camposValidos()) {
                ajaxRequest({
                    url: `${URL_PATH_API}/${SECTION}`,
                    type: 'POST',
                    data: {id_comodo: data.id_comodo, id_projeto: data.id_projeto, descricao_medida: data.descricao_medida,},
                    success: function (response) {
                        insertedSuccessSweetAlert(response.message, 'http://localhost:8000/area_medicoes/'+ data.id_projeto+'/'+data.id_comodo);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                    }
                }, {
                    inputs: NAME_INPUTS
                });
            }
        });

        $(document).on('click', '#update_area_medicao', function(event){
            event.preventDefault();
            var oForm = document.getElementById('formulario'),
                dataValues = getInputValues(NAME_INPUTS);

            dataValues['id_medida'] = oForm.getAttribute('id_medida');
            ajaxRequest({
                url: `${URL_PATH_API}/${SECTION}`,
                type: 'PUT',
                data: {
                    ...dataValues
                },
                success: function (response) {
                    console.log(response);
                    insertedSuccessSweetAlert(response.message, 'http://localhost:8000/area_medicoes/'+ dataValues['id_projeto']+'/'+dataValues['id_comodo']);
                }
            });
        });

        
        $(document).on('click', '#button_delete', function(event){
            event.preventDefault();
            var id_comodo  = this.getAttribute('id_comodo'),
                id_projeto = this.getAttribute('id_projeto'),
                id_medida = this.getAttribute('id_medida');
     
            ajaxRequest({
                url: '/api/area_medicoes/'+id_projeto+'/'+id_comodo+'/'+id_medida,
                type: 'DELETE',
                success: function (response) {
                    console.log(response);
                    deletedSuccessSweetAlert('Área removida!', 'http://localhost:8000/area_medicoes/'+id_projeto+'/'+id_comodo);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        });
    });
});
