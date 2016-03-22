<?php
ob_start("ob_gzhandler");

# SESSION -----------------
session_start();
$home=true;

# CREATE INSTALED FILE IF NOT EXIST -----------------
if(!file_exists("installed.php")){
   $fp = fopen("installed.php","w"); 
   fclose($fp);
}

# INSTALED -----------------
require_once('installed.php');

# CHECK IF ONCE INSTALED -------------------
if(isset($_CONFIG['datahost']) && $_CONFIG['datahost']!=''){
	// valid hostname / ip address
	if (filter_var(gethostbyname($_CONFIG['datahost']), FILTER_VALIDATE_IP)) {
		if(isset($_CONFIG['datauser']) && $_CONFIG['datauser']!=''){
			if(isset($_CONFIG['database']) && $_CONFIG['database']!=''){
				try{
					$pdo = new PDO('mysql:host='.$_CONFIG['datahost'].';dbname='.$_CONFIG['database'].'', $_CONFIG['datauser'], $_CONFIG['datapass'], array(
						PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
					));
					//PDO::ATTR_PERSISTENT => true, 
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

				}catch (Exception $e){
					if($e->getCode()==2002){
						echo 'NO RESPONSE FROM HOST';
						echo '<p>simple reinstall by delete installed.php <a href="doc/reinstall">read doc<a></p>';
					}
					if($e->getCode()==1045){
						echo 'ACCESS DENIED FOR USER';
						echo '<p>simple reinstall by delete installed.php <a href="doc/reinstall">read doc<a></p>';
					}
					if($e->getCode()==1049){
						echo 'DATABASE NOT EXISTS';
						echo '<p>simple reinstall by delete installed.php <a href="doc/reinstall">read doc<a></p>';
					}
					exit;
				}
			}else{
				echo 'DB CANT BE EMPTY';
				echo '<p>simple reinstall by delete installed.php <a href="doc/reinstall">read doc<a></p>';
				exit;
			}
		}else{
			echo 'USER CANT BE EMPTY';
			echo '<p>simple reinstall by delete installed.php <a href="doc/reinstall">read doc<a></p>';
			exit;
		}
	}else{
		echo 'HOST IS NOT VALID';
		echo '<p>simple reinstall by delete installed.php <a href="doc/reinstall">read doc<a></p>';
		exit;
	}
}else{
	require_once('./installer.php');
	exit;
}

# CLASS -------------------
//require_once('./class/core.class.php');
//$once=new core($_CONFIG);

# PAGE START -------------------
?>
<!DOCTYPE html>
<html class="bg-blue">
    <head>
        <meta charset="UTF-8">
        <title>Once CMS | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="libs/AdminLTE/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-blue">

        <div class="form-box" id="login-box">
            <a href="installer.php">
				<div class="header">Once CMS</div>
			</a>
            <form action="installer.php" method="post">
                <div class="body bg-gray">
					<p class="text-center"><b>OnceBuilder has been installed.</b></br> See <a href="installed.php">installed.php</a></p>
                </div>
            </form>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>