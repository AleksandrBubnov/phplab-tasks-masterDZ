<?php
$sql = [
    'where' => [],
    'order' => '',
    'prepare' => [],
    'limit' => '',
];

function snakeCaseToCamelCase2(string $input)
{
    return preg_replace_callback('/_(.?)/', function ($matches) {
        return ucfirst($matches[1]);
    }, $input);
}

function getUniqueFirstLetters($pdo): array
{
    $sql = 'SELECT DISTINCT(LEFT(`name`,1)) AS letter FROM `airports` ORDER BY `letter`';
    $result = [];
    foreach ($pdo->query($sql) as $value) {
        $result[] = $value['letter'];
    }
    asort($result);
    return $result;
}

function getFilterByState($sql, $state)
{
    $sql['where'][] = "`states`.`name` = :state";
    $sql['prepare'] = array_merge($sql['prepare'], ['state' => $state]);
    return $sql;
}
function getSort($sql, $value)
{
    $sql['order'] = $value;
    return $sql;
}
function getFilterByFirstLetter($sql, $letter)
{
    $sql['where'][] = "`airports`.`name` LIKE :letter";
    $sql['prepare'] = array_merge($sql['prepare'], ['letter' => $letter . '%']);
    return $sql;
}
function getPage($sql, $page)
{
    $start = $page - 1;
    $sql['limit'] = $start . ', 5';
    return $sql;
}
function getAirports($pdo, $sql)
{
    $query = "SELECT COUNT(`airports`.`name`) AS `count`
        FROM `airports`
        LEFT JOIN `cities`
        ON `airports`.`city_id` = `cities`.`id`
        LEFT JOIN `states`
        ON `airports`.`state_id` = `states`.`id`";
    // implode - массив в строку
    $query .= ($sql['where']) ? ' WHERE ' . implode(' AND ', $sql['where']) : '';
    $sth = $pdo->prepare($query);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    foreach ($sql['prepare'] as $key => $value) {
        $sth->bindParam(":$key", $sql['prepare'][$key]);
    }
    $sth->execute(); // выполнить запрос
    $result = $sth->fetch(); // получить результирующую строку (тут один результат)
    $count = $result['count'];

    $query = "SELECT `airports`.`name` AS `name`,
        `airports`.`code` AS `code`,
        `airports`.`address` AS `address`,
        `airports`.`timezone` AS `timezone`,
        `cities`.`name` AS `city`,
        `states`.`name` AS `state`
        FROM `airports`
        LEFT JOIN `cities`
        ON `airports`.`city_id` = `cities`.`id`
        LEFT JOIN `states`
        ON `airports`.`state_id` = `states`.`id`";
    // implode - массив в строку
    $query .= ($sql['where']) ? ' WHERE ' . implode(' AND ', $sql['where']) : '';
    $query .= ($sql['order']) ? ' ORDER BY ' . $sql['order'] : '';
    $query .= ($sql['limit']) ? ' LIMIT ' . $sql['limit'] : ' LIMIT 5 ';
    $sth = $pdo->prepare($query);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    foreach ($sql['prepare'] as $key => $value) {
        $sth->bindParam(":$key", $sql['prepare'][$key]);
    }
    $sth->execute();
    $airports = $sth->fetchAll();
    return ['count' => $count, 'airports' => $airports];
}
