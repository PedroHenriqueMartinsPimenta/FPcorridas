<div class="col-lg-6 col-12">
						<div id="header-top-right" class="text-lg-right text-center">
																						<!-- Start Contact Info -->
								 
									<div class="widget widget_info">
										<a href="mailto:ofabiana884@gmail.com">
											<i class="fa"><img src="<?php echo $url?>layout/layout_files/images/icon_email.png" width="10px"></i>
											<span>ofabiana884@gmail.com</span>
										</a>
									</div>
																
								 
									<div class="widget widget_info">
										<a href="tel:(88) 9 9491-8261">
											<i class="fa"><img src="<?php echo $url?>layout/layout_files/images/icon_telefone.png" width="10px"></i>
											<span>(88) 9 9491-8261</span>
										</a>
									</div>
																<!-- /End Contact Info -->
														
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<div class="navigator-wrapper">
		<!-- Mobile Toggle -->
	    <div class="theme-mobile-nav d-lg-none d-block ">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="theme-mobile-menu">
	                        <div class="headtop-mobi">
	                            <div class="headtop-shift">
	                                <a href="javascript:void(0);" class="header-sidebar-toggle open-toggle"><span></span></a>
	                                <a href="javascript:void(0);" class="header-sidebar-toggle close-button"><span></span></a>
	                                <div id="mob-h-top" class="mobi-head-top animated"><div class="header-widget">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div id="header-top-left" class="text-lg-left text-center">
							<!-- Start Social Media Icons -->
											
															<aside id="social_widget" class="widget widget_social_widget">
									<ul>
																				
																				
																				
																				
																				
																				
																				
																				
																				
																				
																				
																			</ul>
								</aside>
									                	<!-- /End Social Media Icons-->
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div id="header-top-right" class="text-lg-right text-center">
																						<!-- Start Contact Info -->
								 
																<!-- /End Contact Info -->
														
						</div>
					</div>
				</div>
			</div>
		</div></div>
	                            </div>
	                        </div>
	                        <div class="mobile-logo">
	                            <a href="#" class="navbar-brand">
	                                </a><a href="#" class="custom-logo-link" rel="home"><img src="<?php echo $url?>layout/layout_files/cropped-cropped-FP-removebg-preview-2.png" class="custom-logo navbar-brand" alt="FP Corridas" srcset="<?php echo $url?>layout/layout_files/cropped-cropped-FP-removebg-preview-2.png"></a>	                                	                                        <p class="site-description">Corridas online e parceiras</p>
	                                	                            
	                        </div>
	                        <div class="menu-toggle-wrap">
	                            <div class="hamburger-menu">
	                                <a href="javascript:void(0);" class="menu-toggle">
	                                    <div class="top-bun"></div>
	                                    <div class="meat"></div>
	                                    <div class="bottom-bun"></div>
	                                </a>
	                            </div>
	                        </div>
	                        <div id="mobile-m" class="mobile-menu">
	                            <div class="mobile-menu-shift">
	                                <a href="javascript:void(0);" class="close-style close-menu"></a>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- / -->
	    <!-- Top Menu -->
	    <div class="xl-nav-area d-none d-lg-block">
	        <div class="navigation ">
	            <div class="container">
	                <div class="row">
	                    <div class="col-md-3 my-auto">
	                    	<div class="logo">
	                            <a href="#" class="custom-logo-link" rel="home"><img width="450" src="<?php echo $url?>layout/layout_files/cropped-cropped-FP-removebg-preview-2.png" class="" alt="FP Corridas" srcset="<?php echo $url?>layout/layout_files/cropped-cropped-FP-removebg-preview-2.png"></a>		                            <p class="site-description">Corridas online e parceiras</p>
		                        	                        </div>
	                    </div>
	                    <div class="col-md-9 my-auto position-lg-relative position-static">
	                    	<!-- Header Widget Info -->
							<div class="header-widget-info d-none d-lg-block">
						        <div class="header-wrapper">
						            <div class="header-right header-center">
						                <div class="header-info">
						                							                    <div class="header-single-widget">
						                        <div class="menu-right">
						                            <ul class="wrap-right">
						                                						                            </ul>
						                        </div>
						                    </div>
						                </div>
						            </div>
						        </div>
							</div>
							<!-- / -->
	                        <div class="theme-menu">
	                            <nav class="menubar">
	                                <ul id="menu-menu" class="menu-wrap menu-principal">
	                                	<li id="menu-item-17" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-17 index" id="index"><a href="<?php echo $url?>">Corridas</a></li>
	                                	<li id="menu-item-17" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-17 index" id="index"><a href="<?php echo $url?>resultado.php">Resultados</a></li>

	                                	<li id="menu-item-17" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-17 index" id="index"><a href="<?php echo $url?>">Parceiros</a></li>
	                                	<li id="menu-item-17" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-17 index" id="index"><a href="<?php echo $url?>">Sobre nós</a></li>
										
	                                	<?php
											if(isset($_SESSION['user'])){
												?>
												<li id="menu-item-23" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-16 current_page_item menu-item-has-children menu-item-23 dropdown userindex"><a href="#">Área atleta</a><span class="mobi_drop d-lg-none"><a href="#" class="fa"><img src="<?php echo $url?>layout/layout_files/images/icon_seta2.png" width="10px"></a></span>
												<ul class="dropdown-menu">
													<li id="menu-item-51" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-51"><a href="<?php echo $url?>user">Painel</a></li>
													<li id="menu-item-51" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-51"><a href="<?php echo $url?>user/minhas_corridas.php">Minhas corridas</a></li>
													<li id="menu-item-51" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-51"><a href="<?php echo $url?>">Chat</a></li>
													<li id="menu-item-51" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-51"><a href="<?php echo $url?>">Meus dados</a></li>
													<li id="menu-item-51" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-51"><a href="<?php echo $url?>">Minha página</a></li>
													<li id="menu-item-51" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-51"><a href="<?php echo $url?>">$ Carteira</a></li>
												</ul>
												</li>
												
												<?php
												if ($_SESSION['user']['permissao'] == 1) {
													?>
													<li id="menu-item-23" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-16 current_page_item menu-item-has-children menu-item-23 dropdown corridas"><a href="#">Gerenciar</a><span class="mobi_drop d-lg-none"><a href="#" class="fa"><img src="<?php echo $url?>layout/layout_files/images/icon_seta2.png" width="10px"></a></span>
												<ul class="dropdown-menu">
													<li id="menu-item-51" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-51"><a href="<?php echo $url?>user/admin/corridas.php">Eventos</a></li>
													<li id="menu-item-51" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-51"><a href="<?php echo $url?>user/admin/parceiros.php">Patrocionadores</a></li>
													<li id="menu-item-51" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-51"><a href="<?php echo $url?>user/admin/brinde.php">Brindes</a></li>
													<li id="menu-item-51" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-51"><a href="<?php echo $url?>user/admin/inscritos.php">Inscrições</a></li>
												</ul>
												</li>
													<?php
												}
												?>

												<li id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-14 current_page_item menu-item-21"><a href="<?php echo $url?>controller/sair.php" class="sair">Sair</a></li>

												<?php
											}else{
										?>
										<li id="menu-item-23" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-23 login"><a href="<?php echo $url?>login.php">Login</a></li>

										<li id="menu-item-22" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22 cadastro" id="cadastro"><a href="<?php echo $url?>cadastro.php">Cadastre-se</a></li>
										<?php
											}
										?>
									</ul>                               
	                            </nav>
								<div class="menu-right">
									<ul class="wrap-right">
										<li class="search-button">
	                                        <a href="#" id="view-search-btn" class="header-search-toggle"><i class="fa"><img src="<?php echo $url?>layout/layout_files/images/icon_pesquisa.png" style="max-width:20px"></i></a>
	                                        <!-- Quik search -->
	                                        <div class="view-search-btn header-search-popup">
	                                            <form method="get" class="search-form" action="https://fpcorridas.000webhostapp.com/MVP_06082022/" aria-label=" Pesquisa do site">
	                                                <span class="screen-reader-text">Pesquisar por:</span>
	                                                <input type="search" class="search-field header-search-field" placeholder="Digite para pesquisar" name="s" id="popfocus" value="" autofocus="">
	                                                <a href="#" class="close-style header-search-close"></a>
	                                            </form>
	                                        </div>
	                                        <!-- / -->
	                                    </li>
																			</ul>						
								</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</header>
<section class="breadcrumb shadow-one">
    <div class="background-overlay">
        <div class="container">
            <div class="row padding-top-40 padding-bottom-40">
                <div class="col-md-6 col-xs-12 col-sm-6">
                     <h2>
						<?php echo $titulo?>					</h2>
                </div>

                <div class="col-md-6 col-xs-12 col-sm-6 breadcrumb-position">
					<ul class="page-breadcrumb">
						<li><a href="#">FP Corridas</a> &nbsp; / &nbsp;</li><li class="active"><?php echo $titulo?></li>                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="clearfix"></div>
<div id="content" class="site-content" role="main">
<section class="page-wrapper">
	<div class="container">
					
		<div class="row padding-top-60 padding-bottom-60">		
			<div class="col-md-12">			<div class="site-content">
			
			
<div id="comments" class="comments-area">