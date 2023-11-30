@extends('layouts.app')


@push('breadcrumb')

    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('users')}}">Listagem de categorias</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                @if(isset($id))
                    Edicao
                @else
                    Nova categoria
                @endif
            </li>
        </ol>
    </nav>
@endpush


@section('content')

    @if(isset($message))
        <div class="p-2">
            <div class="alert alert-{{$message['type']}}">
                {{$message['message']}}
            </div>
        </div>
    @endif

    <div class="card col-8 mt-3 m-auto">
        <h5 class="card-header py-4">
            @if(isset($id))
                Edicao de categoria
            @else
                Cadastro de categoria
            @endif
        </h5>
        <div class="card-body">
            <form id="frm-create" method="POST" action="{{$action}}">
                @csrf

                @if(isset($id))
                    @method('PUT')
                @endif


                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input name="name" type="text" id="name" class="form-control  @if($errors->has('name')) is-invalid @endif" placeholder="Nome do usuario" value="{{ old('name', isset($item) ? $item['name'] : '') }}">
                        @if($errors->has('name'))
                            <div  class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input name="email" type="email" id="email" class="form-control  @if($errors->has('email')) is-invalid @endif" placeholder="E-mail" value="{{ old('email', isset($item) ? $item['email'] : '') }}">
                        @if($errors->has('email'))
                            <div  class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input name="password" type="password" id="password" class="form-control  @if($errors->has('password')) is-invalid @endif" placeholder="Senha" value="{{ old('password', isset($item) ? $item['password'] : '') }}">
                        @if($errors->has('password'))
                            <div  class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        <label for="category_id"  class="form-label">Roles</label>

                        @if(isset($roles) && count($roles) )
                            <div class="d-flex flex-column gap-2">
                                @foreach($roles as $role)
                                    <div class="form-check">
                                        <input {{$role->checked ? 'checked' : '' }} name="roles[]" class="form-check-input" type="checkbox" value="{{$role->id}}" id="{{$role->id}}">
                                        <label class="form-check-label" for="{{$role->id}}">
                                            {{$role->role}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        @endif

                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
