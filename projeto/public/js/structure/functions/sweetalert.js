export function deletedSuccessSweetAlert(sTexto, sRoute) {
    return Swal.fire({
        icon: 'success',
        title: sTexto,
        showConfirmButton: false,
        footer: '<button type="button" class="btn btn-dark"><a href="'+sRoute+'" style="color: white" >OK</a></button> '
    });
}

export function insertedSuccessSweetAlert(sTexto, sRoute) {
    return Swal.fire({
        icon: 'success',
        title: sTexto,
        showConfirmButton: false,
        footer: '<button type="button" class="btn btn-dark"><a href="'+sRoute+'" style="color: white" >OK</a></button> '
    });

}

export function errorAlert(sTexto) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: sTexto,
    })
}

export function loadingScreenSweetAlert(sTexto) {
    return Swal.fire({
        title: sTexto,
        showConfirmButton: false,
        allowOutsideClick: false,
        imageUrl: "https://media.tenor.com/images/47f855960d5dc83774d7b3b428964c93/tenor.gif",
    });
}

export function updatedSuccessSweetAlert(sTexto, sRoute) {
    return Swal.fire({
        icon: 'success',
        title: sTexto,
        showConfirmButton: false,
        footer: '<button type="button" class="btn btn-dark"><a href="'+sRoute+'" style="color: white" >OK</a></button> '
    });
}
