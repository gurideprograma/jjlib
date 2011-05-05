<?
/**
* A crisLib é uma pequena biblioteca PHP para reaproveitar código e encurtar funções de forma que o dia-a-dia do programador será mais produtivo.
* @name crisLib
* @author Tiago Floriano <contato@paico.com.br>
* @author Colaboração direta - Leo Caseiro <www.leocaseiro.com.br> - documentou e melhorou a versão anterior
* @version 0.5
* @license http://creativecommons.org/licenses/by-sa/3.0/legalcode
* @link http://paico.com.br/crislib
*/

/**
 * Algumas funções úteis
 * @category diversos
 */

/**
 * Arruma problema de codificação dentro de arquivos php chamados via ajax. Código retirado do blog do Elmicox
 * @name micoxdecode
 * @link http://elmicox.blogspot.com/2006/06/ajax-acentuao-soluo-final-1-linha-de.html
 */
function micoxdecode(){
    header("Content-Type: text/html; charset=ISO-8859-1",true);
}

/**
 * Gera uma tag select com a lista de UF para uso em formulários
 * @name gerauf
 * @param string $tipo
 * @param string $selecione
 * @param boolean|string $select
 * @example gerauf("full","Selecione","RS"); ou gerauf("full","UF"); ou gerauf("","");
 * @return string
 */
function gerauf($tipo, $selecione,$selected=false){ 
	if($tipo == "full"){
		echo "<select name=\"uf\">";
		echo "<option>$selecione</option>";
	}
        $lista = array("AC","AL","AP","AM","BA","CE","DF","ES","GO","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO");
        $c = 0; //contador
        while($c != 27){
            e("<option value=\"".$lista[$c]."\"");
            if($selected == $lista[$c]){
                e(" selected=\"selected\"");
            }
            e(">".$lista[$c]."</option>");
            $c = $c + 1;
        }
	if($tipo == "full"){
		echo "</select>";
	}
}

/**
 * Funções para tratar variáveis em determinadas situações
 * @category Tratamento de variáveis
 */

/**
 * Trata string para ser usada em comando SQL
 * @name str
 * @param string $nome
 * @example str("Açúcar' or id = '1'");
 * @return string
 */
function str($nome){
	return mysql_real_escape_string($nome);
}

/**
 * remove caracteres especiais de uma string e substitui por outro correspondente, ex.: "é" por "e" (sem aspas).
 * @name remCE
 * @param string $string
 * @example remCE("açúcar"); //retonará acucar
 * @return string
 */
function remCE($string){
	//retira acentos
	$string = str_replace("ã","a",$string);
	$string = str_replace("á","a",$string);
	$string = str_replace("à","a",$string);
	$string = str_replace("ä","a",$string);
	$string = str_replace("â","a",$string);

	$string = str_replace("ẽ","e",$string);
	$string = str_replace("é","e",$string);
	$string = str_replace("è","e",$string);
	$string = str_replace("ë","e",$string);
	$string = str_replace("ê","e",$string);

	$string = str_replace("ĩ","i",$string);
	$string = str_replace("í","i",$string);
	$string = str_replace("ì","i",$string);
	$string = str_replace("ï","i",$string);
	$string = str_replace("î","i",$string);

	$string = str_replace("õ","o",$string);
	$string = str_replace("ó","o",$string);
	$string = str_replace("ò","o",$string);
	$string = str_replace("ö","o",$string);
	$string = str_replace("ô","o",$string);

	$string = str_replace("ũ","u",$string);
	$string = str_replace("ú","u",$string);
	$string = str_replace("ù","u",$string);
	$string = str_replace("ü","u",$string);
	$string = str_replace("û","u",$string);

	$string = str_replace("ç","c",$string);

	//retira outras porcarias
	$string = str_replace("\"","",$string);
	$string = str_replace("'","",$string);
	$string = str_replace("�","",$string);
	$string = str_replace("`","",$string);
	$string = str_replace("!","",$string);
	$string = str_replace("#","",$string);
	$string = str_replace("$","",$string);
	$string = str_replace("%","",$string);
	$string = str_replace("�","",$string);
	$string = str_replace("&","",$string);
	$string = str_replace("*","",$string);
	$string = str_replace("(","",$string);
	$string = str_replace(")","",$string);
	$string = str_replace("_","",$string);
	$string = str_replace("-","",$string);
	$string = str_replace("+","",$string);
	$string = str_replace("=","",$string);
	$string = str_replace("�","",$string);
	$string = str_replace("}","",$string);
	$string = str_replace("]","",$string);
	$string = str_replace("�","",$string);
	$string = str_replace("�","",$string);
	$string = str_replace("�","",$string);
	$string = str_replace("�","",$string);
	$string = str_replace("�","",$string);
	$string = str_replace("�","",$string);
	$string = str_replace("{","",$string);
	$string = str_replace("[","",$string);
	$string = str_replace("�","",$string);
	$string = str_replace("^","",$string);
	$string = str_replace("~","",$string);
	$string = str_replace("?","",$string);
	$string = str_replace("/","",$string);
	$string = str_replace("�","",$string);
	$string = str_replace("<","",$string);
	$string = str_replace(",","",$string);
	$string = str_replace(">","",$string);
#	$string = str_replace(".","",$string);
	$string = str_replace(":","",$string);
	$string = str_replace(";","",$string);
	$string = str_replace("|","",$string);
	$string = str_replace("\\","",$string);
	$string = str_replace(" ","",$string);

	//retira espa�os
	$string = trim($string);

	return $string;
}

