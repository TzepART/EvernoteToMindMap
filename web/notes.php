<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 24/07/2018
 * Time: 00:04
 */

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

$parameters = Yaml::parseFile(__DIR__.'/../app/parameters.yml');

$token = $parameters['parameters']['app_dev_token'];

/** Understanding SANDBOX vs PRODUCTION vs CHINA Environments
 *
 * The Evernote API 'Sandbox' environment -> SANDBOX.EVERNOTE.COM
 *    - Create a sample Evernote account at https://sandbox.evernote.com
 *
 * The Evernote API 'Production' Environment -> WWW.EVERNOTE.COM
 *    - Activate your Sandboxed API key for production access at https://dev.evernote.com/support/
 *
 * The Evernote API 'CHINA' Environment -> APP.YINXIANG.COM
 *    - Activate your Sandboxed API key for Evernote China service access at https://dev.evernote.com/support/
 *      or https://dev.yinxiang.com/support/. For more information about Evernote China service, please refer
 *      to https://dev.evernote.com/doc/articles/bootstrap.php
 *
 * For testing, set $sandbox to true; for production, set $sandbox to false and $china to false;
 * for china service, set $sandbox to false and $china to true.
 *
 */
$sandbox = true;
$china   = false;
$client = new \Evernote\Client($token, $sandbox, null, null, $china);
/**
 * The search string
 */
$search = new \Evernote\Model\Search('test');
/**
 * The notebook to search in
 */
$notebook = null;
/**
 * The scope of the search
 */
$scope = \Evernote\Client::SEARCH_SCOPE_BUSINESS;
/**
 * The order of the sort
 */
$order = \Evernote\Client::SORT_ORDER_REVERSE | \Evernote\Client::SORT_ORDER_RECENTLY_CREATED;
/**
 * The number of results
 */
$maxResult = 5;
try{
//    $results = $client->findNotesWithSearch($search, $notebook, $scope, $order, $maxResult);
//    $results = $client->findNotesWithSearch($search);
    $results = $client->getNote('74a8f706-1ffe-445f-ad2e-59c094c226f7');
}catch (\Exception $exception){
    echo "<pre>";
    var_dump($exception->getMessage());
    echo "</pre>";
}

if(!empty($results)){
    echo "<pre>";
        var_dump($results->getContent()->toEnml());
    echo "</pre>";
    foreach ($results as $result) {
        $noteGuid    = $result->guid;
        $noteType    = $result->type;
        $noteTitle   = $result->title;
        $noteCreated = $result->created;
        $noteUpdated = $result->updated;
    }
}
