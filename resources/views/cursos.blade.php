@extends('layouts.main')
@extends('layouts.navBar')

@section('content')
    <script>
        $(document).ready(function () {
            $('#Modal-cursos').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('titulo') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('#exampleModalLabel').text(recipient)
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
                                        <td><a title="Excluir" style="color:#1a202c;" href="/deleteCurso/{{$curso['id']}}">
                                                <i class="fas fa-trash-alt excluir"></i>
                                            </a>
                                        </td>
                                    @endif

                                    <td><a data-toggle="modal"  data-id={{$curso['id']}} data-target="#Modal-cursos"
                                           data-titulo="Atualizar Curso" title="Editar" style="color:#1a202c;" href="#">
                                            <i class="fas fa-edit"></i>
                                        </a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Nenhum curso Disponível</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>

                        <div  align="end" style="margin: 1rem">
                            <button  type="button"  data-toggle="modal" data-target="#Modal-cursos"
                                     data-titulo="Adicionar novo Curso" class="align-self-end btn btn-success">
                                Adicionar Curso
                                <i class="fas fa-plus"></i>
                            </button>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>



    <div class="modal fade" id="Modal-cursos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" method="POST" action="/curso">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nome do curso:</label>
                            <input type="text" class="form-control" name="nomeCurso" id="nomeCurso">
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

@endsection