/**
 * Verifica se uma ou mais variáveis estão vazias, indicado para pegar campos de formulários
 * @name is_clear
 * @param array $var
 * @example is_clear($_POST["nome"],$_POST["email"]);
 * @return boolean
 */
function is_clear($var){ 
	$campos = count($var);
        $c = 0;
	while($c <= $campos){ 
		if($str[$c] != ""){ 
			$result = $result + 1;
		}
		$c = $c + 1;
	}
	if($result == $campos){ 
		return true;
	}else{ 
		return false;
	}
}

/**
 * Abreviaturas de funções
 * @category Aliases de funções
 */

/**
 * Alias para função echo
 * @name e
 * @param string $texto
 * @return string
 */
function e($texto){
	echo $texto;
}

/**
 * Alias para função p
 * @name p
 * @author Tiago Floriano <contato@paico.com.br>
 * @author LeoCaseiro <www.leocaseiro.com.br> - modificou a função de modo que o $alerta ficasse falso por padrão
 * @param string $texto
 * @param int $alerta
 * @return string
 */
function p($texto,$alerta = false){
	if(!$alerta){
            e("<p>$texto</p>");
        }else{
            if($alerta == 1){
                e("<p align=\"center\" style=\"color: red\"><b>$texto</b></p>");
            }else{
                e("<p align=\"center\">$texto</p>");
            }
        }
}

/**
 * Alias para redir
 * @name redir
 * @since v. r2
 * @param string $url
 * @param int $tempo
 * @example redir("http://paico.com.br",2);
 * @return string
 */
function redir($url,$tempo){
    e("<meta http-equiv=\"refresh\" content=\"$tempo;URL=$url\">");
}

/**
 * Mostra mensagem de informação usando jqueryui.com. Baixe a biblioteca em http://jqueryui.com
 * @name info
 * @since v. r2
 * @param string $txt
 * @example info("Cadastro efetuado com sucesso!");
 * @return string
 */
function info($txt){
    e("<div class=\"ui-widget\" style=\"margin-top: 3px;\">");
    e("<div class=\"ui-state-highlight ui-corner-all\" style=\"padding: 5px;\">");
    e("<span class=\"ui-icon ui-icon-info\" style=\"float: left; margin-right: 0.3em;\"></span>");
    e($txt);
    e("</div>");
    e("</div>");
}

/**
 * Mostra mensagem de erro usando jqueryui.com. Baixe a biblioteca em http://jqueryui.com
 * @name error
 * @since v. r2
 * @param string $txt
 * @example error("Você não preencheu o campo e-mail!");
 * @return string
 */
function error($txt){
    e("<div class=\"ui-widget\" style=\"margin-top: 3px;\">");
    e("<div class=\"ui-state-error ui-corner-all\" style=\"padding: 5px;\">");
    e("<span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: 0.3em;\"></span>");
    e($txt);
    e("</div>");
    e("</div>");
}

/**
 * Funções relacionadas a pesquisa e manipulação de dados num banco mysql
 * @category banco de dados
 */

/**
 * Conecta no mysql
 * @name con
 * @param string $usuario
 * @param string $senha
 * @param string|boolean $urlbanco
 * @example con("root","");
 * @return boolean
 */
