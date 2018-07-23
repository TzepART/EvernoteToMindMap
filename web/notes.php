<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 24/07/2018
 * Time: 00:04
 */

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

if(empty($_GET['oauth_token'])){
    $parameters = Yaml::parseFile(__DIR__.'/../app/parameters.yml');

    $sandbox = true;
    $china   = false;
    $oauth_handler = new \Evernote\Auth\OauthHandler($sandbox, false, $china);
    $key      = $parameters['parameters']['app_key'];
    $secret   = $parameters['parameters']['app_secret_key'];
    $callback = 'http://localhost:8000/notes.php';
    try {
        $oauth_data  = $oauth_handler->authorize($key, $secret, $callback);
        echo "\nOauth Token : " . $oauth_data['oauth_token'];
        // Now you can use this token to call the api
        $client = new \Evernote\Client($oauth_data['oauth_token']);
    } catch (Evernote\Exception\AuthorizationDeniedException $e) {
        //If the user decline the authorization, an exception is thrown.
        echo "Declined";
    }
}else{
    $token = $_GET['oauth_token'];

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
    $sandbox = false;
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
    //$results = $client->findNotesWithSearch($search, $notebook, $scope, $order, $maxResult);
    //$results = $client->findNotesWithSearch($search);
    try{
        $results = $client->getNote('ddf0a433-6116-4c46-a903-9ed1e81f4cf6');
    }catch (\EDAM\Error\EDAMUserException $exception){
        echo "<pre>";
        var_dump($exception->getMessage());
        echo "</pre>";
    }
    if(!empty($results)){
        foreach ($results as $result) {
            $noteGuid    = $result->guid;
            $noteType    = $result->type;
            $noteTitle   = $result->title;
            $noteCreated = $result->created;
            $noteUpdated = $result->updated;
        }
    }
}
