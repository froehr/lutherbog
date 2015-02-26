<?php
include "token.php";

$featureserver = $_GET["server"];
$oid = $_GET["oid"];

if(is_numeric($featureserver) && is_numeric($oid)){
    $server = "https://services1.arcgis.com/W47q82gM5Y2xNen1/arcgis/rest/services/Final_Project_Emily_Fabian/FeatureServer/";
    
    $imageJSONLink =  $server . $featureserver . "/" . $oid . "/attachments?f=pjson&token=".$token;
    $imageJSONString = file_get_contents($imageJSONLink);
    $count = substr_count ($imageJSONString , "id");
    
    // if no picture is stored load no-picture image
    if($count < 1){
        $imageURL = "http://prairieautocredit.net/image/default_main_image.jpg";   
    }
    
    // If picture is stored load it
    else{
        $imageJSON = json_decode($imageJSONString, true); 
        $imageID =  $imageJSON["attachmentInfos"][0]["id"];
        $imageURL = $server . $featureserver . "/" . $oid . "/attachments/" . $imageID . "/?token=" . $token;
    }
    
    // Load picture from specified link
    $image = file_get_contents($imageURL); 
    $imginfo = getimagesize($imageURL);
    header("Content-type:" . $imginfo['mime']);
    readfile($imageURL);
    echo $image;
}

?>