function con($usuario, $senha, $urlbanco = false){
	if($urlbanco == false){
		$urlbanco = "localhost";
	}
	if(!mysql_connect($urlbanco,$usuario,$senha)){
		return false;
	} else {
		return true;
	}
}

/**
 * Seleciona banco no mysql
 * @name db
 * @param string $db
 * @return boolean
 */
function db($db){
	if(!mysql_select_db($db)){
		echo "Erro ao selecionar db.";
		return false;
	} else {
		return true;
	}
}

/**
 * Comando select do sql
 * @name sel
 * @param string $tabela
 * @param string $condicoes
 * @param string|boolean $ordem
 * @param string|boolean $limite
 * @example sel("pessoas","nome = 'Tiago'","nome ASC",50); ou sel("pessoas","nome like '%Tiago%'");
 * @return <type> 
 */
function sel($tabela, $condicoes, $ordem = false, $limite = false){
	$query = "SELECT * FROM $tabela";
	if($condicoes != "") {
		$query .= " WHERE $condicoes";
	}
	if($ordem != ""){
		$query .= " ORDER BY $ordem";
	}
	if($limite != ""){
		$query .= " LIMIT $limite";
	}
	$sql = mysql_query($query) or die(mysql_error());
	return $sql;
}

/**
 * Retorna o valor de um campo específico em uma tabela
 * @param string $tabela
 * @param string $campo
 * @param int $id
 * @example campo("pessoas","nome",4);
 * @return string
 */
function campo($tabela, $campo, $id){
	$sel = mysql_query("SELECT * FROM $tabela WHERE id = '$id'") or die(mysql_error());
	$r = mysql_fetch_array($sel);
	return $r[$campo];
}

//função insert melhorada
function ins($tabela, $campos, $valores){
	$query = "INSERT INTO $tabela ($campos) VALUES ($valores)";
	$sql = mysql_query($query) or die(mysql_error());
	return $sql;
}

//função update melhorada
function upd($tabela, $dados, $id){
	$query = "UPDATE $tabela SET $dados WHERE id = '$id'";
	$sql = mysql_query($query) or die(mysql_error());
	return $sql;
}

//função delete melhorada
function del($tabela, $id){
	$query = "DELETE FROM $tabela WHERE id = '$id'";
	$sql = mysql_query($query) or die(mysql_error());
	return $sql;
}


//retorna número de resultados de uma query
function total($query){
	$num = mysql_num_rows($query);
	return $num;
}

//aliás para função fetch
function fetch($query){
	$fetch = mysql_fetch_array($query);
	return $fetch;
}

//alias create table
function createT($nometabela,$campos){
	$sql = mysql_query("CREATE TABLE IF NOT EXISTS $nometabela ( id int(11), $campos, primary key(id) )") or die(mysql_error());
	return $sql;
}

//faz login de usuário
function login($usuario, $senha, $tabela_de_usuarios, $tabela_de_sessoes, $destino){
	//verifica se o usu�rio e a senha constam na tabela
	echo "Verificando usu&aacute;rio ... ";
	$sel = sel($tabela_de_usuarios,"usuario = '$usuario' and senha = '$senha'","","");
	echo "<b>ok</b><br>";
	if(mysql_num_rows($sel) == 0){//se n�o existir, mostra a mensagem abaixo
		echo "<i>Este usu&aacute;rio n&atilde;o existe!</i><br><br>";
		echo "<a href=\"javascript:history.go(-1);\">Voltar</a>";
		exit; //encerra a execu��o do arquivo, n�o permitindo que o usu�rio prossiga
	}else{
		echo "Gravando sess&atilde;o ... ";
		//guarda usuario e senha
		$_SESSION["login"] = $usuario;
		$_SESSION["senha"] = $senha;
		echo "<b>ok</b><br>";
		//guarda um valor de sess�o �nico para gravar que o usu�rio est� logado
		if($tabela_de_controle_de_sessoes != ""){
			$_SESSION["idsession"] = date("H") + date("i") + date("s") + date("d") + date("m") + date("Y");
			$idsession = $_SESSION["idsession"];
			ins($tabela_de_controle_de_sessoes,"usuario, senha, sessao, status","'$usuario', '$senha', '$idsession','online'");
		}
		echo "Redirecionando ... ";
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=$destino\">";
		echo "<b>ok</b>";
		exit;
	}
}

