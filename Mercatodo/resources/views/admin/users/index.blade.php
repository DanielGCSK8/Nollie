@extends('layouts.app')
@section('content')


        <div class="col">
            <h3 style="font-family: Times New Roman">Usuarios</h3>
        </div>

        <br>

          <div class="row">
                <div class="col">
                <table class="table">
            
              <tr>
                  <th>Nombre</th>
                  <th>Rol</th>
                  <th>Celular</th>
                  <th>Email</th>
                  <th>Creado</th>
                  <th>Actualizado</th>
                  <th>Opciones</th>
              </tr>
            @if($users)
                @foreach ($users as $user)
                    
                
              <tr>
              <td>{{$user->name}}</td>
              <td>{{$user->role->role}}</td>
              <td>{{$user->cellphone}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->created_at}}</td>
              <td>{{$user->updated_at}}</td>
              <td>
                <a href="{{route('users.edit', $user->id)}}"> <button type="button" class="btn btn-primary">Editar</button>  </a>
              </td>
            
              <td>
                @if(!$user->trashed())
                <form action="{{route('users.destroy', $user->id)}}" method="POST">
                  @method('DELETE')
                  @csrf
                <button type="submit" class="btn btn-primary">Inhabilitar</button>
              </form>
              @endif

              @if($user->trashed())
              <form action="{{route('users.restore', $user->id)}}" method="POST">
                @method('PUT')
                @csrf
              <input type="submit" class="btn btn-default" value="Habilitar"/></td>
              @endif

              </tr>
              @endforeach
            @endif
              

            </table>
            <div class="col-md-12">
              <div class="form-group">
                  <a href="/home"><button type="submit" name="button" class="btn btn-success">Volver</button> </a>
              </div>
          </div>
                </div>
            </div>

                        



@endsection