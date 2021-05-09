<?php
function validGET($inputName){
    return isset($_GET[$inputName]) && !empty($_GET[$inputName]);
}
function existPOST($inputName){
    return isset($_POST[$inputName]) && !empty($_POST[$inputName]);
}

function redirectTo($url){
    header("Location: $url");
    die();
}

function afficheDateFR($dateStringUS){
    return date_format(date_create($dateStringUS), "d/m/Y");
}

// test 
// function modify(int $id)
// {
//     $post = (new Post($thid->getDB()))->findById($id)
//     return $this->view('modify', compact('post'));
// }