//faz logoff de usuário
function logoff($usuario, $senha, $tabela_de_usuarios, $tabela_de_sessoes, $destino){
	if($tabela_de_sessoes != ""){
		$ids = $_SESSION["idsession"];
		$sel = sel($tabela_de_sessoes,"ids = '$ids' and usuario = '$usuario and senha = '$senha'","","");
		if(total($sel) != 0){
			$r = fetch($sel);
			$del = del($tabela_de_sessoes,$r["id"]);
			$_SESSION["idsession"] = "";
			$_SESSION["login"] = "";
			$_SESSION["senha"] = "";
			echo "Usu&aacute;rio desautenticado...";
		}
	}else{
		$login = $_SESSION["login"];
		$senha = $_SESSION["senha"];
		$sel = sel($tabela_de_usuarios,"login = '$login' and senha = '$senha'","","");
		if(total($sel) > 0){
			$_SESSION["login"] = "";
			$_SESSION["senha"] = "";
			echo "Usu&aacute;rio desautenticado...";
		}
	}
}

//verifica se o usuário está autenticado e o redireciona
function is_autenticado($tabela_de_usuarios, $destino, $tabela_de_sessoes) {
	if(is_on($tabela_de_usuarios,$tabela_de_sessoes) == false){
		e("Voc&ecirc; n&atilde;o est&aacute; logado! Redirecionando...");
		e("<meta http-equiv=\"refresh\" content=\"0;URL=$destino\">");
	}
}

