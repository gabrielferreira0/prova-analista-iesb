@extends('layouts.main')
@extends('layouts.navBar')

@section('content')
    <script>
        $(document).ready(function () {
            $('#Modal-aluno').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget) // Button that triggered the modal
                let recipient = button.data('titulo')
                let idaluno = button.data('idaluno')
                let nomealuno = button.data('nomealuno')
                let matriculaAluno = button.data('matriculaaluno')

                let cursoaluno = button.data('cursoaluno')
                let idcurso = button.data('idcurso')
                let CEPaluno = button.data('cepaluno')
                let cidadeAluno = button.data('cidadealuno')
                let UFaluno = button.data('ufaluno')
                let logradouroAluno = button.data('logradouroaluno')
                let complementoAluno = button.data('complementoaluno')
                let bairroAluno = button.data('bairroaluno')

                let curso = '<option selected="selected" value="' + idcurso + '">' + cursoaluno + '</option>';

                if(!cursoaluno) {
                    curso = '<option selected="selected" value="">Selecione</option>';
                }

                let modal = $(this)
                modal.find('#exampleModalLabel').text(recipient)
                modal.find('#idaluno').val(idaluno)
                modal.find('#aluno_nome').val(nomealuno)
                modal.find('#aluno_matricula').val(matriculaAluno)
                modal.find('#aluno_curso').prepend(curso)
                modal.find('#ender_CEP').val(CEPaluno)
                modal.find('#ender_cidade').val(cidadeAluno)

                modal.find('#ender_UF').val(UFaluno)
                modal.find('#ender_logradouro').val(logradouroAluno)
                modal.find('#ender_complemento').val(complementoAluno)
                modal.find('#ender_bairro').val(bairroAluno)

                // modal.find('.modal-body input').val(recipient)
            })
        });
    </script>

    <div id="cursos-container" class="container d-flex align-items-center justify-content-center">
        <div class="">

            @if (Session::get('mensagem'))
                <div class="alert alert-success text-center" style="font-size: 20px;">
                    <strong> {{ Session::get('mensagem')  }}</strong>
                    @php Session::forget('mensagem') @endphp
                </div>
            @endif

            @if (Session::get('erro'))
                <div class="alert alert-danger text-center" style="font-size: 20px;">
                    <strong> {{ Session::get('erro')  }}</strong>
                    @php Session::forget('erro') @endphp
                </div>
            @endif


            <div class="col-md-12">
                <div class="card card-Cursos d-flex justify-content-center">
                    <div class="card-header text-center">
                        <h3>Alunos Disponíveis <i class="fas fa-user-graduate fa-2x"></i></h3>
                    </div>

                    <div class="card-body text-center">

                        <table class="table-responsive table-striped " id="table-cursos">
                            <thead>
                            <tr>
                                <th scope="col">#Código</th>
                                <th scope="col">Aluno</th>
                                <th scope="col">Matricula</th>
                                <th scope="col">Curso</th>
                                <th scope="col">CEP</th>
                                <th scope="col">Cidade</th>
                                <th scope="col">UF</th>
                                <th scope="col">Logradouro</th>
                                <th scope="col">Complemento</th>
                                <th scope="col">Bairro</th>
                                <th scope="col">Excluir</th>
                                <th scope="col">editar</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse ($alunos as  $aluno)
                                <tr>
                                    <td>{{$aluno->aluno_id}} </td>
                                    <td class="text-nowrap">
                                        <i class="fas fa-user"></i>

                                        {{$aluno->aluno_nome}}
                                    </td>

                                    <td>{{$aluno->aluno_matricula}} </td>
                                    <td>{{$aluno->nome}}</td>
                                    <td>{{$aluno->ender_CEP}}</td>
                                    <td>{{$aluno->ender_cidade}} </td>
                                    <td>{{$aluno->ender_UF}}</td>
                                    <td>{{$aluno->ender_logradouro}}</td>
                                    <td>{{$aluno->ender_complemento}}</td>
                                    <td>{{$aluno->ender_bairro}}</td>


                                    @if ($aluno->aluno_ativo)
                                        <td><a title="Excluir" style="color:#1a202c;"
                                               href="/deleteAluno/{{$aluno->aluno_id}}">
                                                <i class="fas fa-trash-alt excluir"></i>
                                            </a>
                                        </td>
                                    @endif

                                    <td>
                                        <a data-toggle="modal" title="Editar" style="color:#1a202c;" href="#"
                                           data-titulo="Atualizar Aluno" data-target="#Modal-aluno"
                                           data-idaluno="{{$aluno->aluno_id}}" data-nomealuno="{{$aluno->aluno_nome}}"
                                           data-cursoaluno="{{$aluno->nome}}"  data-idcurso="{{$aluno->id}}"
                                           data-cepaluno="{{$aluno->ender_CEP}}" data-cidadealuno="{{$aluno->ender_cidade}}"
                                           data-ufaluno="{{$aluno->ender_UF}}"
                                           data-logradouroaluno="{{$aluno->ender_logradouro}}"
                                           data-complementoaluno="{{$aluno->ender_complemento}}"
                                           data-bairroaluno="{{$aluno->ender_bairro}}" data-matriculaaluno="{{$aluno->aluno_matricula}}"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12">Nenhum aluno Cadastrado</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>

                        <div align="end" style="margin: 1rem">
                            <button type="button" data-toggle="modal" data-target="#Modal-aluno"
                                    data-titulo="Adicionar novo Aluno" class="align-self-end btn btn-success">
                                Adicionar Aluno
                                <i class="fas fa-plus"></i>
                            </button>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>



    <div class="modal fade" id="Modal-aluno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" method="POST" action="/aluno">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="aluno_nome">Aluno:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                           id="aluno_nome" name="aluno_nome" placeholder="Usuario" required>
                                    <input type="hidden" name="idaluno" id="idaluno">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="aluno_matricula">Matricula:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="text"
                                           class="form-control" name="aluno_matricula" id="aluno_matricula"
                                           placeholder="9999999" required>
                                </div>

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="aluno_curso">Curso:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-graduation-cap"></i></span>
                                    </div>

                                    <select class="form-control" id="aluno_curso" name="aluno_curso" required>

                                        @foreach ($cursos as $curso)
                                            <option value="{{$curso['id']}}">{{$curso['nome']}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="aluno_matricula">CEP:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-home"></i></span>
                                    </div>
                                    <input onblur="carregarCEP()" type="text"
                                           class="form-control" name="ender_CEP" id="ender_CEP"
                                           placeholder="12.123-123" required>
                                </div>

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="ender_cidade">Cidade:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-home"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                           id="ender_cidade" name="ender_cidade" placeholder="Cidade" required>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="ender_UF">UF:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-home"></i></span>
                                    </div>
                                    <input type="text" class="form-control" maxlength="2"
                                           id="ender_UF" name="ender_UF" placeholder="UF" required>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="ender_logradouro">Logradouro:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-home"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                           id="ender_logradouro" name="ender_logradouro" placeholder="Logradouro"
                                           required>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="ender_complemento">Complemento:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-home"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                           id="ender_complemento" name="ender_complemento" placeholder="Complemento"
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label for="ender_bairro">Bairro:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-home"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                           id="ender_bairro" name="ender_bairro" placeholder="Bairro" required>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


