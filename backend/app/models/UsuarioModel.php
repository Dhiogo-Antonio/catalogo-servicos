<?php
class UsuarioModel {
    private $pdo;
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function buscarTodos(){
        $stmt = $this->pdo->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function buscarUsuario($id){
        $stmt = $this->pdo->query("SELECT * FROM usuarios WHERE id = $id");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $email, $senha, $telefone, $tipo, $criado_em) {
        $sql = "INSERT INTO usuarios (nome, email, senha, telefone, tipo, criado_em) VALUES (:nome, :email, :senha, :telefone, :tipo, :criado_em)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha,
            ':telefone' => $telefone,
            ':tipo' => $tipo,
            ':criado_em' => $criado_em
        ]);
    }
    public function editar($nome, $email, $senha, $telefone, $tipo, $criado_em, $id) {
        $sql = "UPDATE usuarios SET nome=?, email=?, senha=?, telefone=?, tipo=?, criado_em=? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $senha, $telefone, $id]);
    }

    public function deletar($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    
}