<?php
include_once('vendor/autoload.php');

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;

$connectionString = 'DefaultEndpointsProtocol=http;'
    . 'AccountName=phpaz1storage;'
    . 'AccountKey=nSsL1qPY62PDpeRV2qEAokllKpBRdz8OTkoGt424howtFg/1MdG3slxmsvPwBCOvMcTSu9B/baX6Izy8cikV2A==';
$tableRestProxy = ServicesBuilder::getInstance()->createTableService($connectionString);

try {
    // Create table if not exist
    $tableRestProxy->createTable("todos");
}
catch(ServiceException $e){
    $code = $e->getCode();
    $error_message = $e->getMessage();
    echo $error_message;
    // Handle exception based on error codes and messages.
    // Error codes and messages can be found here:
    // http://msdn.microsoft.com/en-us/library/windowsazure/dd179438.aspx
}