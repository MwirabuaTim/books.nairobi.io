<?php
    
    $imgurl = "";
    if(isset($item["MediumImage"]["URL"]))
        $imgurl = $item["MediumImage"]["URL"];
    else{
        $imgurl = "Image not available";
    }

    $title = "";
    if(isset($item["ItemAttributes"]["Title"]))
        $title = $item["ItemAttributes"]["Title"];
    else{
        $title = "Not Titled";
    }

    $author = "";
    if(array_key_exists('Author', $item["ItemAttributes"])):
        if(is_array($item["ItemAttributes"]["Author"])):
            $author = "Authors: ". implode(', ',array_values($item["ItemAttributes"]["Author"]));
        else:
            $author = "Author: ".$item["ItemAttributes"]["Author"];
        endif;
        // var_dump($item);
    elseif(array_key_exists('Creator', $item["ItemAttributes"])):
        if(is_array($item["ItemAttributes"]["Creator"][0]) && is_array($item["ItemAttributes"]["Creator"][1])):
            $author1 = implode(', ',array_values($item["ItemAttributes"]["Creator"][0]));
            $author2 = implode(', ',array_values($item["ItemAttributes"]["Creator"][1]));
            $author = "Creators: ". $author1 . " and " . $author2;
        elseif(is_array($item["ItemAttributes"]["Creator"])[0]):
            $author = "Creator: ". implode(', ',array_values($item["ItemAttributes"]["Creator"][0]));
        else:
            $author = "Creators: ". print_r($item["ItemAttributes"]["Creator"]);
        // $author = "Creators: ". implode(', ',array_values($item["ItemAttributes"]["Creator"]));
        endif;
    else:
        $author = "Unknown";
    endif;
        // print_r($author);
    

    $publishdate = "";
    if(isset($item["ItemAttributes"]["Title"])):
        $publishdate = $item["ItemAttributes"]["Title"];
    else:
        $publishdate = "Not Titled";
    endif;

    $edition = "";
    if(isset($item["ItemAttributes"]["Title"])):
        $edition = $item["ItemAttributes"]["Title"];
    else:
        $edition = "Not Titled";
    endif;

    $isbn = "";
    if(isset($item["ItemAttributes"]["Title"]))
        $isbn = $item["ItemAttributes"]["Title"];
    else{
        $isbn = "Not Titled";
    }

    $newprice = "";
    if(isset( $item["ItemAttributes"]["ListPrice"]["FormattedPrice"] ))
        $newprice = $item["ItemAttributes"]["ListPrice"]["FormattedPrice"];
    else{ 
        $newprice =  "Price unspecified";
    }

    $usedprice = "";
    if(isset( $item["ItemAttributes"]["ListPrice"]["FormattedPrice"] ))
        $usedprice = $item["ItemAttributes"]["ListPrice"]["FormattedPrice"];
    else{ 
        $usedprice =  "Unspecified";
    }

    $amazonlink = "";
    if(isset( $item["ItemAttributes"]["ListPrice"]["FormattedPrice"] ))
        $amazonlink = $item["ItemAttributes"]["ListPrice"]["FormattedPrice"];
    else{ 
        $amazonlink =  "Unspecified";
    }

    $binding = "";
    if(isset($item["ItemAttributes"]["Binding"]))
        $binding = $item["ItemAttributes"]["Binding"];
    else{
        $binding = "Unknown";
    }
    

?>