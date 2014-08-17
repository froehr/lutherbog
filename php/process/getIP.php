<?php

function validateIpV4Range ($target, $range) {  
    $counter = (int) 0;  
    // explode target ip  
    $tip = explode ('.', $target);  
    // explode range ip  
    $rip = explode ('.', $range);  
    // run ip segments  
    foreach ($tip as $targetsegment) {  
        // get appropriate range segm.  
        $rseg = $rip[$counter];  
        // strip brackets  
        $rseg = preg_replace ('=(\[|\])=', '', $rseg);  
        // explode min max  
        $rseg = explode ('-', $rseg);  
        // no max value  
        if (!isset($rseg[1]))  
            $rseg[1] = $rseg[0];  
        // compare  
        if ($targetsegment < $rseg[0] || $targetsegment > $rseg[1])  
            return false;  
        $counter++;  
    }  
    return true;  
} 

if ($_POST['action'] == "ip"){
    
    $client_ip = $_SERVER['REMOTE_ADDR'];
    
    if (validateIpV4Range($client_ip, '[10].[66].[0-255].[0-255]')) {
        echo ("none");  
    }
    
    if (validateIpV4Range($client_ip, '[128].[176].[0-255].[0-255]')) {
        echo ("none");
    }
    else {
        echo ("block");
    }
}
?>