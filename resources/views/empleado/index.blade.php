@extends('layouts.app')
@section('content')
<div class="container">

      @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          <strong>{{ Session::get('mensaje') }}</strong>
        </div>
      @endif

      <a name="" id="" class="btn btn-success mb-4" href="{{ url('/empleado/create') }}" role="button">Nuevo empleado</a>
      <div class="table-responsive">
        <table class="table table-primary">
          <thead>
            <tr>
              <th>#</th>
              <th>Foto</th>
              <th>Nombre</th>
              <th>Apellido Paterno</th>
              <th>Apellido Materno</th>
              <th>Email</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($empleados as $empleado)
            <tr class="">
              <td>{{ $empleado->id }}</td>
              <td>
                <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->foto }}" width="100" alt="" />
              </td>
              <td>{{ $empleado->nombre }}</td>
              <td>{{ $empleado->apellido_paterno }}</td>
              <td>{{ $empleado->apellido_materno }}</td>
              <td>{{ $empleado->email }}</td>
              <td>
         
                <a name="" id="" class="btn btn-info" href="{{ url('empleado/'.$empleado->id.'/edit') }}" role="button">Editar</a>
                <form class="d-inline" action="{{ url('/empleado/'.$empleado->id) }}" method="post">
                  @csrf
                  {{ method_field('DELETE') }}
                  <input type="submit" onclick="return confirm('Confirmar borrado?')" class="btn btn-danger" value="Borrar">
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $empleados->links() !!}
      </div>
</div>
@endsection