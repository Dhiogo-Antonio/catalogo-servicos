function abrirModal(
    id,
    nome,
    descricao,
    preco,
    prazo,
    localizacao,
    categoria
){

    document.getElementById('edit-id').value = id;

    document.getElementById('edit-nome').value = nome;

    document.getElementById('edit-descricao').value = descricao;

    document.getElementById('edit-preco').value = preco;

    document.getElementById('edit-prazo').value = prazo;

    document.getElementById('edit-localizacao').value = localizacao;

    document.getElementById('edit-categoria').value = categoria;

    document.getElementById('modalEditar').style.display = 'flex';
}

function fecharModal(){

    document.getElementById('modalEditar').style.display = 'none';
}