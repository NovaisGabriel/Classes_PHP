<h1>Projeto: Classes em PHP</h1>
<p>O objetivo deste repositório é disponibilizar classes em liguagem PHP 
    para facilitar a implementação de busca em SQL no phpmyAdmin. A query é estabelecida em DAO - PDO.
</p>

<h2>Conteúdo do repositório</h2>
<p>O repositório contém os arquivos listados abaixo:</p>
<ul>
    <li><b>Class.php</b>: Script com o objetivo de criar funções que recuperam valores obtidos via formulários.</li>
    <li><b>Config.php</b>: Script com o objetivo de facilitar as chamadas por funções dentro das classes dos outros scripts, mas de outro lugar. </li>
    <li><b>FunctionsSqlutf8.php</b>: Script com o objetivo de realizar queries específicas na base de dados em SQL. A codificação é o UTF8, por este motivo o seu nome.
         Esta classe herda elementos da classe Sqlutf8.</li>
    <li><b>Sqlutf8.php</b>: Script que constrói classe no qual herda elementos da classe de PDO.</li>
</ul>

<h2>Forma de Implementação</h2>
<p>Para dar um exemplo de como funciona a chamada de um simples <i>select</i> da classe em FunctionsSqlutf8.php basta fazer o seguinte: 
<ul>
    <li>(1) Colocar os aqruivos em uma mesma pasta;</li>
    <li>(2) Configurar os valores de conexão da base de dados em PDO no script Sqlutf8.php</li>
    <li>(3) Depois para chamada no corpo do php fazer algo como:</li>
        <p><b>$selecao = FunctionsSqlutf8::select_normal("Colunas","Tabela")</b>;</p>
    </li>
    </ul>
  
</p>

<p>Com isso será obtido um array em php com a consulta desejada.</p>