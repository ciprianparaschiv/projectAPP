<?php
   
    function smarty_modifier_replace_url($string, $rel = 'nofollow'){

      $host = "([a-z\d][-a-z\d]*[a-z\d]\.)+[a-z][-a-z\d]*[a-z]";

      $port = "(:\d{1,})?";

      $path = "(\/[^?<>\#\"\s]+)?";

      $query = "(\?[^<>\#\"\s]+)?";

      return preg_replace("#((ht|f)tps?:\/\/{$host}{$port}{$path}{$query})#i", "<a href=\"$1\" rel=\"{$rel}\">$1</a>", $string);

      }

?>