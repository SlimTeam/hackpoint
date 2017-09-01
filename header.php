<?php 
require_once __DIR__.DIRECTORY_SEPARATOR.'common.php';


Plugin::addHook("page", function(){
	global $_;
	if(isset($_['module'])) return;
	require_once('dashboard.php');
}); 

Plugin::addHook("menu_main", function(&$menuItems){
	global $_,$myUser;
	$menuItems[] = array(
	'sort'=>0,
	'url'=>'index.php',
	'label'=>'Sketch',
	'icon'=>'codepen'
	);

	if (! $myUser->connected()) return;
	$menuItems[] = array(
	'sort'=>1,
	'url'=>'component.php',
	'label'=>'Composants',
	'icon'=>'codepen'
	);
}); 


?>
<!doctype html>
<html class="no-js" lang="">
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php echo PROGRAM_NAME.' V'.SOURCE_VERSION.'.'.BASE_VERSION ?></title>
		<link rel="icon" type="image/png" href="img/favicon.png">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/bootflat.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/codemirror.css">
		<link rel="stylesheet" href="css/monokai.css">
		<link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div id="wrap">
    


		<!-- menu -->
		<nav role="navigation" class="navbar navbar-inverse">
                  <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button data-target="#bs-example-navbar-collapse-5" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a href="index.php" class="navbar-brand">Hackpoint</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    
					
					<div id="bs-example-navbar-collapse-5" class="collapse navbar-collapse">
                      <ul class="nav navbar-nav">
                       

						<?php 
						$menuItems = array();
						Plugin::callHook("menu_main",array(&$menuItems)); 
						
						usort($menuItems, function($a, $b){
							if ($a['sort'] == $b['sort']) {
						        return 0;
						    }
						    return ($a['sort'] < $b['sort']) ? -1 : 1;
						});

						foreach($menuItems as $item):
						?>
						<li <?php echo $page==$item['url']?'class="active"':''; ?>><a href="<?php echo $item['url'];?>"><?php echo $item['label'];?></a></li>
						<?php endforeach; ?>
                      </ul>
                      <ul class="nav navbar-nav navbar-right">
					  
						<?php if (!$myUser->connected()): ?>
						<li>
							<form id="loginForm" method="post" action="action.php?action=login" class="navbar-form navbar-right">
								Identifiant : 
								<input name="login" placeholder="Identifiant" class="form-control" type="text">
								Mot de passe : 
								<input name="password" placeholder="Mot de passe" class="form-control" type="password">
								<input class="btn btn-success" value="Connexion" type="submit">
							</form>
						</li>
						<?php else: ?>
                        <li class="dropdown <?php echo $page=='account.php'?'active':''; ?>" >
                          <a data-toggle="dropdown" class="dropdown-toggle" href="#"> Connecté en tant que <?php echo $myUser->login; ?> <b class="caret"></b></a>
                          <ul role="menu" class="dropdown-menu">
                            <li class="dropdown-header">Préférences</li>
                            <li ><a href="plugin.php">Plugins</a></li>
                            <li ><a href="account.php">Profil</a></li>
                            
                            <li class="divider"></li>
                            <?php 
						$menuItems = array();
						Plugin::callHook("menu_setting",array(&$menuItems)); 
						
						usort($menuItems, function($a, $b){
							if ($a['sort'] == $b['sort']) {
						        return 0;
						    }
						    return ($a['sort'] < $b['sort']) ? -1 : 1;
						});

						foreach($menuItems as $item): ?>
								<li><a href="<?php echo $item['url'];?>"><?php echo $item['label'];?></a></li>
							<?php endforeach;?>

                            <li><a href="action.php?action=logout">Déconnexion</a></li>
                          </ul>
                        </li>
						<?php endif; ?>
                      </ul>
					 

            

					           <!--<button class="btn btn-danger navbar-btn" onclick="window.location='action.php?action=logout';" type="button">MAJ</button>-->
					  
                    </div><!-- /.navbar-collapse -->
					
					
					
                  </div><!-- /.container-fluid -->
                </nav>
		<!-- menu -->
		

		
		<!-- body -->
		<div class="container-fluid">
		
		
		<!-- messages -->
			<?php if (isset($_SESSION['error'])): ?>
			<div class="alert alert-danger">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
              <strong>Oops!</strong> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
			<?php endif; ?>
			<?php if (isset($_SESSION['success'])): ?>
			<div class="alert alert-success alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
              <strong>Succès !</strong> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
			<?php endif; ?>
			<!-- messages -->
