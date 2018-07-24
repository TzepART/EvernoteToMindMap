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
$dir1 = new Node('dir1', $root);
$dir2 = new Node('dir2', $root);
$dir3 = new Node('dir3', $root);
$dir4 = new Node('dir4', $dir2);
$file1 = new Task('file1', 'txt', $dir1);
$file2 = new Task('doc', 'pdf', $dir4);

$root->showChildrenTree();