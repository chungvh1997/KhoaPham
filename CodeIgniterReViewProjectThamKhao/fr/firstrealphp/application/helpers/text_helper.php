<?php 
if(!function_exists("removesign")){

    function removesign($str)
    {
        $delimiter = '-';
        $clean = replace_keyword($str);
        $clean = replace_accent($clean);
        $clean = mb_convert_encoding($clean, 'UTF-8', 'ISO-8859-2');
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        return $clean;
    }
}  
if(!function_exists("replace_accent")){
    function replace_accent($str) 
    { 
      $a = array('�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', '�', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', '�', '�', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', '�', '�', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', '�', 'Z', 'z', 'Z', 'z', '�', '�', '?', '�', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?'); 
      $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o'); 
      return str_replace($a, $b, $str); 
    }
}
if(!function_exists("replace_keyword")){
    function replace_keyword($str)
    {
        $a=array("�","�","?","?","�","�","?","?","?","?","?","a","?","?","?","?","?","�","�","?","?","?","�","?","?","?","?","?","�","�","?","?","i","�","�","?","?","�","�","?","?","?","?","?","o","?","?","?","?","?","�","�","?","?","u","u","?","?","?","?","?","?","�","?","?","?","d","�","�","?","?","�","�","?","?","?","?","?","A","?","?","?","?","?","�","�","?","?","?","�","?","?","?","?","?","�","�","?","?","I","�","�","?","?","�","�","?","?","?","?","?","O","?","?","?","?","?","�","�","?","?","U","U","?","?","?","?","?","?","�","?","?","?","�","�","�","�","Q","W","E","R","T","Y","U","I","O","P","A","S","D","F","G","H","J","K","L","Z","X","C","V","B","N","M");
        $b=array("a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","e","e","e","e","e","e","e","e","e","e","e","i","i","i","i","i","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","u","u","u","u","u","u","u","u","u","u","u","y","y","y","y","y","d","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","e","e","e","e","e","e","e","e","e","e","e","i","i","i","i","i","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","u","u","u","u","u","u","u","u","u","u","u","y","y","y","y","y","d","e","u","a","q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m");
        return str_replace($a, $b, $str); 
    }
}
 ?>