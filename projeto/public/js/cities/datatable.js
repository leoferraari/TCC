import { ID_FROM_URL_CRUD, URL_PATH_API } from '../structure/consts/consts.js';
import { ajaxRequest } from '../structure/functions/ajax.js';
import { getInputValues, hideModal } from '../structure/functions/functions.js';
import { deleteLineOnDataTable } from '../structure/functions/datatable.js';


$(document).ready(function () {

    const SECTION  = 'cities';

    $(function () {

        console.log(`${URL_PATH_API}/${SECTION}`)
        ajaxRequest({
            url: `${URL_PATH_API}/${SECTION}`,
            type: 'GET',
            data: {},
            success: function (response) {
                console.log(response)
                for (let x = 0; x < response.data.length; x++) {
                    let city = response.data[x];
                    $("#data-table tbody").append(`
                        <tr id="linha${city.id}">
                            <td>${city.id}</td>
                            <td>${city.name}</td>
                            <td>${city.state_initials}</td>
                            <td>

                                <a href="/cities/${city.id}/edit" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="#modalDelete" data-id="${city.id}"
                                        class="btn btn-danger button-delete-on-table" data-toggle="modal" data-target="#modalDelete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>

                                <a href="/cities/${city.id}/show" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    `);
                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr)

            }
        });
    });
});
