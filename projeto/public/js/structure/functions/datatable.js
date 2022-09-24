import { URL_PATH_API } from '../consts/consts.js';

export function createDataTable(dataTableInfo) {

    let table = $(dataTableInfo.id).DataTable({
        processing: true,
        serverSide: false,
        ajax: `${URL_PATH_API}/${dataTableInfo.url.section}/datatable/0`,
        columns: setColumnsDatatable(dataTableInfo.columns),
        language: languageInfoDatatable(dataTableInfo.textLanguage)
    });

    return table;
}

export function deleteLineOnDataTable(idTabela, idRegistro) {
    return $(idTabela).DataTable().row(
        $(`a[data-id='${idRegistro}']`).parent().parent()
    ).remove().draw();
}

export function languageInfoDatatable(sTexto) {
    return {
        processing:     "Carregando...",
        search:         "Procurar&nbsp;:",
        lengthMenu:     "Mostrar _MENU_",
        info:           "Mostrando _START_ a _END_ de _TOTAL_ " + sTexto,
        infoEmpty:      "Mostrando 0 de 0 " +  sTexto + ".",
        infoFiltered:   "(_MAX_ " + sTexto + " no total)",
        infoPostFix:    "",
        //loadingRecords: "Carregando...",
        zeroRecords:    "Não há registros disponíveis.",
        emptyTable:     "Não há registros disponíveis.",
        paginate: {
            first:      "Primeiro",
            previous:   "Anterior",
            next:       "Próximo",
            last:       "Último"
        },
        aria: {
            sortAscending:  ": mostrando por ordem crescente em relação a coluna selecionada",
            sortDescending: ": mostrando por ordem decrescente em relação a coluna selecionada"
        }
    }
}

function setColumnsDatatable(columns) {
    let aColumns = [];

    columns.description.forEach((element) => {
        aColumns.push(element);
    });

    if (columns.action === true) {
        aColumns.push({data: 'action',   name: 'action', orderable: false, searchable: false});
    }

    return aColumns;
}
