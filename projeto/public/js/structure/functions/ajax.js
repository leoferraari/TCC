import { loadingScreenSweetAlert } from './sweetalert.js';
import { DATA_INVALID_FROM_VALIDATION } from '../consts/consts.js';
import { resetInputs  } from './functions.js';


export function ajaxRequest(ajax, options = null) {
    let tSwal;

    $.ajax({
  
        url: ajax.url,
        type: ajax.type,
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': "Bearer "+$('#jwttoken').val()
        },
        data: ajax.data,
        beforeSend: function() {
            tSwal = loadingScreenSweetAlert('Carregando!');
        },
        complete: function() {
            tSwal.close();
        },
        success: function (success) {
            ajax.success(success);
        },
        error: function (xhr, ajaxOptions, thrownError) {

            console.log('Houve um erro no seu Ajax!')
            console.log(xhr.responseJSON)
            if (typeof xhr.responseJSON.message !== 'undefined') {
                if (xhr.responseJSON.message == DATA_INVALID_FROM_VALIDATION) {
                    if (typeof options !== 'undefined') {
                        if (typeof options.inputs !== 'undefined') {
                            dataInvalidFromValidation(xhr.responseJSON.errors, options.inputs);
                        } else {
                            dataInvalidFromValidation(xhr.responseJSON.errors);
                        }
                    }
                }
            }
            if (typeof ajax.error !== 'undefined') {
                ajax.error(xhr.responseJSON, ajaxOptions, thrownError);
            }

            Swal.fire('Ops...', xhr.responseJSON.message, 'error');
        }
    });
}


function dataInvalidFromValidation(jsonErrors, inputs = null) {
    if (inputs === null){
        for (let error in jsonErrors) {
            for (let x = 0; x < jsonErrors[error].length; x++) {
                $('#'+error+'-feedback').text(jsonErrors[error][x]);
                $('#'+error).removeClass('is-valid');
                $('#'+error).addClass('is-invalid');
                $('#modalUpdate').modal('hide');
            }
        }
    } else {
        for (let i = 0; i < inputs.length; i++) {
            let error = inputs[i];
            if (inputs[i] in jsonErrors) {
                $('#'+error+'-feedback').text(jsonErrors[error][0]);
                $('#'+error).removeClass('is-valid');
                $('#'+error).addClass('is-invalid');
            } else {
                $('#'+error+'-feedback').text('');
                $('#'+error).removeClass('is-invalid');
                $('#'+error).addClass('is-valid');
            }
        }
    }
}




