<?php

if (empty($servicos)) {
    echo "<p>Nenhum serviço encotrado!</p>";
    echo "<a href= 'view/Servicos/cadastrar.php'>Cadastrar</a>";
    return;
}



echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><td><a href=view/Servicos/cadastrar.php>Cadastrar</a></td></tr>";
echo "<tr><th>ID</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Categoria</th><th>Prazo</th><th>Disponibilidade</th><th>Avaliação</th><th>Localização</th><th>Ações</th></tr>";

foreach ($servicos as $servico) {
    $id = $servico['id'];
    echo "<tr>";
    echo "<td>{$id}</td>";
    echo "<td>{$servico['nome']}</td>";
    echo "<td>{$servico['descricao']}</td>";
    echo "<td>{$servico['preco']}</td>";
    echo "<td>{$servico['categoria']}</td>";
    echo "<td>{$servico['prazo']}</td>";
    echo "<td>" . ($servico['disponibilidade'] ? 'Sim' : 'Não') . "</td>";
    echo "<td>{$servico['avaliacao']}</td>";
    echo "<td>{$servico['localizacao']}</td>";
    echo "<td>
                <a href='view/Servicos/editar.php?id={$id}'>Editar</a> |
                <a href='view/Servicos/deletar.php?id={$id}' onclick=\"return confirm('Tem certeza que deseja excluir este serviço?')\">Deletar</a>
            </td>";
    echo "</tr>";
}
echo "</table>";
?>