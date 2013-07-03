#!/usr/bin/php
<?php

define('HOST_FROM', 'source.imap.server');
define('HOST_TO', 'target.imap.server');
define('DOMAIN', 'domain.ext');


if( ! $argv[1] )
  die( 'USAGE: ' . $argv[0] . ' <csv_file> ' );

$fh = fopen( $argv[1], 'r+' );
$contents = fread( $fh, filesize( $argv[1] ) );
fclose( $fh );
$cn = explode( '\n', $contents );

foreach( $cn as $c ):
  $n = explode( ';', $c );
	if ( $n[0] != '' ) :
	  $cmd = '/usr/bin/imapsync \
	    --host1 '.HOST_FROM.' \
      --user1 '.$n[0].' \
      --password1 '.$n[1].' \
	    --host2 '.HOST_TO.' \
      --user2 '.$n[2].'@'.DOMAIN.' \
      --password2 '.$n[3].' \
	    --subscribed --subscribe \
      --useheader Message-ID \
      --idatefromheader \
      --authmech1 LOGIN --ssl1 \
      --authmech2 LOGIN --ssl2 \
	    --buffersize 614400000 \
      --skipsize \
      ';
    passthru($cmd);
	endif;
endforeach;
?>
