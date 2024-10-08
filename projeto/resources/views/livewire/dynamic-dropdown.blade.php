
    <div class="form-row">
        <div class="col-md-6 mb-3" >
            <label for="validationCustom12">Estado</label>
            <select wire:model="estado" class="custom-select" id="estado" name="estado" required>
            <option value="" selected>Selecione um Estado</option>
            @foreach ($this->estados as $estado) 
                <option value="{{ $estado->sigla }}">{{ $estado->nome }}</option>
            @endforeach
            </select>
            <div class="invalid-feedback">Exemplo de feedback invalido para o select</div>
        </div>

        <div class="col-md-6 mb-3">
            <label for="validationCustom13">Cidade</label>
                <select class="custom-select" onchange="onChangeMunicipio()" id="municipio" name="municipio" required>
                <option value="" selected>Selecione um Município</option>
        
                @if($this->estado)
            
                @foreach ($cidades as $municipio) 
                    <option value="{{ $municipio->id }}">{{ $municipio->nome }}</option>
                @endforeach
                @endif
        
                </select>
                <div class="invalid-feedback">Exemplo de feedback invalido para o select</div>
        </div>
    </div>


