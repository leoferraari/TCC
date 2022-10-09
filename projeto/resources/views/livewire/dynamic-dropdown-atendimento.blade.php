
<div class="form-row">
        <div class="col-md-12 mb-3" >
            <label for="validationCustom12">Estado</label>
            <select wire:model="estado" class="custom-select" id="estado" name="estado" required>
            <option value="" selected>Selecione um Estado</option>
            @foreach ($this->estados as $estado) 
                <option value="{{ $estado->sigla }}">{{ $estado->nome }}</option>
            @endforeach
            </select>
            <div class="invalid-feedback">Exemplo de feedback invalido para o select</div>
        </div>

                    @if($this->estado)
                        <div class="col-md-3 mb-3" >
                            <label for = "todos"> Selecionar Todos </label>
                            <input  type="checkbox" id ="selecionar_todos" onclick="selecionarTodos()" name ="todos">
                        </div>
              
                        @foreach ($cidades as $municipio) 
                            <div class="col-md-3 mb-3" >
                                <label for = "{{ $municipio->id }}"> {{ $municipio->nome }} </label>
                                <input  type="checkbox" id ="{{ $municipio->id }}" value ="{{ $municipio->id }}" name= "municipios[]">
                            </div>
                        @endforeach
                    @endif
            
 
         
     </div>



