<?php 
function normaliza($nom){
  $or = array(" ","á","é","í","ó","ú","ñ");
  $de = array("_","a","e","i","o","u","n");
  return str_replace($or, $de,strtolower($nom));
}
