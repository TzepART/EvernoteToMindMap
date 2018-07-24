<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 24/07/2018
 * Time: 15:37
 */

function __autoload($classname) {
    $filename = __DIR__."/../src/". str_replace('\\','/',$classname) .".php";
    include_once($filename);
}

use \Model\Node;
use \Model\Task;

$root = new Node('root');
$node1 = new Node('node1', $root);
$node2 = new Node('node2', $root);
$node3 = new Node('node3', $root);
$node4 = new Node('node4', $node2);
$task1 = new Task('task1', 'txt', $node1);
$task2 = new Task('doc', 'pdf', $node4);

$root->showChildrenTree(1);