
const OPERACAO_MAIOR = '>';
const OPERACAO_MENOR = '<';
const OPERACAO_IGUAL = '=';
const OPERACAO_MAIOR_IGUAL = '=';
const OPERACAO_MENOR_IGUAL = '=';


export class Input {
    constructor(objectJquery, required = true, minLength = null, maxLength = null) {
        this.setObject(objectJquery);
        this.required  = true;
        this.minLength = minLength;
        this.maxLength = maxLength;
    }

    setObject(objectJquery) {
        this.type         = $(objectJquery).attr('type');
        this.value        = $(objectJquery).val();
        //this.required     = $(objectJquery).data('required');
        this.objectJquery = objectJquery;
    }

    checkIfItsRequired() {
        if (this.required == true) {
            return true;
        } else {
            return false;
        }
    }

    checkLength() {
        let min;
        let max;

        if (this.minLength == null) {
            min = true;
        } else {
            if (this.value.length >= this.minLength) {
                min = true;
            } else {
                min = false;
            }
        }

        if (this.maxLength == null) {
            max = true;
        } else {
            if (this.value.length <= this.maxLength) {
                max = true;
            } else {
                max = false;
            }
        }

        if (min == true && max == true) {
            return true;
        } else {
            return false;
        }
    }

    matchTextNoSpecials(pValue = null) {
        let letters = /^[A-Za-z0-9\s]+$/;
        let sValue  = pValue === null ? sValue = this.value : sValue = pValue;

        if (sValue.match(letters)) {
            return true;
        } else {
            return false;
        }
    }

    matchOnlyCharacters(pSpace = null, pValue = null) {
        let letters = pSpace === null ? /^[A-Za-z]+$/ : /^[A-Za-z\s]+$/;
        let sValue  = pValue === null ? sValue = this.value : sValue = pValue;

        if (sValue.match(letters)) {
            return true;
        } else {
            return false;
        }
    }

    matchOnlyNumbers(pSpace = null, pValue = null) {
        let numbers = pSpace === null ? /^[0-9]+$/ : /^[0-9\s]+$/;
        let sValue  = pValue === null ? sValue = this.value : sValue = pValue;

        if (sValue.match(numbers)) {
            return true;
        } else {
            return false;
        }
    }

    setValue(sTexto) {
        $(this.objectJquery).val(this.value);
        this.setObject($(this.objectJquery))
    }

    validateInput(businessRule) {
        if (businessRule() && this.checkLength()) {
            this.addClassValid(this.objectJquery);
        } else {
            this.addClassInvalid(this.objectJquery);
        }
        this.setObject($(this.objectJquery))
    }


    addClassInvalid() {
        let required = this.checkIfItsRequired();

        if (required || (!required && !this.checkLength())) {
            $(this.objectJquery).removeClass('is-valid');
            $(this.objectJquery).addClass('is-invalid');
        } else {
            $(this.objectJquery).removeClass('is-valid');
            $(this.objectJquery).removeClass('is-invalid');
        }
    }

    addClassValid() {
        $(this.objectJquery).removeClass('is-invalid');
        $(this.objectJquery).addClass('is-valid');
    }





}
