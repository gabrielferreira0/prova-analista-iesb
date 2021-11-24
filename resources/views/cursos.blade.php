@extends('layouts.main')

@section('title','Home')


@section('content')
    <div id="cursos-container" class="container d-flex align-items-center justify-content-center">
        <div class="">
            <div class="col-md-12">
                <div class="card card-Cursos d-flex justify-content-center">
                    <div class="card-header text-center">
                        <h3>Cursos Disponíveis <i class="fas fa-university"></i></h3>
                    </div>

                    <div class="card-body text-center">

                        <table class="table-responsive" id="table-cursos">
                            <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Nome do Curso</th>
                                <th scope="col">Excluir</th>
                                <th scope="col">editar</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse ($cursos as  $curso)

                                <tr>
                                    <td>{{$curso['id']}} </td>
                                    <td class="text-nowrap">{{$curso['nome']}} <i class="fas fa-graduation-cap"></i>
                                    </td>


                                    @if ($curso['ativo'])
                                        <td title="Excluir"><i class="fas fa-trash-alt excluir"></i></td>

                                    @else
                                        <td><i class="fas fa-check recuperar"></i></td>
                                    @endif

                                    <td title="Recuperar"><a title="Editar" style="color:#1a202c;" href="#"> <i class="fas fa-edit"></i> </a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Nenhum curso Disponível</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>

                        <div  align="end" style="margin: 1rem">
                            <button  type="button" class="align-self-end btn btn-success">
                                Adicionar Curso
                                <i class="fas fa-plus"></i>
                            </button>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
