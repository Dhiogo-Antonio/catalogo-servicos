<?php

class ServicoModel {

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    
    public function listar(){

    $sql = "SELECT 
                s.*,
                u.nome AS prestador,
                u.foto,
                c.nome AS categoria
            FROM servicos s
            INNER JOIN usuarios u ON u.id = s.usuario_id
            INNER JOIN categorias c ON c.id = s.categoria_id
            ORDER BY s.id DESC";

    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

    public function listarPorPrestador($usuarioId){

        $sql = "SELECT 
                    s.*,
                    c.nome AS categoria
                FROM servicos s
                INNER JOIN categorias c ON c.id = s.categoria_id
                WHERE s.usuario_id = ?
                ORDER BY s.id DESC";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$usuarioId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarFiltrados($q = null, $categoriaId = null)
{
    $sql = "SELECT 
                s.*,
                u.nome AS prestador,
                u.foto,
                c.nome AS categoria_nome
            FROM servicos s
            JOIN usuarios u ON u.id = s.usuario_id
            JOIN categorias c ON c.id = s.categoria_id
            WHERE 1=1";
    $params = [];

    if (!empty($q)) {
        $sql .= " AND (s.nome_servico LIKE ? OR s.descricao LIKE ?)";
        $params[] = "%$q%";
        $params[] = "%$q%";
    }

    if (!empty($categoriaId)) {
        $sql .= " AND s.categoria_id = ?";
        $params[] = $categoriaId;
    }

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    
    public function listarPorCategoria($categoriaId){

        $sql = "SELECT 
                    s.*,
                    u.nome AS prestador,
                    c.nome AS categoria
                FROM servicos s
                INNER JOIN usuarios u ON u.id = s.usuario_id
                INNER JOIN categorias c ON c.id = s.categoria_id
                WHERE s.categoria_id = ?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$categoriaId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

 
   public function buscarPorId($id) {

    $sql = "SELECT
    servicos.*,
    usuarios.nome AS prestador,
    usuarios.foto,
    usuarios.email
FROM servicos
INNER JOIN usuarios
ON servicos.usuario_id = usuarios.id
WHERE servicos.id = ?";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    
    public function criar(
    $usuarioId,
    $categoriaId,
    $nomeServico,
    $descricao,
    $preco,
    $prazo,
    $localizacao
){

    $sql = "INSERT INTO servicos 
    (
        usuario_id,
        categoria_id,
        nome_servico,
        descricao,
        preco,
        prazo,
        localizacao
    )
    VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        $usuarioId,
        $categoriaId,
        $nomeServico,
        $descricao,
        $preco,
        $prazo,
        $localizacao
    ]);
}

    
    public function editar(
    $id,
    $nome_servico,
    $descricao,
    $preco,
    $prazo,
    $categoria_id
){

    $sql = "UPDATE servicos
            SET 
                categoria_id = ?,
                nome_servico = ?,
                descricao = ?,
                preco = ?,
                prazo = ?
            WHERE id = ?";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        $categoria_id,
        $nome_servico,
        $descricao,
        $preco,
        $prazo,
        $id
    ]);
}

    public function deletar($id){

        $sql = "DELETE FROM servicos WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$id]);
    }


    public function deletarServico($id, $usuarioId)
{
    $stmt = $this->pdo->prepare("
        DELETE FROM servicos
        WHERE id = ?
        AND usuario_id = ?
    ");

    return $stmt->execute([
        $id,
        $usuarioId
    ]);
}
    

}