//verifica se o usuário está autenticado e retorna o resultado
function is_on($tabela_de_usuarios, $tabela_de_sessoes = false){
	$login = str($_SESSION["login"]);
	$senha = str($_SESSION["senha"]);
	$sel = sel($tabela_de_usuarios,"usuario = '$login' and senha = '$senha'","","");
	if(total($sel) == 0){
		return false;
	}else{
		if($tabela_de_sessoes != ""){
			$ids = $_SESSION["idsession"];
			$sel = sel($tabela_de_sessoes,"ids = '$ids' and usuario = '$usuario and senha = '$senha'","","");
			if(total($sel) == 0){
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}
	}
}

########## ARQUIVOS

//upload de arquivos
function up($arquivo,$destino,$extensoes){//para permitir todas extens��es de arquivos, deixe a $extens�es em branco, se n�o, informe todas as extens�es permitidas

}

//cria miniatura de imagens
function im($imagem, $h, $w){
	//verifica na $imagem o que � pasta, o que � arquivo e o que � extens�o
	$explode = explode("/",$imagem);
	$pasta = $explode[0]."/"; // $pasta = pasta_de_imagens/
	$arquivo = $explode[1]; // $arquivo = arquivo.jpg ou .gif ou .png
	$explode = explode(".",$arquivo);
	$extensao = $explode[1];
	$nomearquivo = $explode[0];
	//script original: http://sniptools.com/tutorials/generating-jpggifpng-thumbnails-in-php-using-imagegif-imagejpeg-imagepng
	//adaptado por Tiago Floriano Webdesigner em 27 de outubro de 2007
	$thumbWidth = $w; // Intended dimension of thumb
	$thumbHeight = $h;
	if(!file_exists($pasta.$nomearquivo."_".$w.$h.".".$extensao)){
		if($extensao == "jpg" or $extensao == "JPG" or $extensao == "jpeg" or $extensao == "JPEG"){
			// Beyond this point is simply code.
			$sourceImage = imagecreatefromjpeg($imagem);
			$sourceWidth = imagesx($sourceImage);
			$sourceHeight = imagesy($sourceImage);

			$targetImage = imagecreatetruecolor($thumbWidth,$thumbHeight);
			imagecopyresampled($targetImage,$sourceImage,0,0,0,0,$thumbWidth,$thumbHeight,imagesx($sourceImage),imagesy($sourceImage));
			imagejpeg($targetImage,$pasta.$nomearquivo."_".$w.$h.".".$extensao);
			$thumbName = $pasta.$nomearquivo."_".$w.$h.".".$extensao;
		}
		if($extensao == "gif" or $extensao == "GIF"){
			// Beyond this point is simply code.
			$sourceImage = imagecreatefromgif($imagem);
			$sourceWidth = imagesx($sourceImage);
			$sourceHeight = imagesy($sourceImage);

			$targetImage = imagecreatetruecolor($thumbWidth,$thumbHeight);
			imagecopyresampled($targetImage,$sourceImage,0,0,0,0,$thumbWidth,$thumbHeight,imagesx($sourceImage),imagesy($sourceImage));
			imagegif($targetImage, $pasta.$nomearquivo."_".$w.$h.".".$extensao);
			$thumbName = $pasta.$nomearquivo."_".$w.$h.".".$extensao;
		}
		if($extensao == "png" or $extensao == "PNG"){
			// Beyond this point is simply code.
			$sourceImage = imagecreatefrompng($imagem);
			$sourceWidth = imagesx($sourceImage);
			$sourceHeight = imagesy($sourceImage);

			$targetImage = imagecreatetruecolor($thumbWidth,$thumbHeight);
			imagecopyresampled($targetImage,$sourceImage,0,0,0,0,$thumbWidth,$thumbHeight,imagesx($sourceImage),imagesy($sourceImage));
			imagepng($targetImage, $pasta.$nomearquivo."_".$w.$h.".".$extensao);
			$thumbName = $pasta.$nomearquivo."_".$w.$h.".".$extensao;
		}
	}else{
		$thumbName = $pasta.$nomearquivo."_".$w.$h.".".$extensao;
	}
	return $thumbName;
}

//lista diretórios
function pasta($diretorio){

}

//lista arquivos
function arq($arquivo){

}


########## E-MAIL

//envia email usando a função mail ou smtp
function sendmail($destino, $assunto, $mensagem, $remetente, $tipo, $protocolo){//o $tipo � se o e-mail � html ou somente texto, o $protocolo � se � usando a fun��o mail ou smtp
	if($protocolo == "mail"){ //criado por LeoCaseiro e adaptado por Tiago Floriano
		if($tipo == "html"){
			/* Para enviar email HTML, voc� precisa definir o header Content-type. */
			$headers  = 'MIME-Version: 1.0\n';
			$headers .= 'Content-type: text/html; charset=iso-8859-1\n';
		}
		/* headers adicionais */
		$headers .= "From: $deNome <$deEmail>\r\n";
		$headers .= "To: $paraNome <$paraEmail>\r\n";
		/* Enviar o email */
		if(mail($para, $assunto, $mensagem, $headers)) {
			return true;
		}else{
			return false;
		}
	}else{
		//smtp
	}
}

//cria e-mail no cpanel
function criamail($email, $senha){

}

//deleta e-mail no cpanel
function delmail($email,$senha){

}

########## DATA

//transforma o número do mês em nome escrito por extenso. Ex.: 01 = janeiro
function mes($mes){
	if($mes == 1){
		$mes = "janeiro";
	}
	if($mes == 2){
		$mes = "fevereiro";
	}
	if($mes == 3){
		$mes = "mar&ccedil;o";
	}
	if($mes == 4){
		$mes = "abril";
	}
	if($mes == 5){
		$mes = "maio";
	}
	if($mes == 6){
		$mes = "junho";
	}
	if($mes == 7){
		$mes = "julho";
	}
	if($mes == 8){
		$mes = "agosto";
	}
	if($mes == 9){
		$mes = "setembro";
	}
	if($mes == 10){
		$mes = "outubro";
	}
	if($mes == 11){
		$mes = "novembro";
	}
	if($mes == 12){
		$mes = "dezembro";
	}
	return $mes;
}

//muda formato de data para AAAA-mm-dd, dd/mm/AAAA ou dd de mm de AAAA
function data($data, $tipo = 0){
	if($tipo == 0){
		$data = explode("-",$data);
		$data = $data[2]."/".$data[1]."/".$data[0];
	}elseif($tipo == 1){
		$data = explode("-",$data);
		$data = $data[2]." de ".mes($data[1])." de ".$data[0];
	}else{
		$data = explode("/",$data);
		$data = $data[2]."-".$data[1]."-".$data[0];
    }
	return $data;
}

########## SEGURANÇA

//máscara para url
function url($uri, $pasta) { //Podemos amadurecer mais ainda esta fun��o
	if($uri == "/$pasta"){ $uri = "/?home"; }
	$uri = explode("?",$uri);
	$uri = explode("&",$uri[1]);
	$uri = $uri[0];
	$arquivo = "pages/".$uri.".php";//pages ? o nome da pasta onde ficar?o os arquivos internos que guardam o conte?do, que ser?o inseridos no arquivo principal, no lugar do conte?do. Mude para o nome da pasta onde voc? guarda os arquivos.
	if(is_file($arquivo)){
		$path = $arquivo;
	}else{
		$path = "pages/erro.php";
	}
	return $path;
}
?>