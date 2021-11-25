$(document).ready(function () {
    let CEP = $("#ender_CEP");
    CEP.mask("99.999-999");

    $("#table-cursos").dataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        },
        "order": [[ 2, "desc" ]]
    });
});



function carregarCEP() {
    let CEP = $("#ender_CEP").val().replace(/[^\d]+/g, '')
    $.ajax({
        type: "GET",
        dataType: 'text',
        url: 'https://viacep.com.br/ws/' + CEP + '/json/',
        async: true,
        success: function (rs) {
            rs = JSON.parse(rs);
            $("#ender_cidade").val(rs['localidade']);
            $("#ender_UF").val(rs['uf']);


            $("#ender_logradouro").val(rs['logradouro']);
            $("#ender_complemento").val(rs['complemento']);
            $("#ender_bairro").val(rs['bairro']);
        },
        error: function (e) {
            bootbox.alert("<h2>Erro :(</h2><br/>Não foi possivel realizar essa operação.</br>");
        }
    });
}
