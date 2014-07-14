<!doctype html>
<html>
<head>
  <title>PHP directory</title>
  <style type="text/css">
  body {
      position:relative;
      background-color: #FFFFFF;
      font-family:"微软雅黑", Verdana;
      font-size: 10pt;
      text-align: left;
      margin: 0px;
      padding: 0px;
  }

  .mainblock {
      padding:50px;
      margin:35px;
      line-height:23px;
      border : solid 1px #DDDDDD;
      background-color: #F5F5F5;
      width:798px;
      text-align:left;
  }

  a {
      color: #014579;
      font-weight: bold;
      text-decoration: none;
  }

  </style>

</head>
<body>
  <center>

    <div class="mainblock">
<?php
$UWAMPFOLDER=realpath('./') . '/';
$path = @trim($_GET['p'], '/') . '/';
@$handle=opendir($UWAMPFOLDER.$path);
$count=0;
$list = array('seq' => array(),'dir' => array(), 'file' => array());

if ($path != '/') {
    $count++;
    $_path = ltrim(dirname(trim($path, '/')), '.');
    $list['seq'][] =  "<li><a class=\"afolder\" href=\"?p=$_path\">..</a></li>";
}

while ( $file = readdir($handle) ) {
    if ( $file=='.' || $file =='..' ) continue;
    $cur = $UWAMPFOLDER . $path . $file;
    if ( is_dir($UWAMPFOLDER . $path . $file) ) {
        $count++;
        $list['dir'][] = "<li><a href=\"?p=$path$file/\">[directory] $file</a></li>";
    } else {
        $count++;
        if ( ($file == 'index.php' && !@$_GET['p']) ||
             $file == 'desktop.ini' || $file == '.dropbox' ) {
        } else {
            $list['file'][] = "<li><a class=\"\" href=\"$path$file\">$file</a></li>";
        }
    }
}
closedir($handle);
if ( $count == 0 ) {
    printf('No files');
} else {
    foreach ($list as $k => $v) {
        printf(join('',$v));
    }
}
?>
    </div>
  </center>
</body>
</html>
