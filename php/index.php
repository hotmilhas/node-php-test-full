<?php

echo $_SERVER[ "REQUEST_URI" ];

$sql = 'SELECT name, colour, calories
    FROM fruit
    WHERE calories < :calories AND colour = :colour';
$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute(array(':calories' => 150, ':colour' => 'red'));
$red = $sth->fetchAll();
$sth->execute(array(':calories' => 175, ':colour' => 'yellow'));
$yellow = $sth->fetchAll();

function login($username, $password) {
	
    $sql = "
        select * 
        from users 
        where username = :username AND password = :password
    ";

	$sth = $dbh->prepare( $sql );
	$sth->execute(array(':username' => $username, ':password' => $password));
	$user = $sth->fetch(PDO::FETCH_ASSOC);

    return $user;
	
}

function login($username, $password) {
    $sql = "
        select * 
        from users 
        where username = $username AND password = $password
    ";

    $users = $pdo->query($sql);

    return $users[0];
}