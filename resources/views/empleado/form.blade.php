@if(count($errors)>0)
  <div class="alert alert-danger" role="alert">
    <ul>
      @foreach($errors->all() as $error)
        <li><strong>{{ $error }}</strong></li>
      @endforeach
    </ul>
  </div>
@endif

<div class="mb-3">
  <label for="nombre" class="form-label">Nombre:</label>
  <input 
    type="text" 
    name="nombre" 
    id="" 
    class="form-control" 
    value="{{ isset($empleado->nombre)?$empleado->nombre:old('nombre') }}"
  />
</div>
<div class="mb-3">
  <label for="apellidoPaterno" class="form-label">Apellido Paterno:</label>
  <input type="text" name="apellido_paterno" id="" class="form-control" 
    value="{{ isset($empleado->apellido_paterno)?$empleado->apellido_paterno:old('nombre')}}">
</div>
<div class="mb-3">
  <label for="apellidoMaterno" class="form-label">Apellido Materno:</label>
  <input type="text" name="apellido_materno" id="" class="form-control" 
  value="{{ isset($empleado->apellido_materno)?$empleado->apellido_materno:old('nombre') }}">
</div>
<div class="mb-3">
  <label for="" class="form-label">Email</label>
  <input 
    type="email" 
    class="form-control" 
    name="email" 
    id="" 
    value="{{ isset($empleado->email)?$empleado->email:old('nombre') }}"
    />
</div>
<div class="mb-3">
  @if( isset($empleado->foto))
    <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->foto }}" width="100" alt="">
  @endif
  <input type="file" name="foto" id="" class="form-control" value="{{ isset($empleado->foto)?$empleado->foto:"" }}">
</div>

<input name="" id="" class="btn btn-success" type="submit" value="{{ $modo }}">
<a name="" id="" class="btn btn-primary my-4" href="{{ url('/empleado') }}" role="button">Regresar</a>
</div>