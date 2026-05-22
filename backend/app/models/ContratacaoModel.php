<?php

class ContratacaoModel {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function contratar($clienteId, $servicoId, $mensagem) {

        $sql = "INSERT INTO contratacoes (
            cliente_id,
            servico_id,
            mensagem
        ) VALUES (?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $clienteId,
            $servicoId,
            $mensagem
        ]);
    }

    public function listarPorCliente($clienteId) {

        $sql = "SELECT
                    c.*,
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
}
?>