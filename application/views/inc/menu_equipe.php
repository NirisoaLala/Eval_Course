<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="index.html" class="site_title"><img src=<?php echo base_url("assets/docs/images/logo.png"); ?> alt="..." class="sary"> <span>TEAM RACE</span></a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					<div class="profile clearfix">
						<div class="profile_pic">
							<img src="<?php echo base_url("assets/docs/images/images.png"); ?>" alt="" class="img-circle profile_img">
						</div>
						<div class="profile_info">
							<span>Welcome,</span>
							<h2><?php echo $_SESSION['equipe']['nom']; ?></h2>
						</div>
					</div>
					<!-- /menu profile quick info -->

					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
					<div class="menu_section">
							<h3>General</h3>
							<ul class="nav side-menu">
								<li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										
									</ul>
								</li>
								<li><a><i class="fa fa-table"></i> Listes <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<!-- <li><a href="<--?php echo site_url('CTL_Etape/'); ?>">Etape</a></li> -->
                                        <li><a href="<?php echo site_url('CTL_Etape/classementEquipe'); ?>">Classement par équipe</a></li>
                                        <li><a href="<?php echo site_url('CTL_Etape/classementEtape'); ?>">Classement par étape</a></li>
										<li><a href="<?php echo site_url('CTL_Etape/coureurEtapeByEquipe'); ?>">Coureur par étape</a></li>
									</ul>
								</li>
                            	
							</ul>
						</div>

					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small">
						<a data-toggle="tooltip" data-placement="top" title="Settings">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="FullScreen">
							<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Lock">
							<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo site_url('CTL_Equipe/deconnexion'); ?>">
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
						</a>
					</div>
					<!-- /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					<nav class="nav navbar-nav">
						<ul class=" navbar-right">
							<li class="nav-item dropdown open" style="padding-left: 15px;">
								<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
									<img src="<?php echo base_url("assets/docs/images/images.png"); ?>" alt=""><?php echo $_SESSION['equipe']['nom']; ?>
								</a>
								<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="<?php echo site_url('CTL_Equipe/deconnexion'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
								</div>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->
