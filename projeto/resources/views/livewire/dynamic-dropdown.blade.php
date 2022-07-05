
    <div class="form-row">
        <div class="col-md-4 mb-3" >
            <label for="validationCustom05">Estado</label>
            <select wire:model="estado" class="custom-select" id="estado" name="estado" required>
            <option value="" selected>Selecione um Estado</option>
            @foreach ($this->estados as $estado) 
                <option value="{{ $estado->sigla }}">{{ $estado->nome }}</option>
            @endforeach
            </select>
            <div class="invalid-feedback">Exemplo de feedback invalido para o select</div>
        </div>

        <div class="col-md-5 mb-3">
            <label for="validationCustom06">Cidade</label>
                <select class="custom-select" id="municipio" name="municipio" required>
                <option value="" selected>Selecione um Município</option>
        
                @if($this->estado)
            
                @foreach ($cidades as $municipio) 
                    <option value="{{ $municipio->id }}">{{ $municipio->nome }}</option>
                @endforeach
                @endif
        
                </select>
                <div class="invalid-feedback">Exemplo de feedback invalido para o select</div>
        </div>

        <div class="col-md-3 mb-3">
            <label for="validationCustom05">CEP</label>
            <input type="text" class="form-control" id="validationCustom05" placeholder="CEP" required>
                <div class="invalid-feedback">
                    Por favor, informe um CEP válido.
                </div>
            </div>
  
    </div>


