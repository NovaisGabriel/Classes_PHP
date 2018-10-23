<?php
//CODIGO DE ARMAZENAMENTO DE FUNCOES
//GABRIEL LIMA NOVAIS

//DAO - PDO - CLASSES IMPORTANTES

class SQL extends PDO{

  private $conn;

  public function __construct(){

    $this->conn = new PDO("mysql:dbname=***;host=***","***","***");

  }

  private function setParams($statement, $params){
    foreach ($params as $key => $value) {
      $this->setParam($statement,$key,$value);
    }
  }

  private function setParam($statement, $key, $value){
      $statement->bindParam($key,$value);
  }

  public function query($rawQuery, $params=array()){

    $stmt = $this->conn->prepare($rawQuery);

    $this->setParams($stmt, $params);

    $stmt->execute();

    return $stmt;

  }

  public function select($rawQuery, $params = array()):array{

    $stmt = $this->query($rawQuery,$params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  }

//Classe USUARIO;
class   Usuario {
   //Variáveis private;
   private $nome;
   private $cpf;
   private $cep;
   private $nascimento;
   private $email;
   private $celular;
   private $sexo;
   private $senha;
   private $login;
   private $rua;
   private $numero;
   private $cidade;
   private $estado;
   private $id_usuario;
   //Funções SET;
   public function setNome($nome){$this->nome = $nome;}
   public function setCpf($cpf){
     if(empty($cpf)){return false;}
     $cpf = preg_match('/[0-9]/', $cpf)?$cpf:0;
     $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
     if (strlen($cpf) != 11) {echo "length";return false;}
     else if (
        $cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999') {return false;}
        else {
          for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {$d += $cpf{$c} * (($t + 1) - $c);}
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {return false;}
        } return true;}$this->cpf = $cpf;}
   public function setCep($cep){$this->cep = $cep;}
   public function setNascimento($nascimento){$this->nascimento = $nascimento;}
   public function setRua($rua){$this->rua = $rua;}
   public function setNumero($numero){$this->numero = $numero;}
   public function setCidade($cidade){$this->cidade = $cidade;}
   public function setEstado($estado){$this->estado = $estado;}
   public function setEmail($email){$this->email = $email;}
   public function setCelular($celular){$this->celular = $celular;}
   public function setSexo($sexo){$this->sexo = $sexo;}
   public function setSenha($senha){$this->senha = $senha;}
   public function setLogin($login){$this->login = $login;}
   public function setIdusuario($id_usuario){$this->id_usuario = $id_usuario;}
   //Funções GET;
   public function getNome(){return $this->nome;}
   public function getCpf(){return $this->cpf;}
   public function getNascimento(){return $this->nascimento;}
   public function getRua(){return $this->rua;}
   public function getNumero(){return $this->numero;}
   public function getCidade(){return $this->cidade;}
   public function getEstado(){return $this->estado;}
   public function getEmail(){return $this->email;}
   public function getCelular(){return $this->celular;}
   public function getSexo(){return $this->sexo;}
   public function getSenha(){return $this->senha;}
   public function getLogin(){return $this->login;}
   public function getIdusuario(){return $this->id_usuario;}
   //Exibir;
   public function exibir(){
    return array(
      "Nome"=>$this->getNome(),
      "Cpf"=>$this->getCpf(),
      "Nascimento"=>$this->getNascimento(),
      "Rua"=>$this->getRua(),
      "Numero"=>$this->getNumero(),
      "Cidade"=>$this->getCidade(),
      "Estado"=>$this->getEstado(),
      "Email"=>$this->getEmail(),
      "Celular"=>$this->getCelular(),
      "Sexo"=>$this->getSexo(),
      "Senha"=>$this->getSenha(),
      "Login"=>$this->getLogin(),
      "Id_usuario"=>$this->getIdusuario()
    );
    }

   public function loadById($id){

    $sql = new SQL();

    $results = $sql->select("SELECT * FROM usuario WHERE id_usuario = :ID", array(":ID"=>$id));

    if(count($results) > 0){

      $row = $results[0];

      $this->setNome($row["nome"]);
      $this->setCpf($row["cpf"]);
      $this->setNascimento($row["nascimento"]);
      $this->setRua($row["rua"]);
      $this->setNumero($row["numero"]);
      $this->setCidade($row["cidade"]);
      $this->setEstado($row["estado"]);
      $this->setEmail($row["email"]);
      $this->setCelular($row["celular"]);
      $this->setSexo($row["sexo"]);
      $this->setLogin($row["senha"]);
      $this->setLogin($row["login"]);
      $this->setIdusuario($row["id_usuario"]);
    }

    }

   public static function getList(){

     $sql = new SQL();

     return $sql->select("SELECT * FROM usuario ORDER BY nome;");

    }

   public static function search($col,$busca){

     $sql = new SQL();

     return $sql->select("SELECT * FROM usuario WHERE $col LIKE $busca");
     //essa função precisa colocar os %% na $busca...
   }

   public function login($login,$password){
     $sql = new SQL();

     $results = $sql->select("SELECT * FROM usuario WHERE login = :LOGIN AND senha=:SENHA", array(
       ":LOGIN"=>$login,
       ":SENHA"=>$password
     ));

     if(count($results) > 0){

       $row = $results[0];

       $this->setNome($row["nome"]);
       $this->setCpf($row["cpf"]);
       $this->setNascimento($row["nascimento"]);
       $this->setRua($row["rua"]);
       $this->setNumero($row["numero"]);
       $this->setCidade($row["cidade"]);
       $this->setEstado($row["estado"]);
       $this->setEmail($row["email"]);
       $this->setCelular($row["celular"]);
       $this->setSexo($row["sexo"]);
       $this->setLogin($row["senha"]);
       $this->setLogin($row["login"]);
       $this->setIdusuario($row["id_usuario"]);
     }
     else{
       throw new Exception("Inválidos");
     }
   }

   public function setData($data){


     $this->setNome($data["nome"]);
     $this->setCpf($data["cpf"]);
     $this->setNascimento($data["nascimento"]);
     $this->setRua($data["rua"]);
     $this->setNumero($data["numero"]);
     $this->setCidade($data["cidade"]);
     $this->setEstado($data["estado"]);
     $this->setEmail($data["email"]);
     $this->setCelular($data["celular"]);
     $this->setSexo($data["sexo"]);
     $this->setLogin($data["senha"]);
     $this->setLogin($data["login"]);
     $this->setIdusuario($data["id_usuario"]);
   }

   public function insert(){
     $sql = new SQL();
     $results=$sql->select("CALL sp_usuarios_insert(:LOGIN , :PASSWORD)",array(
       ':LOGIN'=>$this->getLogin(),
       ':PASSWORD'=>$this->getSenha()

     ));
   }


   public function __toString(){
    return json_encode(array(
      "Nome"=>$this->getNome(),
      "Cpf"=>$this->getCpf(),
      "Nascimento"=>$this->getNascimento(),
      "Rua"=>$this->getRua(),
      "Numero"=>$this->getNumero(),
      "Cidade"=>$this->getCidade(),
      "Estado"=>$this->getEstado(),
      "Email"=>$this->getEmail(),
      "Celular"=>$this->getCelular(),
      "Sexo"=>$this->getSexo(),
      "Senha"=>$this->getSenha(),
      "Login"=>$this->getLogin(),
      "Id_usuario"=>$this->getIdusuario()
    ));
  }

}


//Classe TRANSPORTADORA;
class   Transportadora {
   //Variáveis private;
   private $marca;
   private $cnpj;
   private $senha;
   private $login;
   private $email;
   private $endereco;
   private $id_trans;
   //Funções SET;
   public function setMarca($marca){$this->marca = $marca;}
   public function setCnpj($cnpj){$this->cnpj = $cnpj;}
   public function setSenha($senha){$this->senha = $senha;}
   public function setLogin($login){$this->login = $login;}
   public function setEmail($email){$this->email = $email;}
   public function setEndereco($endereco){$this->endereco = $endereco;}
   public function setIdtrans($id_trans){$this->id_trans = $id_trans;}
   //Funções GET;
   public function getMarca(){return $this->marca;}
   public function getCnpj(){return $this->cnpj;}
   public function getSenha(){return $this->senha;}
   public function getLogin(){return $this->login;}
   public function getEmail(){return $this->email;}
   public function getEndereco(){return $this->endereco;}
   public function getIdtrans(){return $this->id_trans;}
   //Exibir;
   public function exibir(){
    return array(
      "Marca"=>$this->getMarca(),
      "Cnpj"=>$this->getCnpj(),
      "Senha"=>$this->getSenha(),
      "Login"=>$this->getLogin(),
      "Email"=>$this->getEmail(),
      "Endereco"=>$this->getEndereco(),
      "Id_trans"=>$this->getIdtrans()
    );
  }
}

//Classe PRODUTO;
class   Produto {
   //Variáveis private;
   private $marca;
   private $estoque;
   private $descricao;
   private $nome;
   private $id_produto;
   private $foto;
   //Funções SET;
   public function setMarca($marca){$this->marca = $marca;}
   public function setEstoque($estoque){$this->estoque = $estoque;}
   public function setDescricao($descricao){$this->descricao = $descricao;}
   public function setNome($nome){$this->nome = $nome;}
   public function setIdproduto($id_produto){$this->id_produto = $id_produto;}
   public function setFoco($foto){$this->foto = $foto;}
   //Funções GET;
   public function getMarca(){return $this->marca;}
   public function getEstoque(){return $this->estoque;}
   public function getDescricao(){return $this->descricao;}
   public function getNome(){return $this->nome;}
   public function getIdproduto(){return $this->id_produto;}
   public function getFoto(){return $this->foto;}
   //Exibir;
   public function exibir(){
    return array(
      "Marca"=>$this->getMarca(),
      "Estoque"=>$this->getEstoque(),
      "Descricao"=>$this->getDescricao(),
      "Nome"=>$this->getNome(),
      "Id_produto"=>$this->getIdproduto(),
      "Foto"=>$this->getFoto()
    );
  }
}




























?>
