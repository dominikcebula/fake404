<?php
    /**
      * Fake 404 error page
      * @category tools
      *
      * @author Dominik Cebula <dominikcebula@gmail.com>
      * @copyright Dominik Cebula <dominikcebula@gmail.com>
      * @license http://www.opensource.org/licenses/gpl-2.0.php GNU General Public License 2.0
      * @version 2010-02-17
      *
      */

    error_reporting(0);

    $magic='48fjvi3812kmfiox982';

    $req="GET ".$_SERVER['REQUEST_URI'].$magic." HTTP/1.0\r\n";
    $req.="Host: ".$_SERVER['SERVER_NAME']."\r\n";
    $req.="Accept-Language: pl,en-us;q=0.7,en;q=0.3\r\n";
    $req.="Connection: close\r\n\r\n";

    $sock=socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    socket_connect($sock, $_SERVER['SERVER_ADDR'], 80);
    socket_write($sock, $req, strlen($req));
    $buff=socket_read($sock, 16384);
    socket_close($sock);

    $buff=preg_replace('/'.$magic.'/', '', $buff);
    $offset=strpos($buff, '<');
    $buff=substr($buff, $offset, strlen($buff)-$offset);

    header("HTTP/1.0 404 Not Found");
    header("Status: 404 Not Found");

    echo $buff;
?>
