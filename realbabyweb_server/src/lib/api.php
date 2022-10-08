<?php

function valid_url($url)
{
    $valid = False;
    $res=preg_match('/^(http|https)?:\\/\\/.*(\\/)?.*$/',$url);
    if (!$res) $valid = True;
    try{ parse_url($url); }
    catch(Exception $e){ $valid = True;}
    $int_ip=ip2long(gethostbyname(parse_url($url)['host']));
    return $valid 
            || ip2long('127.0.0.0') >> 24 == $int_ip >> 24 
            || ip2long('10.0.0.0') >> 24 == $int_ip >> 24 
            || ip2long('172.16.0.0') >> 20 == $int_ip >> 20 
            || ip2long('192.168.0.0') >> 16 == $int_ip >> 16 
            || ip2long('0.0.0.0') >> 24 == $int_ip >> 24;
}

function request($url)
{

    if (valid_url($url) === True) { die("<script>location.href='/index.php?0x41414141=error'</script>"); }

    $ch = curl_init();
    $timeout = 7;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);

    if (curl_error($ch))
    {
        curl_close($ch);
        return "Error !";
    }

    curl_close($ch);
    return $data;
}

function upload($upfile){
    $filename = $upfile['name'];
    $encrypt_path = hash('sha256', $filename);
    
    if(preg_match("/htaccess/i", $filename)){
        die("<script>alert('upload not allowed!'); history.go(-1); </script>");
    }

    $ext = end(explode('.', strtolower($filename)));
    if(preg_match("/(php|html)/i", $ext)){
        die("<script>alert('no hack ~'); history.go(-1); </script>");
    }

    $create_path = "/var/www/html/uploads/{$encrypt_path}/";
    if(!file_exists($create_path)){
        mkdir($create_path, 0777, true);
    }

    $location = "/var/www/html/uploads/{$encrypt_path}/";

    if(move_uploaded_file($upfile['tmp_name'], $location . $upfile['name'])){
        echo("<script>alert('Upload OK! Directory -> uploads/$encrypt_path'); history.go(-1); </script>");
    }else{
        die("<script>alert('Failed'); history.go(-1); </script>");
    }

}
?>