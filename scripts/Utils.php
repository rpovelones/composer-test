<?php

namespace TriMark;

use Composer\Script\Event;

class Utils {

    public static function generateLocalHtaccess( Event $event ) {
        $config = file_get_contents( __DIR__.'/../config.json' );
        $local_url = json_decode($config)->localUrl;
        $content = "<IfModule mod_rewrite.c>
RewriteEngine on
RewriteCond %{HTTP_HOST} ^(www.)?$local_url$
RewriteCond %{REQUEST_URI} !^/wp/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /wp/$1
RewriteCond %{HTTP_HOST} ^(www.)?$local_url$
RewriteRule ^(/)?$ wp/index.php [L] 
</IfModule>";
        file_put_contents( '.htaccess', $content );
    }

}