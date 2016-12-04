
<?php

require_once("../banco/retornaDados.php");
require_once("../quadroTarefa/quadroTarefasAdm.php");


class BalanceamentoXp{
private $xpTotal, $xpMensal, $nivel, $experiencia,$xpTarefa;

public function BalanceamentoXp(){

}
public function setXpMensal($xpMensal){
    $this->xpMensal = $xpMensal;
}

public function setXpTotal($xpTotal){
    $this->xpTotal = $xpTotal;
}

public function setNivel($nivel){
    $this->nivel = $nivel;
}

public function setXpTarefa($xpTarefa){
    $this->xpTarefa = $xpTarefa;
}

public function getXpMensal(){
    return $this->xpMensal;
}

public function getNivel(){
    return $this->$nivel;
}

public function getXpTotal(){
    return $this->xpTotal;
}
    
public function getExperiencia(){
    return $this->$experiencia;
}

public function getXpTarefa(){
    return $this->xpTarefa;
}

public function insereXpMensal($id){
    $dados = new Dados();
        
    $consulta = "update usuario set xpmes = xpmes + ".$this->getXpMensal()." where idUsuario = $id";

    $resultado = $dados->retornaQuery($consulta);
}

public function insereXpTotal($id){
    $dados = new Dados();

    $calculo = $this->getXpTarefa() * $this->calculoXpTotal();

    $consulta = "update usuario set xptotal = xptotal + $calculo where idUsuario = $id";

    $resultado = $dados->retornaQuery($consulta);  
}
public function retiraXpMes($id,$xpTarefa){
    $dados = new Dados();

    $consulta = "update usuario set xpmes = xpmes - $xpTarefa where idUsuario = $id";

    $resultado = $dados->retornaQuery($consulta);  
}

public function retiraXpTotal($id,$xpTarefa){
    $dados = new Dados();

    $consulta = "update usuario set xptotal = xptotal - ".$xpTarefa*$this->calculoXpTotal()." where idUsuario = $id";

    $resultado = $dados->retornaQuery($consulta);  
}

public function selecionaXpTotal($id){
    $dados = new Dados();
        
    $consulta = "select xptotal from usuario where idUsuario = $id";

    $resultado = $dados->retornaQuery($consulta);
        
    $total=$resultado->fetch_assoc();
        
    $this->setXpTotal($total['xptotal']);
}

public function calculoXpTotal(){
     $nivel = $this->calculaNivel();
     $contNivel = 1; $natural = 1; $decimal = 1;
     
     do{
         if($decimal > 9){
             $decimal = 0;
             $natural++;
         }

         $multiplicador = $natural.'.'.$decimal;
         $decimal++; $contNivel++;

     }while($nivel>=$contNivel);
     
     return $multiplicador;
}

public function calculaNivel(){
    $xpAtual = $this->getXpTotal();
    $nivelAtual = 0;
    $valor = 100;
    
    do{
        $aux = $valor + $valor;
        $valor = $aux;
        $nivelAtual++;

    }while($xpAtual >= $valor);
    
    $this->nivel = $nivelAtual;

    return $this->nivel;
}

public function calculaExperiencia(){
    $xpAtual = $this->getXpTotal();
    $this->experiencia = 100;
    
    do{
        $aux = $this->experiencia + $this->experiencia;
        $this->experiencia = $aux;

    }while($xpAtual >= $this->experiencia);

    return $this->experiencia;
}  


}

/*$teste = new BalanceamentoXp();
$teste->setXpMensal(10);
$teste->selectXpTotal(1);
$teste->setXpTarefa(30);
$teste->insereXpTotal(1);

echo($teste->getXpTarefa().'<br>');
echo($teste->calculaNivel().'<br>');
echo($teste->calculoXpTotal());*/
?>
