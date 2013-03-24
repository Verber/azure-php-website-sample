<?php
require_once('vendor/autoload.php');

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;

$connectionString = 'DefaultEndpointsProtocol=http;'
    . 'AccountName=testcloudserv;'
    . 'AccountKey=qYJ/3rKiHR3HIuLwOrUDvqKcK5O8F7Td4pgiPep1pBOVz4DpKR+mlyzpJA7gQ9JJc1QC7Z43lVq0DmtXCCHstg==';
$tableRestProxy = ServicesBuilder::getInstance()->createTableService($connectionString);

try {
    // Create table.
    $tableRestProxy->createTable("testtable");
    echo 'Table created';
}
catch(ServiceException $e){
    $code = $e->getCode();
    $error_message = $e->getMessage();
    // Handle exception based on error codes and messages.
    // Error codes and messages can be found here:
    // http://msdn.microsoft.com/en-us/library/windowsazure/dd179438.aspx
}