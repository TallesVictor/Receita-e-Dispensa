<?php class Conexao
{
   private $_host = 'localhost';
   private $_user = 'root';
   private $_pass = '';
   private $_database = 'bdlocal';
   public  $_con;
 
   function __construct()
   {
       $this->conecta();
   }
 
   function conecta()
   {
       $_con = mysql_connect($this->_host, $this->_user, $this->_pass) or die("Erro ao conectar ao servidor &raquo; " . mysql_error());
       $_con = mysql_select_db($this->_database) or die("Erro ao selecionar o Banco de Dados &raquo; " . mysql_error());
       return $_con;
   }
}
?>