<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */

/*echo "Teste Email Function:<br>"; 

$email = 'dnaloco@gmail.com'; // email para onde a mensagem deve ir
$resultado = mail($email, 'Testando nossa configuração', 'Olá, nossa configuração funcionou.');
if($resultado)
{
    echo 'Seu email foi enviado com sucesso.';
}
else
{
    echo 'Não foi possível enviar seu email.';
}

die;*/

date_default_timezone_set('America/Sao_Paulo');

chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();


mail ('arthur_scosta@yahoo.com.br', "Test Postfix", "Test mail from postfix");