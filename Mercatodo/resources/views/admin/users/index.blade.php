@extends('layouts.app')
@section('content')


            <div class="container">
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 style="font-family: Times New Roman">Usuarios</h3>
                  </div>
                  <div class="panel-body">
                      <table class="table-latitude">
                           
                            <thead>
                              <th>Nombre</th>
                              <th>Rol</th>
                              <th>Celular</th>
                              <th>Email</th>
                              <th>Creado</th>
                              <th>Actualizado</th>
                              <th>Opciones</th>
                          </thead>
                          <tfoot>
                              <tr>
                                  <td colspan=3> <a href="/home"><button type="submit" name="button" class="btn btn-success">Volver</button> </a></td>
                              </tr>
                          </tfoot>
                          <tbody>

                            @if($users)
                              @foreach ($users as $user)

                              <tr>
                                  <th>{{$user->name}}</th>
                                  <td>{{$user->role->role}}</td>
                                  <td>{{$user->cellphone}}</td>
                                  <td>{{$user->email}}</td>
                                  <td>{{$user->created_at}}</td>
                                  <td>{{$user->updated_at}}</td>
                                  <td>
                                    <center>
                                    <a href="{{route('users.edit', $user->id)}}"> <i class="fas fa-user-edit"></i></a>

                                  </td>
                                  <td>
                                    
                                    @if(!$user->trashed())
                                    <form action="{{route('users.destroy', $user->id)}}" method="POST">
                                      @method('DELETE')
                                      @csrf
                                    <button type="submit" class="btn btn-default ml-2">Inhabilitar</button>
                                  </form>
                                  @endif
                    
                                  @if($user->trashed())
                                  <form action="{{route('users.restore', $user->id)}}" method="GET">
                                    @method('GET')
                                    @csrf
                                  <button type="submit" class="btn btn-default ml-2">Habilitar</td>
                                  @endif
                                  </td>
                              </tr>
                              
                              @endforeach
                            @endif
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>

@endsection