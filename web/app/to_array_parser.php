<?php

$needle = '    ';
$result = [];
$index  = 1;

foreach (file('test.txt') as $string) {
    $level    = substr_count($string, $needle);
    $parentId = findParentId($result, $level);
    $result[$index] = [
        'id'       => $index,
        'level'    => $level,
        'title'   => trim($string),
        'parentId' => $parentId,
    ];
    $index++;
}

function findParentId(array $list, int $level): int
{
    $parentId = 0;
    foreach (array_reverse($list, true) as $index => $item) {
        if ($item['level'] < $level) {
            return $index;
        }
    }

    return $parentId;
}

function buildTree(array &$elements, $parentId = 0)
{
    $branch = [];

    foreach ($elements as $element) {
        if ($element['parentId'] == $parentId) {
            $children = buildTree($elements, $element['id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[$element['id']] = $element;
            unset($elements[$element['id']]);
        }
    }

    return $branch;
}

//var_dump($result);
//file_put_contents('filename.txt', print_r($result, true));
//var_dump(buildTree($result));

$tree = buildTree($result);
file_put_contents('result.json', print_r(json_encode($tree, JSON_UNESCAPED_UNICODE),true));

// https://github.com/mindmup/mapjs-webpack-example
