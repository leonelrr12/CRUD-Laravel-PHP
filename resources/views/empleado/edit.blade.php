@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar información de empleados</h1>
    <div class="container">
    <form action="{{ url('/empleado/'.$empleado->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      {{ method_field('PATCH') }}
      @include('empleado.form', ['modo'=>'Actualizar']);
    </form>
</div>
@endsection