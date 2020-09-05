@extends('layouts.app')
@section('content')

<div class="container">
     <div class="row">
          <div class="col-sm-4">
            <h3 style="font-family: Times New Roman">Editar usuario: {{ $user->name }}</h3>
            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                              </div>
                                @endif

             <form action="{{route('users.update', $user->id)}}" method="POST">
              @method('PATCH')
              @csrf
   <div class="form-group">
      <label for="name">Nombre</label>
    <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Escribe tu nombre">
  </div>

  <div class="form-group">
    <label for="cellphone">Celular</label>
  <input type="text" class="form-control" name="cellphone" value="{{ $user->cellphone }}" placeholder="Escribe tu celular">
</div>

  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control"  name="email" value="{{ $user->email }}" placeholder="Escribe tu email">
  </div>
  
  <button type="submit" class="btn btn-primary">Guardar cambios</button>
  <a class="btn btn-primary" href="/admin/users">Volver</a>
</form>




         </div>
    </div>
</div>                       
@endsection                                                