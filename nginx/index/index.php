﻿<html>
<head>
<title>QR cia install</title>
</head>
<body style="background: linear-gradient(5deg, #005592, #198ada); -moz-background-size: cover; -o-background-size: cover; -webkit-background-size: cover;  background-size: cover;  background-repeat: no-repeat;  background-position: center center;">
<?php
$dir    = 'cia/';
$files1 = scandir($dir);
$files2 = scandir($dir, 1);
$file1=$_SERVER['SERVER_ADDR'];
$patch = "cia/";
$handle = opendir($patch);
function rus2translit($string) {
$converter = array(
        '�' => 'a',   '�' => 'b',   '�' => 'v',
        '�' => 'g',   '�' => 'd',   '�' => 'e',
        '�' => 'e',   '�' => 'zh',  '�' => 'z',
        '�' => 'i',   '�' => 'y',   '�' => 'k',
        '�' => 'l',   '�' => 'm',   '�' => 'n',
        '�' => 'o',   '�' => 'p',   '�' => 'r',
        '�' => 's',   '�' => 't',   '�' => 'u',
        '�' => 'f',   '�' => 'h',   '�' => 'c',
        '�' => 'ch',  '�' => 'sh',  '�' => 'sch',
        '�' => '\'',  '�' => 'y',   '�' => '\'',
        '�' => 'e',   '�' => 'yu',  '�' => 'ya',
        
        '�' => 'A',   '�' => 'B',   '�' => 'V',
        '�' => 'G',   '�' => 'D',   '�' => 'E',
        '�' => 'E',   '�' => 'Zh',  '�' => 'Z',
        '�' => 'I',   '�' => 'Y',   '�' => 'K',
        '�' => 'L',   '�' => 'M',   '�' => 'N',
        '�' => 'O',   '�' => 'P',   '�' => 'R',
        '�' => 'S',   '�' => 'T',   '�' => 'U',
        '�' => 'F',   '�' => 'H',   '�' => 'C',
        '�' => 'Ch',  '�' => 'Sh',  '�' => 'Sch',
        '�' => '\'',  '�' => 'Y',   '�' => '\'',
        '�' => 'E',   '�' => 'Yu',  '�' => 'Ya',
    );
    return strtr($string, $converter);
}
echo "<center>";
echo "<div style=\"position: static;\"><p style=\" font-size: 50px;\">Qr cia install</p></div>";
while (($file = readdir($handle)) !== false)
{
	if ($file != "." && $file != "..")
	{
		if (is_dir($patch.$file) or is_file($patch.$file))
		{
			preg_replace('~[^-a-z0-9A-Z/_]+~u', '_', $temp);
			rename($patch.$file,rus2translit($patch.$file));
			
			
		}
	}
}
closedir($handle);

function recdir($dir, $tab = '') {
    $d = opendir($dir);
    $space = str_repeat('&nbsp;', 4);
    while ($name = readdir($d)) {
        if ($name == '.' || $name == '..' ) continue;
        $temp = $dir . "/" . $name;
        if (is_dir($temp)) {
			rename($temp,preg_replace('~[^-a-z0-9A-Z/_\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]+~u', '', $temp));
			rename($temp,rus2translit($temp));
			$temp=preg_replace('~[^-a-z0-9A-Z/_\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]+~u', '', $temp);
			recdir($temp, $tab . $name . DIRECTORY_SEPARATOR);
			
        } else {
			if (preg_match('/\.cia$/', $temp)) {
            $server=$_SERVER['SERVER_ADDR']. "/";
			//rename($temp,preg_replace('/[\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]/u','_',$temp));
			rename($temp,preg_replace('~[^-a-z0-9A-Z/._\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]+~u', '_', $temp));
			$temp=preg_replace('~[^-a-z0-9A-Z/._\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]+~u', '_', $temp);
			//rename($temp,rus2translit($temp));
			$temp=rus2translit($temp);
            echo "<div class=catalog style=\"display: inline-block; width: 350px; height: 350px; z-index: 8; position: static; word-wrap: break-word; \">";
           echo "<img src=\"http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=$server$temp\">";
           $name=str_replace("_"," ",$name);
           $name=str_replace(".cia","",$name);
		   $name=rus2translit($name);
           $name=preg_replace('~[^-a-z0-9A-Z/._]+~u',' ',$name);
           echo "<center>$name</center>";
            echo "</div>";
			}
		}
    }

    closedir($d);
}
recdir('cia');
?>
</body>
</html>
