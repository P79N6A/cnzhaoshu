<?php
function checkhost()
{

    if (isset($_SERVER['HTTP_REFERER'])) {
        $host = parse_url($_SERVER['HTTP_REFERER'])['host'];

        if($host){
            $host = explode('.', $host);
            $count = count($host);
            $host = $host[$count-2].'.'.$host[$count-1];
            // if ($host!='cnzhaoshu.com') exit;
        } else {
            exit;
        }
    }else{
        exit;
    }

    $query = strtolower($_SERVER['QUERY_STRING']);
    if ($query) {
        $badkeys = array('delete','update','drop','alter','insert','select',';');
        foreach ($badkeys as $key) {
            if (strstr($query,$key)!==false) exit;
        }
    }  
}
// checkhost();
?>