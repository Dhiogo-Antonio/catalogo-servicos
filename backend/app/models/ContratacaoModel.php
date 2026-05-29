<?php

class ContratacaoModel {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function contratar($clienteId, $servicoId, $mensagem)
{
    $sql = "INSERT INTO contratacoes
    (
        cliente_id,
        servico_id,
        mensagem,
        status
    )
    VALUES (?, ?, ?, 'pendente')";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        $clienteId,
        $servicoId,
        $mensagem
    ]);
}


public function listarParaPrestador($prestadorId)
{
    $sql = "SELECT
            c.*,
            u.nome AS cliente,
            s.nome_servico

        FROM contratacoes c

        INNER JOIN usuarios u
        ON c.cliente_id = u.id

        INNER JOIN servicos s
        ON c.servico_id = s.id

        WHERE s.usuario_id = ?
        AND c.status NOT IN ('concluido', 'recusado')

        ORDER BY c.id DESC";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([$prestadorId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function atualizarStatus($id, $status)
{
    $sql = "UPDATE contratacoes
            SET status = ?
            WHERE id = ?";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        $status,
        $id
    ]);
}

public function atualizarMensagem($id, $mensagem)
{
    $sql = "
        UPDATE contratacoes
        SET mensagem = ?
        WHERE id = ?
    ";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        $mensagem,
        $id
    ]);
}

   public function listarPorCliente($clienteId) {

    $sql = "SELECT
                c.*,
                c.mensagem AS solicitacao,
                s.nome_servico,
                s.preco,
                u.nome AS prestador
            FROM contratacoes c
            INNER JOIN servicos s
                ON s.id = c.servico_id
            INNER JOIN usuarios u
                ON u.id = s.usuario_id
            WHERE c.cliente_id = ?
            ORDER BY c.id DESC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$clienteId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function contarPendentesPrestador($prestadorId)
{
    $sql = "SELECT COUNT(*) as total
            FROM contratacoes c

            INNER JOIN servicos s
            ON c.servico_id = s.id

            WHERE s.usuario_id = ?
            AND c.status = 'pendente'";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([$prestadorId]);

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

public function contarNotificacoesCliente($clienteId)
{
    $sql = "
        SELECT COUNT(*) as total
        FROM contratacoes
        WHERE cliente_id = ?
        AND (
            status = 'aceito'
            OR status = 'recusado'
            OR status = 'concluido'
        )
    ";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([$clienteId]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado['total'];
}

public function deletar($id)
{
    $sql = "DELETE FROM contratacoes WHERE id = ?";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([$id]);
}
}
?>