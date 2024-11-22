<?php
function cleanStr($string)
{
   $string = str_replace(' ', '-', $string); // Replaces spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function getEnvVariable($name)
{
   $ret = null;

   $fileEnv = file_get_contents(__DIR__ . '/../.env.local');
   if ($fileEnv) {
      $arrEnv = parse_ini_string($fileEnv);
      foreach ($arrEnv as $k => $v) {
         if ($k == $name) {
            $ret = $v;
         }
      }
   }

   return $ret;
}
