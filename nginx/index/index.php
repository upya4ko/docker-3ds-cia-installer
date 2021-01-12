<html>
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
        'à' => 'a',   'á' => 'b',   'â' => 'v',
        'ã' => 'g',   'ä' => 'd',   'å' => 'e',
        '¸' => 'e',   'æ' => 'zh',  'ç' => 'z',
        'è' => 'i',   'é' => 'y',   'ê' => 'k',
        'ë' => 'l',   'ì' => 'm',   'í' => 'n',
        'î' => 'o',   'ï' => 'p',   'ð' => 'r',
        'ñ' => 's',   'ò' => 't',   'ó' => 'u',
        'ô' => 'f',   'õ' => 'h',   'ö' => 'c',
        '÷' => 'ch',  'ø' => 'sh',  'ù' => 'sch',
        'ü' => '\'',  'û' => 'y',   'ú' => '\'',
        'ý' => 'e',   'þ' => 'yu',  'ÿ' => 'ya',
        
        'À' => 'A',   'Á' => 'B',   'Â' => 'V',
        'Ã' => 'G',   'Ä' => 'D',   'Å' => 'E',
        '¨' => 'E',   'Æ' => 'Zh',  'Ç' => 'Z',
        'È' => 'I',   'É' => 'Y',   'Ê' => 'K',
        'Ë' => 'L',   'Ì' => 'M',   'Í' => 'N',
        'Î' => 'O',   'Ï' => 'P',   'Ð' => 'R',
        'Ñ' => 'S',   'Ò' => 'T',   'Ó' => 'U',
        'Ô' => 'F',   'Õ' => 'H',   'Ö' => 'C',
        '×' => 'Ch',  'Ø' => 'Sh',  'Ù' => 'Sch',
        'Ü' => '\'',  'Û' => 'Y',   'Ú' => '\'',
        'Ý' => 'E',   'Þ' => 'Yu',  'ß' => 'Ya',
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
