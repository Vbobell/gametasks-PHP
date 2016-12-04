<?php 
require_once("quadroTarefasAdm.php");
require_once("../regraNegocio/usuarioExperiencia.php");

$modo = $_POST['modo'];
$tabelaEdicao = $_POST['tabela'];

if($modo == 'buscaDados'){

$editar = $_POST['busca'];

switch($tabelaEdicao){

case "usuario":
    $edicao = new Usuario();
    $converteJson = array();
    $converteJson = $edicao->getDadosUsuario($editar);
    $data = array(
        'nome' => $converteJson[1],
        'email' => $converteJson[2],
        'cpf' => $converteJson[4],
        'funcao' => $converteJson[5],
        'personagem' => $converteJson[6]
     );
    echo json_encode($data);
break;
case "tarefa":
    $edicao = new Tarefa();
    $converteJson = array();
    $converteJson = $edicao->getDadosTarefa($editar);
    $data = array(
        'mestre' => $converteJson[1],
        'titulo' => $converteJson[2],
        'descricao' => $converteJson[3],
        'status' => $converteJson[4],
        'valorXP' => $converteJson[5],
        'dataInicio' => $converteJson[6],
        'dataLimite' => $converteJson[7]
     );
    echo json_encode($data);
break;
}
}
elseif($modo == 'atualizaDados'){

switch($tabelaEdicao){
case "usuario":
    $id = $_POST['adicionar'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $funcao = $_POST['funcao'];
    $personagem = $_POST['personagem'];
    $usuario = new Usuario();
    $usuario->atualizarUsuario($id,$nome, $email, $senha, $cpf, $funcao, intval($personagem));
    break;

case "tarefa":
    $id = $_POST['adicionar'];
    $mestre = $_POST['mestre'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];
    $valorXP = $_POST['valorXP'];
    $dataInicio = $_POST['dataInicio'];
    $dataLimite = $_POST['dataLimite'];
    
    
    $atualizaXP = new BalanceamentoXp();
    $tarefa = new Tarefa();
    $seleciona = $tarefa->getDadosTarefa($id);
    $statusAtual = $seleciona[4];

    if(($status == "aberta" && $statusAtual != "aguardando" && $status != $statusAtual) || ($status == "aguardando" && $statusAtual != "aberta" && $status != $statusAtual)){
        $atualizaXP->retiraXpMes($mestre, $valorXP);
        $atualizaXP->retiraXpTotal($mestre, $valorXP);
    }
    else if($status == "fechada" && $status != $statusAtual){
        $atualizaXP->setXpMensal($valorXP);
        $atualizaXP->insereXpMensal($mestre);
        $atualizaXP->setXpTarefa($valorXP);
        $atualizaXP->selecionaXpTotal($mestre);
        $atualizaXP->insereXpTotal($mestre);
    }
    $quadroTarefa = new QuadroTarefa();
    $quadroTarefa->atualizarUsuarioTarefa($id,$mestre);

    $tarefa->atualizarTarefa($id,$mestre,$titulo, $descricao, $status, $valorXP, $dataInicio, $dataLimite);
    break;
}
header('Location: index.php');

}