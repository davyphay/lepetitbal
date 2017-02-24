<html lang="fr">
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Toutes les informations des cours, soirées, stages et festivals dansants proches réunis sur une carte interactive.">
		<meta property="fb:app_id" content="1239116092768343">
		<meta property="og:title" content="lepetitbal, l'actualité locale de la danse en 3 clics">
		<meta property="og:type" content="website">
		<meta property="og:description" content="Trouve ta soirée ou ton cours de danse près de chez toi.">
		<meta property="og:url" content="https://www.lepetitbal.com/">
		<meta property="og:image" content="https://www.lepetitbal.com/ressources/images/website/photo_lpb_facebook_og3.jpg">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link href="https://www.lepetitbal.com/ressources/images/website/favicon.ico?" rel="icon" type="image/x-icon">
		<!--[if IE]>
		<link href="https://www.lepetitbal.com/ressources/images/website/favicon.ico?" rel="shortcut icon" type="image/x-icon">
		<![endif]-->
		<link href="//fonts.googleapis.com/css?family=Droid+Sans:400,700%7CNoto+Serif:400,700" rel="stylesheet" type="text/css">
		<link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
		<link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
		<link href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" rel="stylesheet">		
		<link href="/ressources/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="/ressources/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="/ressources/css/style.css" rel="stylesheet" type="text/css">
		<link href="/ressources/css/bootstrap-social.css" rel="stylesheet" type="text/css">	
		<link href="/ressources/controleur/js/alertify/css/alertify.css" rel="stylesheet">
		<link href="/ressources/controleur/js/alertify/css/themes/bootstrap.css" rel="stylesheet">
		<link href="/ressources/css/please-wait.css" rel="stylesheet">
		<link href="/ressources/css/spinkit.css" rel="stylesheet">
		<!-- Facebook Pixel Code -->
			<script>
			!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
			n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
			document,'script','https://connect.facebook.net/en_US/fbevents.js');
			fbq('init', '1814282678828555');
			fbq('track', 'PageView');
			</script>
			<noscript><img height="1" width="1" style="display:none"
			src="https://www.facebook.com/tr?id=1814282678828555&ev=PageView&noscript=1"
			/></noscript>
		<!-- End Facebook Pixel Code -->
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        <title>lepetitbal, l'actualité locale de la danse en 3 clics</title>
    </head>

    <body class="background-cover">	
		<header>
            <div id="header_left">
				<div id="espace_titre" class="noselect" title="Retour à la page d'accueil" onclick="document.location.href='/'">
					<div class="zone-main-logo"><img src="../ressources/images/website/lepetitbal-logo.png" alt="lepetitbal logo" class="logo-loupe"></div>
					<h1 id="titre_principal">lepetitbal</h1>
				</div>
			</div>
			<div id="header_right">
				<?php if (!empty($email_membre)): ?>
					<div id="espace_membre">
						<div id="membre">Bonjour
							<?php echo $pseudo_membre;?>
						</div>
						<input type='hidden' class='email_membre_input' value="<?php echo $email_membre ;?>"/>
						<input type='hidden' value="<?php echo $membre_statut ;?>"/>
						<input type='hidden' value="<?php echo $admin ;?>"/>
					</div>
				<?php endif ?>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle btn-menu" type="button" data-toggle="dropdown"><i class="glyphicon glyphicon-menu-hamburger"></i> Menu</button>
					<ul class="dropdown-menu">					
					<?php if (empty($email_membre)){ ?>
						<input type='hidden' class='email_membre_input' value="<?php echo $email_membre ;?>"/>
						<li class="dropdown-header">Espace Membre</li>
						<li class="espace_bouton_membre">
							<input type="hidden" id="sess_var" value="no"/>
							<a href="javascript:;" data-toggle="modal" data-target="#loginModal" id="menu_connexion"><i class="fa fa-sign-in"></i> Connexion</a>
						</li>
						<li class="espace_bouton_membre">
							<a href="javascript:;" data-toggle="modal" data-target="#loginModal" id="menu_inscription"><i class="fa fa-user-plus"></i> Inscription</a>
						</li>
						<li class="divider"></li>
						<li class="espace_bouton_membre">
							<a href="javascript:;" data-toggle="modal" data-target="#annonceurModal" id="menu_nouvel_annonceur"><i class="fa fa-bullhorn"></i> Nouvel Annonceur</a>
						</li>	
					<?php }else{ ?>
						<?php if($membre_statut=="Membre"){ ?>
							<li class="dropdown-header">Espace Membre</li>
							<li class="espace_bouton_membre">
								<input type="hidden" id="sess_var" value="yes"/>
								<a href="javascript:;" data-toggle="modal" data-target="#espaceMembreModal" id="menu_mon_compte"><i class="fa fa-user"></i> Mon compte</a>
							</li>
							<li class="espace_bouton_membre">
								<a href="javascript:;" data-toggle="modal" data-target="#espaceMembreModal" id="menu_devenir_annonceur"><i class="fa fa-bullhorn"></i> Devenir annonceur</a>
							</li>
							<li class="divider"></li>
							<li>
								<a style="cursor:pointer;color:#d2201b;" onclick="document.location.href='../ressources/controleur/action/logout.php'">
									<i class="fa fa-sign-out"></i> Déconnexion
								</a>
							</li>
						<?php }else{ ?>
							<li class="dropdown-header">Espace Annonceur</li>
							<li class="espace_bouton_membre">
							<input type="hidden" id="sess_var" value="yes"/>
								<a href="javascript:;" data-toggle="modal" data-target="#espaceMembreModal" id="menu_mon_compte_<?php if($admin!==1){echo "annonceur";}else echo "admin";?>">Mon compte</a>
							</li>
							<li class="espace_bouton_membre">
								<a href="javascript:;" data-toggle="modal" data-target="#espaceMembreModal" id="menu_gerer_jeton_<?php if($admin!==1){echo "annonceur";}else echo "admin";?>">Gérer mes jetons</a>
							</li>
							<li class="espace_bouton_membre">
								<a href="javascript:;" data-toggle="modal" data-target="#espaceMembreModal" id="menu_ajout_event_<?php if($admin!==1){echo "annonceur";}else echo "admin";?>">Ajouter un évènement</a>
							</li>
							<li class="divider"></li>
							<li class="espace_bouton_membre">
								<a href="javascript:;" data-toggle="modal" data-target="#annonceurModal" id="menu_aide_annonceur">Aide Annonceur</a>
							</li>
							<?php if($admin==1){ ?>
								<li class="divider"></li>
								<li class="dropdown-header">Espace Admin</li>
								<li class="espace_bouton_membre">
									<a href="javascript:;" data-toggle="modal" data-target="#espaceMembreModal" id="menu_ajout_lieu_admin">Ajouter un lieu</a>
								</li>
								<li class="espace_bouton_membre">
									<a href="javascript:;" data-toggle="modal" data-target="#espaceMembreModal" id="menu_affection_proprio_admin">Affecter un propriétaire</a>
								</li>
								<li class="espace_bouton_membre">
									<a href="javascript:;" data-toggle="modal" data-target="#espaceMembreModal" id="menu_credit_membre_admin">Créditer un membre</a>
								</li>
							<?php } ?>
							<li class="divider"></li>
							<li>
								<a style="cursor:pointer;color:#d2201b;" onclick="document.location.href='../ressources/controleur/action/logout.php'">
									<i class="fa fa-sign-out"></i> Déconnexion
								</a>
							</li>
						<?php } ?>
					<?php } ?>
					</ul>
				</div>
			</div>
		</header>
		<div class="body-modifier">
			<div class="modal-dialog">
				<div class="modal-content login-modal modal-content-accueil">
					<h2 class="modal-title text-center" id="loginModalLabel-accueil">L'actualité locale de la danse en 3 clics</h2>
					<div class="modal-body modal-body-accueil">
						<div class="text-center">
							<div role="tabpanel" class="login-tab">
								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane text-center active" id="rechercherLieu">
										<div class="clearfix"></div> 
										<form id="form_rechercher_lieu" action="/soirees-et-evenements-dansants/" method="post" class="col s12">
											<div class="form-group switch-field noselect">
												<div class="switch-title">1</div>
												<input type="radio" id="switch_left" name="switch_2" value="calendrier" onclick="document.getElementById('form_rechercher_lieu').action='/soirees-et-evenements-dansants/';" checked/>
												<label for="switch_left">Soirées - Stages - Festivals</label>
												<input type="radio" id="switch_right" name="switch_2" onclick="document.getElementById('form_rechercher_lieu').action='/cours-de-danse/';" value="cours"/>
												<label for="switch_right">Cours de danse</label>
											</div>
											<div class="form-group main-number">
												<div class="switch-title">2</div>
												<div class="input-group input-group-main">
													<div class="input-group-addon"><img src="../ressources/images/website/icon-danse-transparent.png" alt="icon danse transparent" style="width:16px;height:16px;"></div>
													<dl class="dropdown2 form-control"> 
														<dt>
															<a href="#">
															  <span class="hida">Sélectionne ton style de danse</span>    
															  <p class="multiSel"></p>
															  <i class="fa fa-caret-down caret-menu-principal" aria-hidden="true"></i>
															</a>
														</dt>
														<dd>
															<div class="mutliSelect">
																<ul>
																	<label>Afro-Latines</label>
																	<li>
																		<input type="checkbox" name="style[]" value="Salsa" />Salsa Cubaine & Portoricaine</li>
																	<li>
																		<input type="checkbox" name="style[]" value="Bachata" />Bachata</li>
																	<li>
																		<input type="checkbox" name="style[]" value="Kizomba" />Kizomba</li>
																	<label>Rock-Swing</label>
																	<li>
																		<input type="checkbox" name="style[]" value="Rock 4T" />Rock 4T-Moderne</li>
																	<li>
																		<input type="checkbox" name="style[]" value="Rock 6T" />Rock 6T</li>
																	<li>
																		<input type="checkbox" name="style[]" value="Swing" />Swing</li>
																	<li>
																		<input type="checkbox" name="style[]" value="WCS" />West Coast Swing</li>
																	<label>Danses de Salon</label>
																	<li>
																		<input type="checkbox" name="style[]" value="Tango Argentin" />Tango Argentin</li>
																	<li>
																		<input type="checkbox" name="style[]" value="Salon" />Danses de Salon</li>
																	<div class="zone-bouton-ok">
																		<div class="bouton-ok noselect">Valider</div>
																	</div>
																</ul>
															</div>
														</dd>
													</dl>
												</div>
											</div>
											
											<div class="form-group main-number">
												<div class="switch-title">3</div>
												<div class="input-group input-group-main">
													<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
													<input type="text" class="form-control" name="adresse_rechercher_lieu" id="adresse_rechercher_lieu" placeholder="Entre un lieu ou géolocalise-toi en cliquant à droite">
													<span id="geolocator" class="form-control-clear fa fa-crosshairs form-control-feedback font-18" title="Géolocalisez-moi!"></span>
													<input type="text" name="gps_rechercher_lieu" value="" hidden />
												</div>
												<span class="help-block has-error" id="addresse_lieu-error-connexion"></span>
											</div>
	
											<div id="bouton">
												<div id="btn_rechercher_lieu" class="btn btn-block btn-accueil">
													<img src="../ressources/images/website/lepetitbal-logo.png" alt="lepetitbal logo" class="logo-loupe-recherche">
													Rechercher
												</div>
											</div>
										</form>
									</div>   
								</div>
							</div>
						</div>
					</div>
					<h3 class="modal-title text-center" id="loginModalLabel-accueil3">Villes Disponibles : Grenoble</>
					<h3 class="modal-title text-center" id="loginModalLabel-accueil4"> <font size="4">Salsa</font> - Bachata - <font size="3">Kizomba</font> - <font size="4">Rock</font> - <font size="2">Swing</font>  - West Coast Swing - <font size="3">Tango Argentin</font> - Salon</>
				</div>
			</div>
			<div id="zone-maj" style="display:none">
			</div>
		</div>
		
        <div id="footer">
			<div id="footer_left">
				<div id="CGU">
					<div id="boutonCGU" onclick="document.location.href='/CGU';">
						Mentions Légales/CGU
					</div>
				</div>
			</div>
			<div id="footer_right">
				<div id="FAQ">
					<div id="boutonFAQ" onclick="document.location.href='/FAQ';">
						Aide/FAQ
					</div>
				</div>				
				<div class="contact">
					<a class="link_contact" href="http://www.facebook.com/lepetitbal" target="_blank" title="Nous suivre sur Facebook">
						<div id="boutonContact_facebook">
							<i class="fa fa-facebook"></i>
						</div>
					</a>
				</div>
				<div class="contact">
					<a class="link_contact" href="https://twitter.com/lepetitbal" target="_blank" title="Nous suivre sur Twitter">
						<div id="boutonContact_twitter">
							<i class="fa fa-twitter"></i>
						</div>
					</a>
				</div>
				<div class="contact">
					<a href="mailto:contact@lepetitbal.com" title="Nous contacter par mail">
						<div id="boutonContact_mail">
							<i class="fa fa-envelope"></i>
						</div>
					</a>
				</div>				
				<div id="donate">
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="YH3687PDAKQKA">
						<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_donate_SM.gif" alt="paypal donate logo" name="submit" title="Aider la communauté !">
					</form>
				</div>
			</div>
		</div>
		<!-- Annonceur FAQ Modal -->
        <div class="modal fade" id="annonceurModal" tabindex="-1" role="dialog" aria-labelledby="annonceurModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content login-modal">
                    <div class="modal-header login-modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center" id="annonceurModalLabel"><?php if($membre_statut!=="Annonceur"){echo "Devenir Annonceur";}else{echo "Aide Annonceur";}?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
							<?php if($membre_statut!=="Annonceur"){ ?>
								<div id="devenir" class="tab-content" style="text-align:left">
									<img src="/ressources/images/website/presentation_devenir_annonceur.png" alt="devenir_annonceur" style="max-width:100%;">
								</div>
							<?php }else{?>
								<div role="tabpanel" class="login-tab">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon">Comment <i class="fa fa-question" aria-hidden="true"></i></div>
											<select name="guide_annonceur" id="faq_annonceur" class="form-control">
												<option value="modifier_evenement" selected>Modifier les informations de mon activité</option>
												<option value="poser">Ajouter un évènement</option>
											</select>
										</div>
									</div>
								</div>
								<div id="modifier_evenement" class="tab-content" style="text-align:left">
									1) Connectez-vous.</br>
									2) Dans le menu, cliquez sur "Mon compte" et cliquez sur "Modifier" à coté du nom de votre lieu.</br>
									3) Modifiez vos informations.</br>
									4) Félicitations, les informations sont mis à jour instantanément.</br>
								</div>
								<div id="poser" class="tab-content hidden" style="text-align:left">
									1) Connectez-vous.</br>
									2) Dans le menu, cliquez sur "Ajouter un évènement" et remplissez le formulaire.</br>
									3) Félicitations, votre évènement est visible par tous.</br>
								</div>
							<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>		
		<!-- -Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content login-modal">
                    <div class="modal-header login-modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center" id="loginModalLabel">Espace Membre</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div role="tabpanel" class="login-tab">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" id="tab_connexion" class="active"><a id="signin-taba" href="#home" aria-controls="home" role="tab" data-toggle="tab">Se connecter</a></li>
                                    <li role="presentation" id="tab_inscription"><a id="signup-taba" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">S'inscrire</a></li>
                                    <li role="presentation" id="tab_mdp_oublie"><a id="forgetpass-taba" href="#forget_password" aria-controls="forget_password" role="tab" data-toggle="tab">Pseudo ou MdP oublié?</a></li>
                                </ul>
                                <!-- Tab panes -->
								<div class="margintop10"></div>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active text-center" id="home">
                                        <div class="clearfix"></div>
                                        <form id="form_connexion" action="/ressources/controleur/action/login.php" method="post">
                                            <div class="form-group">
												<label for="login_username">Pseudo</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                    <input type="text" class="form-control" name="pseudo" id="login_username" placeholder="Pseudo" required>
                                                </div>
                                                <span class="help-block has-error" id="username-error-connexion"></span>
                                            </div>
                                            <div class="form-group">
												<label for="password">Mot de passe</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                                    <input type="password" class="form-control" name="password_membre" id="password" placeholder="Mot de passe" required>
                                                </div>
                                                <span class="help-block has-error" id="password-error-connexion"></span>
                                            </div>
                                            <button type="submit" id="login_btn" class="btn btn-block bt-login" data-loading-text="Signing In...." onclick="submit()"><i class="fa fa-sign-in white"></i> Connexion</button>
                                            <div class="clearfix"></div>
                                            <!-- BOUTONS SOCIAUX -->
                                            <div class="margintop10"></div>
                                            <div class="btn-block">- OU -</div>
                                            <div class="margintop10"></div>
                                            <a class="btn btn-block btn-social btn-facebook" onclick="window.location.href='<?php if (isset($loginUrl))echo htmlspecialchars($loginUrl);?>'">
                                                <span class="fa fa-facebook"></span>
                                                <span>Se Connecter avec Facebook</span>
                                            </a>
                                            <a class="btn btn-block btn-social btn-google" onclick="window.location.href='<?php if (isset($authUrl))echo htmlspecialchars($authUrl);?>'"> 
                                                <span class="fa fa-google"></span>
                                                <span>Se Connecter avec Google+</span>
                                            </a>
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="profile">
                                        <span id="registration_fail" class="response_error" style="display: none;">L'inscription a échoué, veuillez réessayer.</span>
                                        <div class="clearfix"></div>
                                        <form id="form_inscription" action="/ressources/controleur/action/inscription_membre.php" method="post" onsubmit="return verifForm(this);">
											<input style="display:none">
											<input type="password" style="display:none">
                                            <div id="form-group-username" class="form-group">
												<input type="hidden" id="pseudo_inscription_control" value="0">
												<label for="username">Pseudo</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                    <input type="text" class="form-control" name="pseudo" id="username" placeholder="Choisissez votre pseudo" required>
                                                </div>
                                                <span class="help-block has-error" data-error='0' id="username-error-inscription"></span>
                                            </div>
                                            <div id="form-group-email" class="form-group">
												<input type="hidden" id="email_inscription_control" value="0">
												<label for="email">Adresse email</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-at"></i></div>
                                                    <input type="text" class="form-control" name="email" id="email" placeholder="Indiquez votre adresse email" required>
                                                </div>
                                                <span class="help-block has-error" data-error='0' id="email-error-inscription"></span>
                                            </div>
                                            <div id="form-group-password_membre" class="form-group">
												<label for="password_membre">Mot de passe</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                                    <input type="password" class="form-control" name="password_membre" id="password_membre" placeholder="Choississez un mot de passe" required>
                                                </div>
                                            </div>
                                            <div id="form-group-password_control" class="form-group">
												<label for="password_membre">Confirmation du mot de passe</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                                    <input type="password" class="form-control" name="password_control" id="password_control" placeholder="Confirmez votre mot de passe" required>
                                                </div>
                                                <span class="help-block has-error" id="password-error-inscription"></span>
                                            </div>
                                            <span class="help-block has-error" id="finalcheck-inscription"></span>
                                            <button type="submit" id="register_btn" class="btn btn-block bt-login"><i class="fa fa-user-plus white" aria-hidden="true"></i> Inscription</button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane text-center" id="forget_password">
                                        <div class="clearfix"></div>
                                        <form id="form_mdp_perdu" action="/ressources/controleur/action/envoi_lien_mdp_oublie.php" method="post" onsubmit="return verifForm_mdp_recup(this);">
											<input type="hidden" id="email_mdp_recup_control" value="0">
                                            <div id="form-mdp-recuperation" class="form-group">
												<label for="email_lien_mdp">Adresse email</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-at"></i></div>
                                                    <input type="text" class="form-control" name="email_lien_mdp" id="email_lien_mdp" placeholder="Indiquez votre adresse email" required>
                                                </div>
                                                <span class="help-block has-error" data-error='0' id="email-error-recuperation"></span>
                                            </div>
											<span class="help-block has-error" id="finalcheck-recup_mdp"></span>
                                            <button type="submit" id="reset_btn" class="btn btn-block bt-login">Récupération du Pseudo ou du MdP</button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Espace Membre Modal -->
        <div class="modal fade" id="espaceMembreModal" tabindex="-1" role="dialog" aria-labelledby="membreModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content login-modal">
                    <div class="modal-header login-modal-header_membre">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="membreModalLabel"><?php if($membre_statut!=="Annonceur"){ echo ("Espace Membre");}else{ if($admin!==1){echo "Espace Annonceur";}else {echo "Espace Administrateur";}}?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div role="tabpanel" class="login-tab_membre">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
									<li role="presentation" id="tab_mon_compte" class="active"><a id="mon_compte-taba" href="#mon_compte" aria-controls="mon_compte" role="tab" data-toggle="tab">Mon compte</a></li>
									<?php if($membre_statut=="Membre"){ ?>
										<li role="presentation" id="tab_devenir_annonceur" class=""><a id="devenir_annonceur-taba" href="#devenir_annonceur" aria-controls="devenir_annonceur" role="tab" data-toggle="tab">Devenir annonceur</a></li>
									<?php }?>
									<?php if($membre_statut!=="Membre"){ ?>
										<li role="presentation" id="tab_achat_jeton"><a id="achat_jeton-taba" href="#achat_jeton" aria-controls="achat_jeton" role="tab" data-toggle="tab">Gérer mes jetons</a></li>
										<li role="presentation" id="tab_ajout_event"><a id="ajout_event-taba" href="#ajout_event" aria-controls="ajout_event" role="tab" data-toggle="tab">Ajouter un évènement</a></li>
										<?php if($admin==1){ ?>
											<li role="presentation" id="tab_ajouter_lieu"><a id="ajouter_lieu-taba" href="#ajouter_lieu" aria-controls="ajouter_lieu" role="tab" data-toggle="tab">Ajouter un lieu</a></li>
											<li role="presentation" id="tab_affection_proprio"><a id="affection_proprio-taba" href="#affection_proprio" aria-controls="affection_proprio" role="tab" data-toggle="tab">Affectation Propriétaire</a></li>
											<li role="presentation" id="tab_crediter_membre"><a id="crediter_membre-taba" href="#crediter_membre" aria-controls="crediter_membre" role="tab" data-toggle="tab">Créditer un membre</a></li>
										<?php } ?>
									<?php } ?>
                                </ul>
                                <!-- Tab panes -->
								<div class="margintop10"></div>
                                <div class="tab-content">
                                    <!-- TAB paramètres comptes -->
                                    <div role="tabpanel" class="tab-pane text-center active" id="mon_compte">
                                        <div class="clearfix"></div>
										<div class="form-group">
										<label for="femail">Votre adresse email</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-user"></i></div>
												<input type="text" class="form-control" id="femail" value="<?php echo $email_membre ;?>" disabled>
											</div>
										</div>
										<div class="form-group">
										<label for="femail">Statut sur lepetitbal</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
												<input type="text" class="form-control" id="statut" value="<?php echo $membre_statut ;?>" disabled>
											</div>
										</div>
										<?php if ($proprio!==0): ?>
											<div class="form-group">
											<label for="femail">Vos lieux</label>
											<?php
											$i=0;
											while($i<$nb_lieu_proprietaire){?>
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-home"></i></div>
													<input type="text" class="form-control" id="lieu_possede" value="<?php echo $liste_nom_lieu_proprio[$i];?>" disabled>
													<div type="button" id="bouton_modifier_<?php echo $liste_id_lieu_proprio[$i];?>" title="Modifier l'annonce" class="input-group-addon" style="font-size:12px;cursor:pointer" onclick="return bouton_modifier(<?php echo $liste_id_lieu_proprio[$i];?>)"><i class="fa fa-pencil-square-o"></i> Modifier</div>
												</div>
												<div class="margintop5"></div>
											<?php $i++;} ?>
											</div>
										<?php endif ?>
										<?php if($membre_statut!=="Membre"){ ?>
											<div class="form-group">
											<label for="nb_jeton">Jetons disponibles</label>
												<div class="input-group">
													<div class="input-group-addon"><img src="/ressources/images/website/icon-coin.jpg" alt="icon coin" style="width:16px;height:16px;"></div>
													<input type="text" class="form-control" id="nb_jeton" value="<?php echo $nb_jeton_dispo ;?>" disabled>
													<div id="bouton_obtenir_jeton_espace_membre" class="input-group-addon" style="font-size:12px;cursor:pointer">Obtenir des jetons</div>
												</div>
											</div>
										<?php } ?>
										<button type="button" id="btn_changer_mdp" class="btn btn-block btn-espace-membre margintop5">Changer de mot de passe</button>
										<div id="zone-bouton-changer-mdp" class="zone-bouton-changer-mdp margintop5 collapse">
											<form action="../ressources/controleur/action/changer_mdp_membre.php" method="post" onsubmit="return verifForm_chgt_mdp(this);" autocomplete="off">
												<input style="display:none">
												<input type="password" style="display:none">
												<input type="hidden" id="chgt-mdp-plateforme" value="<?php echo $plateforme ;?>">
												<div id="form-group-password_membre_old" class="form-group">
													<label for="password_membre_old">Mot de passe actuel</label>
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-lock"></i></div>
														<input type="password" class="form-control" name="password_membre_old" id="password_membre_old" placeholder="Saisissez votre mot de passe actuel" value="" autocomplete="off" required>
													</div>
												</div>
												<div id="form-group-password_membre_new" class="form-group">
													<label for="password_membre_new">Nouveau mot de passe</label>
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-lock"></i></div>
														<input type="password" class="form-control" name="password_membre_new" id="password_membre_new" placeholder="Saisissez un nouveau mot de passe" required>
													</div>
												</div>
												<div id="form-group-password_control_new" class="form-group">
													<label for="password_control_new">Confirmation du nouveau mot de passe</label>
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-lock"></i></div>
														<input type="password" class="form-control" name="password_control_new" id="password_control_new" placeholder="Confirmez le nouveau mot de passe" required>
													</div>
													<span class="help-block has-error" id="password-error-inscription_new"></span>
												</div>
												<span class="help-block has-error" id="finalcheck-inscription_new"></span>
												<button style="padding:5px" type="submit">Changez votre mot de passe</button>
											</form>
										</div>
										<div class="clearfix"></div>
										<div class="margintop5"></div>
										<div>Pour toute autre demande : <a href="mailto:contact@lepetitbal.com"> contact@lepetitbal.com</a></div>
                                    </div>
									<?php if($membre_statut=="Membre"){ ?>
                                    <!-- Tab Devenir Annonceur -->
                                    <div role="tabpanel" class="tab-pane text-center" id="devenir_annonceur">
										<div class="form-group">
											<label>Choix pour devenir annonceur :</label>
											<label class="input-group choix_nouveau_annonceur">
												<input type= "radio" name="choix_nouveau_annonceur" value="revendiquer_lieu" id="revendiquer_lieu" checked="checked">Revendiquer une organisation ou un lieu
											</label>										
											<label class="input-group choix_nouveau_annonceur">
												<input type= "radio" name="choix_nouveau_annonceur" value="nouveau_lieu_devenir_annonceur" id="nouveau_lieu_devenir_annonceur">Créer une nouvelle organisation ou un lieu
											</label>
										</div>
										<!-- TAB REVENDIQUER LIEU -->
										<div id="zone-revendiquer_lieu" class="zone-revendiquer_lieu collapse in">
											<form id="form_revendiquer_lieu" action="/ressources/controleur/action/revendiquer_lieu.php" method="post">
												<input type='hidden' class='email_membre_input' name="email_membre" value="<?php echo $email_membre ;?>"/>
												<div id="form-group-nom_revendiquer_lieu" class="form-group">
													<label for="email">Recherche du nom de l'organisation ou du lieu à revendiquer</label>
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-home"></i></div>
														<input type="text" class="form-control" name="revendiquer_nom_lieu" id="revendiquer_nom_lieu" placeholder="Ex: Ecole de Danse Gilbert" required>
													</div>
												</div>
												<input id="btn_revendiquer_lieu" class="btn btn-block btn-espace-membre" type="button" value="Revendiquer le lieu">
											</form>
										</div>
										<!-- TAB AJOUT NOUVEAU LIEU ANNONCEUR -->
										<div id="zone-nouveau_lieu" class="zone-nouveau_lieu_devenir_annonceur collapse">
											<div role="tabpanel" class="tab-pane text-center" id="ajouter_lieu_devenir_annonceur">
												<div class="clearfix"></div>
												<form id="form_ajout_lieu_demande" action="/ressources/controleur/action/devenir_annonceur.php" method="post" enctype="multipart/form-data">
													<input type='hidden' class='email_membre_input' name="email_membre" value="<?php echo $email_membre ;?>"/>
													<div class="scroll-overflow-reg">
														<div class="form-group">
															<label for="nom_lieu">Nom de l'organisation ou du lieu</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-home"></i></div>
																<input type="text" class="form-control" name="nom_lieu" id="nom_lieu_devenir_annonceur" placeholder="Nom de l'organisation ou du lieu" maxlength="30" required>
															</div>
														</div>
														<div class="form-group">
															<label for="type_lieu">Type d'organisation ou de lieu</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="glyphicon glyphicon-star"></i></div>
																<select name="type_lieu" class="form-control" id="type_lieu_devenir_annonceur" required>
																	<option value="" disabled selected>Selectionnez le type</option>
																	<option value="Ecole de Danse">Ecole de Danse</option>
																	<option value="Association">Association</option>
																	<option value="Salle de Sport">Salle de Sport/Club de Fitness</option>
																	<option value="Bar/Restaurant">Bar/Restaurant</option>
																	<option value="Professeur de danse">Professeur de danse</option>
																	<option value="Autre">Autre</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="adresse_lieu">Adresse du lieu des cours/soirées/évènements</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
																<input type="text" class="form-control" name="adresse_lieu" id="adresse_lieu_devenir_annonceur" placeholder="Adresse précise du lieu" maxlength="60" required>
															</div>
														</div>										
														<div class="form-group">
															<label for="communaute_lieu">Styles de danse pratiqués</label>
															<div class="input-group">
															  <div class="input-group-addon"><img src="/ressources/images/website/icon-danse-transparent.png" alt="icon danse" style="width:16px;height:16px;"></div>
															  <div class="form-control zonecheckbox" id="communaute_lieu_devenir_annonceur">
																	<label>Afro-Latines</label>
																	<div class="checkbox">
																		<label><input type="checkbox" id="communaute_lieu_salsa_devenir_annonceur" name="communaute_lieu_salsa" value="Salsa">Salsa Cubaine-Portoricaine</label>
																	</div>
																	<div class="checkbox">
																		<label><input type="checkbox" id="communaute_lieu_tango_devenir_annonceur" name="communaute_lieu_bachata" value="Bachata">Bachata</label>
																	</div>
																	<div class="checkbox">
																		<label><input type="checkbox" id="communaute_lieu_kizomba_devenir_annonceur" name="communaute_lieu_kizomba" value="Kizomba">Kizomba</label>
																	</div>
																	<label>Rock-Swing</label>
																	<div class="checkbox">
																		<label><input type="checkbox" id="communaute_lieu_rock4T_devenir_annonceur" name="communaute_lieu_rock4T" value="Rock 4T">Rock 4T-Moderne</label>
																	</div>															 
																	<div class="checkbox">
																		<label><input type="checkbox" id="communaute_lieu_rock6T_devenir_annonceur" name="communaute_lieu_rock6T" value="Rock 6T">Rock 6T</label>
																	</div>
																	<div class="checkbox">
																		<label><input type="checkbox" id="communaute_lieu_swing_devenir_annonceur" name="communaute_lieu_swing" value="Swing">Swing-Lindy-Balboa-Charleston-Blues</label>
																	</div>
																	<div class="checkbox">
																		<label><input type="checkbox" id="communaute_lieu_wcs_devenir_annonceur" name="communaute_lieu_wcs" value="WCS">West Coast Swing</label>
																	</div>
																	<label>Danses de salon</label>
																	<div class="checkbox">
																		<label><input type="checkbox" id="communaute_lieu_tango_devenir_annonceur" name="communaute_lieu_tango" value="Tango Argentin">Tango Argentin</label>
																	</div>
																	<div class="checkbox">
																		<label><input type="checkbox" id="communaute_lieu_salon_devenir_annonceur" name="communaute_lieu_salon" value="Salon">Danses de salon</label>
																	</div>	
																</div>													  
															</div>
														</div>
														<div class="form-group">
															<label>Activités</label>
															<div class="input-group">
															<div class="input-group-addon"><img src="/ressources/images/website/icon-human-shoes-footprints.png" alt="footprints" style="width:16px;height:16px;"></div>
															<div class="form-control zonecheckbox">
																  <div class="checkbox">
																   <label><input type="checkbox" id="activite_cours_devenir_annonceur" name="activite_cours" value="cours">Cours réguliers</label>
																 </div>
																 <div class="checkbox">
																  <label><input type="checkbox" id="activite_soiree_devenir_annonceur" name="activite_soiree" value="soiree">Pratiques/Soirées régulières</label>
																 </div>
																 <div class="checkbox">
																  <label><input type="checkbox" id="activite_event_devenir_annonceur" name="activite_event" value="event">Évènements</label>
																 </div>
															  </div>
															</div>
														</div>
													</div>
													<div class="margintop10 bouton">
														<input id="btn_devenir_annonceur" class="btn btn-block btn-espace-membre" type="button" value="Envoyer la demande">
													</div>
												</form>
											</div>
										</div>
									</div>
									<?php } ?>
									<?php if($membre_statut!=="Membre"){ ?>
                                    <!-- TAB ACHAT JETONS -->
                                    <div role="tabpanel" class="tab-pane text-center" id="achat_jeton">
                                        <div class="clearfix"></div>
										<div class="form-group">
										<label for="nb_jeton">Jetons disponibles</label>
										<div class="input-group">
											<div class="input-group-addon"><img src="/ressources/images/website/icon-coin.jpg" alt="icon coin" style="width:16px;height:16px;"></div>
											<input type="text" class="form-control" value="<?php echo $nb_jeton_dispo ;?>" disabled>
										</div>
										</div>
                                        <form id="form_achat_jeton">
                                            <div class="form-group">
                                                <label for="info_achat_jeton">Information</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></div>
                                                    <textarea readonly class="form-control" id="info_achat_jeton" rows="2" cols="50">L'obtention des jetons est pour le moment indisponible.&#13;&#10;Nous contacter pour plus d'informations.</textarea>               
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>    
                                        </form>
                                        <button type="button" id="btn_achat_jeton" class="btn btn-block btn-espace-membre" data-toggle="collapse" href="#zone-bouton-paypal" disabled>Obtenir des jetons (indisponible)</button>
                                        <div id="zone-bouton-paypal" class="zone-bouton-paypal collapse">
											<div> Grille Tarifaire applicable du 01/01/2017 au 01/03/2017</div>
                                            <table class="tg">
                                                <tr>
													<th class="tg-020d">Packs<br></th>
													<th class="tg-ey97">Nombre de Jetons<br></th>
													<th class="tg-ey97">Prix (TTC)</th>
													<th class="tg-ey97">Prix/Jeton</th>
													<th class="tg-ey97">% Réduction<br></th>
                                                </tr>
                                                <tr>
													<td class="tg-up8n">Pack Diamant<br></td>
													<td class="tg-dhfb">500</td>
													<td class="tg-dhfb">300 €</td>
													<td class="tg-dhfb">0,60€</td>
													<td class="tg-dhfb">40 %<br></td>
                                                </tr>
                                                <tr>
													<td class="tg-y4jq">Pack Or<br></td>
													<td class="tg-120o">200</td>
													<td class="tg-120o">140 €<br></td>
													<td class="tg-120o">0,70€</td>
													<td class="tg-120o">30 %<br></td>
                                                </tr>
                                                <tr>
													<td class="tg-up8n">Pack Argent<br></td>
													<td class="tg-dhfb">50</td>
													<td class="tg-dhfb">40 €<br></td>
													<td class="tg-dhfb">0,80€</td>
													<td class="tg-dhfb">20 %<br></td>
                                                </tr>
                                                <tr>
													<td class="tg-y4jq">Pack Bronze<br></td>
													<td class="tg-120o">20</td>
													<td class="tg-120o">18 €<br></td>
													<td class="tg-120o">0,90€</td>
													<td class="tg-120o">10 %<br></td>
                                                </tr>
                                                <tr>
													<td class="tg-up8n">Unité<br></td>
													<td class="tg-dhfb">1</td>
													<td class="tg-dhfb">1 €<br></td>
													<td class="tg-dhfb">1,00€</td>
													<td class="tg-dhfb">0 %<br></td>
                                                </tr>												
                                            </table>
                                            <form action="https://www.paypal.com/cgi-bin/webscr" onsubmit="return confSubmit();" method="post" target="_blank">
                                                <input type="hidden" name="cmd" value="_s-xclick">
                                                <input type="hidden" name="hosted_button_id" value="YT9PZNTZJAYHJ">
												<input type="hidden" name="custom" value="<?php echo $email_membre ;?>">
                                                <table>
													<tr><td style="text-align:center;font-size:12px;border:none;padding-top:5px;padding-bottom:10px;"><input type="hidden" name="on0" value="Achat de Jetons">Sélectionnez votre Pack :
													
													<select name="os0">
														<option value="Pack Diamant - 500 Jetons">Pack Diamant - 500 Jetons €300,00 EUR</option>
														<option value="Pack Or - 200 Jetons">Pack Or - 200 Jetons €140,00 EUR</option>
														<option value="Pack Argent - 50 Jetons">Pack Argent - 50 Jetons €40,00 EUR</option>
														<option value="Pack Bronze - 20 Jetons">Pack Bronze - 20 Jetons €18,00 EUR</option>
														<option value="Unité - 1 Jeton">Unité - 1 Jeton €1,00 EUR</option>
													</select>
													<div style="font-size:10px">(Les quantités sont modifiables directement sur Paypal)</div>
													<input id="one" type="checkbox" />J'ai lu et j'accepte les  <a href="https://www.lepetitbal.com/CGU/" target="_blank">conditions générales de vente</a>
													</td></tr>
                                                </table>
                                                <input type="hidden" name="currency_code" value="EUR">
                                                <input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="Achetez vos jetons avec PayPal!">
												<div style="padding-bottom: 5px;"></div>
                                            </form>
                                        </div>
                                    </div>
									<!-- TAB ajout event -->
                                    <div role="tabpanel" class="tab-pane text-center" id="ajout_event">
										<div id="form_ajouter_event_content" class="form-group">
											<form id="form_ajouter_event" action="ressources/controleur/action/ajouter_evenement.php" method="post">
												<div class="form-group zone-event-unlock">
													<div class="form-group">
														<label>Choix du Lieu</label>
														<?php if ($proprio!==0): ?>
															<?php
															$i=0;
															while($i<$nb_lieu_proprietaire){?>
																<label class="input-group choix_event">
																	<input type= "radio" name="id_lieu_add" value="<?php echo $liste_id_lieu_proprio[$i];?>"><?php echo $liste_nom_lieu_proprio[$i];?>
																</label>	
															<?php $i++;} ?>
														<?php endif ?>
														<label class="input-group choix_event">
															<input type= "radio" name="id_lieu_add" value="recherche_lieu" id="recherche_lieu">Recherche parmi les lieux existants
														</label>
														<div id="zone-recherche_lieu" class="zone-recherche_lieu collapse">
															<div class="form-group">	
																<label>Nom du lieu</label>
																<div class="input-group">
																	<input type="text" class="form-control" name="nom_lieu_evenement_recherche" id="nom_lieu_evenement_recherche" placeholder="Entrer le nom d'un lieu" maxlength="50" required>
																</div>
															</div>
														</div>
														<label class="input-group choix_event">
															<input type= "radio" name="id_lieu_add" value="nouveau_lieu" id="nouveau_lieu">Nouveau lieu
														</label>
														<div id="zone-nouveau_lieu" class="zone-nouveau_lieu collapse">
															<div class="form-group">	
																<label>Nom du lieu</label>
																<div class="input-group">
																	<input type="text" class="form-control" name="nom_lieu_evenement_add" id="nom_lieu_evenement_add" placeholder="Ex: La ferme de Francis" maxlength="50" required>
																</div>
															</div>
															<div class="form-group">
																<label for="adresse_lieu_event">Adresse du lieu de l'évènement</label>
																<div class="input-group">
																	<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
																	<input type="text" class="form-control" name="adresse_lieu_event" id="adresse_lieu_event" placeholder="Adresse précise du lieu" maxlength="60" required>
																	<input type="text" name="gps_lieu_event" value="" hidden /> 
																</div>
															</div>
															<div class="form-group">
																<label for="type_lieu_event">Type d'organisation ou de lieu</label>
																<div class="input-group">
																	<div class="input-group-addon"><i class="glyphicon glyphicon-star"></i></div>
																	<select name="type_lieu_event" class="form-control" id="type_lieu_event" required>
																		<option value="" disabled selected>Selectionnez le type</option>
																		<option value="Ecole de Danse">Ecole de Danse</option>
																		<option value="Association">Association</option>
																		<option value="Salle de Sport">Salle de Sport/Club de Fitness</option>
																		<option value="Bar/Restaurant">Bar/Restaurant</option>
																		<option value="Professeur de danse">Professeur de danse</option>
																		<option value="Autre">Autre</option>
																	</select>
																</div>
															</div>															
														</div>														
													</div>													
													<div class="form-group">
														<label>Date(s) - Horaire début/fin</label>
														<div class="input-group event-timeline">
															<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
															<input type="text" id="date_evenement_add" name="date_evenement_add" class="form-control" placeholder="Ajouter une ou plusieurs dates">
															<div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
															<input type="text" class="form-control timepicker" name="heure_debut_evenement_add" id="heure_debut_evenement_add" required>
															<div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
															<input type="text" class="form-control timepicker" name="heure_fin_evenement_add" id="heure_fin_evenement_add">
														</div>
													</div>
													<div class="form-group">	
														<label>Titre</label>
														<div class="input-group">
															<input type="text" class="form-control" name="titre_evenement_add" id="titre_evenement_add" placeholder="Ajoutez un titre" maxlength="50" required>
														</div>
													</div>
													<div class="form-group">	
														<label>Organisateur</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="fa fa-bullhorn"></i></div>
															<input type="text" class="form-control" name="organisateur_evenement_add" id="organisateur_evenement_add" placeholder="Indiquez l'organisateur (si différent du propriétaire du lieu)" maxlength="50">
														</div>
													</div>													
													<div class="form-group">	
														<label>Danses pratiquées</label>
														<div class="input-group">
															<div class="input-group-addon"><img src="../ressources/images/website/icon-danse-transparent.png" alt="icon danse" style="width:16px;height:16px;"></div>
															<input type="text" class="form-control" name="danse_pratique_evenement_add" id="danse_pratique_evenement_add" placeholder="Indiquez les danses pratiquées" maxlength="50" required>
														</div>
													</div>
													<div class="form-group">	
														<label>Tarifs</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="fa fa fa-eur"></i></div>
															<input type="text" class="form-control" name="tarifs_evenement_add" id="tarifs_evenement_add" placeholder="Indiquez les tarifs de l'évènement" maxlength="50" required>
														</div>
													</div>												
													<div class="form-group">	
														<label>Description</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></div>
															<textarea class="form-control" style="overflow:auto;resize:none" rows="5" cols="50" maxlength="2000" name="description_evenement_add" id="description_evenement_add" placeholder="Ajoutez une description: Infos, Contact, Prix... (2000 caractères max)"></textarea>
														</div>
													</div>
													<div class="form-group">
														<label>Lien Facebook</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="fa fa-facebook"></i></div>
															<input type="text" class="form-control" name="url_fb_evenement_add" id="url_fb_evenement_add" placeholder="Exemple: facebook.com/events/XXXX/">
														</div>
													</div>
													<div class="form-group">
														<label>Options</label>
														<div class="form-control zonecheckbox">
															<div class="checkbox">
																<label>
																	<input type="checkbox" id="initiation_evenement_add" name="initiation_evenement_add" value="initiation">
																	<img src="../ressources/images/website/icon-human-shoes-footprints-white.png" alt="footprints white" style="width:16px;height:16px;margin-right:5px;">Initiation/Stage
																</label>
															</div>
															<div class="checkbox">
																<label>
																	<input type="checkbox" id="special_evenement_add" name="special_evenement_add" value="special">
																	<i class="glyphicon glyphicon-star-empty" style="margin-right:8px;font-size:14px; margin-top:1px;"></i>Évènement Spécial (concert, démonstration, show, ...)</label>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label>Styles de danse</label>
														<div class="input-group">
															<div class="input-group-addon"><img src="../ressources/images/website/icon-danse-transparent.png" alt="icon danse" style="width:16px;height:16px;"></div>
															<div class="form-control zonecheckbox" id="communaute_evenement_add">
																<label>Afro-Latines</label>
																 <div class="checkbox">
																   <label><input type="checkbox" id="communaute_evenement_salsa_add" name="communaute_evenement_salsa_add" value="Salsa">Salsa Cubaine-Portoricaine</label>
																 </div>
																 <div class="checkbox">
																   <label><input type="checkbox" id="communaute_evenement_tango_add" name="communaute_evenement_bachata_add" value="Bachata">Bachata</label>
																 </div>
																 <div class="checkbox">
																  <label><input type="checkbox" id="communaute_evenement_kizomba_add" name="communaute_evenement_kizomba_add" value="Kizomba">Kizomba</label>
																 </div>
																 <label>Rock-Swing</label>
																  <div class="checkbox">
																   <label><input type="checkbox" id="communaute_evenement_rock4T_add" name="communaute_evenement_rock4T_add" value="Rock 4T">Rock 4T-Moderne</label>
																 </div>															 
																 <div class="checkbox">
																   <label><input type="checkbox" id="communaute_evenement_rock6T_add" name="communaute_evenement_rock6T_add" value="Rock 6T">Rock 6T</label>
																 </div>
																 <div class="checkbox">
																   <label><input type="checkbox" id="communaute_evenement_swing_add" name="communaute_evenement_swing_add" value="Swing">Swing-Lindy-Balboa-Charleston-Blues</label>
																 </div>
																 <div class="checkbox">
																   <label><input type="checkbox" id="communaute_evenement_wcs_add" name="communaute_evenement_wcs_add" value="WCS">West Coast Swing</label>
																 </div>
																 <label>Danses de salon</label>
																 <div class="checkbox">
																   <label><input type="checkbox" id="communaute_evenement_tango_add" name="communaute_evenement_tango_add" value="Tango Argentin">Tango Argentin</label>
																 </div>
																 <div class="checkbox">
																   <label><input type="checkbox" id="communaute_evenement_salon_add" name="communaute_evenement_salon_add" value="Salon">Danses de salon</label>
																 </div>
															</div>
														</div>
													</div>
													<!--
													<div class="form-group">
														<label for="nb_jetons_dispo">Jetons disponibles</label>							
														<div class="input-group">
															<div class="input-group-addon"><img src="../ressources/images/website/icon-coin.jpg" alt="icon coin" style="width:16px;height:16px;"></div>
															<input type="text" id="nb_jetons_dispo" class="form-control noselect" value="<?php //echo $nb_jeton_dispo ;?>" disabled>
															<div id="bouton_obtenir_jeton" class="input-group-addon bouton_obtenir_jeton" style="font-size:12px;cursor:pointer">Obtenir des jetons</div>
														</div>
													</div>
													<div class="form-group">
														<label for="nb_jetons_utilise_event">Dépense en jetons</label>						
														<div class="input-group">
															<div class="input-group-addon"><img src="../ressources/images/website/icon-hand-coin.jpg" alt="icon hand coin" style="width:16px;height:16px;"></div>
															<input type="number" id="nb_jetons_utilise_event" name="nb_jetons_utilise_event" class="form-control noselect cursor-default" value="0" readonly>
															<input type="hidden" id="cout_jeton" value="5">
															<input type="hidden" id="nb_event" value="5">
														</div>
													</div>
													-->
													<input type="hidden" id="nb_event" value="0">
													<div class="bouton"><input id="btn_ajouter_evenement" class="btn btn-block btn-espace-modifier-main" type="button" value="Ajouter l'évènement"/></div>
												</div>
											</form>
										</div>
									</div>
									<?php if($admin==1){ ?>
										<!-- TAB AJOUT LIEU -->
										<div role="tabpanel" class="tab-pane text-center" id="ajouter_lieu">
											<div class="clearfix"></div>
											<form id="form_ajout_lieu" action="/ressources/controleur/action/ajouterLieu.php" method="post" enctype="multipart/form-data">
												<div class="scroll-overflow-reg">
													<div class="form-group">
														<label for="proprietaire_lieu">Adresse email du propriétaire</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="fa fa-at"></i></div>
															<input type="text" class="form-control" name="proprietaire_lieu" id="proprietaire_lieu" placeholder="Ex: dupont@gmail.com" maxlength="50" required>
														</div>
													</div>													
													<div class="form-group">
														<label for="nom_lieu">Nom de l'organisation ou du lieu</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="fa fa-home"></i></div>
															<input type="text" class="form-control" name="nom_lieu" id="nom_lieu" placeholder="Nom de l'organisation ou du lieu" maxlength="30" required>
														</div>
													</div>
													<div class="form-group">
														<label for="type_lieu">Type d'organisation ou de lieu</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="glyphicon glyphicon-star"></i></div>
															<select name="type_lieu" class="form-control" id="type_lieu" required>
																<option value="" disabled selected>Selectionnez le type</option>
																<option value="Ecole de Danse">Ecole de Danse</option>
																<option value="Association">Association</option>
																<option value="Salle de Sport">Salle de Sport/Club de Fitness</option>
																<option value="Bar/Restaurant">Bar/Restaurant</option>
																<option value="Professeur de danse">Professeur de danse</option>
																<option value="Autre">Autre</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="adresse_lieu">Adresse du lieu des cours/soirées/évènements</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
															<input type="text" class="form-control" name="adresse_lieu" id="adresse_lieu" placeholder="Adresse précise du lieu" maxlength="60" required>
															<input type="text" name="gps_lieu" value="" hidden /> 
														</div>
													</div>										
													<div class="form-group">
														<label for="communaute_lieu">Styles de danse</label>
														<div class="input-group">
														  <div class="input-group-addon"><img src="/ressources/images/website/icon-danse-transparent.png" alt="icon danse" style="width:16px;height:16px;"></div>
														  	<div class="form-control zonecheckbox" id="communaute_lieu">
																<label>Afro-Latines</label>
																<div class="checkbox">
																  <label><input type="checkbox" id="communaute_lieu_salsa" name="communaute_lieu_salsa" value="Salsa">Salsa Cubaine-Portoricaine</label>
																</div>
																<div class="checkbox">
																  <label><input type="checkbox" id="communaute_lieu_tango" name="communaute_lieu_bachata" value="Bachata">Bachata</label>
																</div>
																<div class="checkbox">
																 <label><input type="checkbox" id="communaute_lieu_kizomba" name="communaute_lieu_kizomba" value="Kizomba">Kizomba</label>
																</div>
																<label>Rock-Swing</label>
																 <div class="checkbox">
																  <label><input type="checkbox" id="communaute_lieu_rock4T" name="communaute_lieu_rock4T" value="Rock 4T">Rock 4T-Moderne</label>
																</div>															 
																<div class="checkbox">
																  <label><input type="checkbox" id="communaute_lieu_rock6T" name="communaute_lieu_rock6T" value="Rock 6T">Rock 6T</label>
																</div>
																<div class="checkbox">
																  <label><input type="checkbox" id="communaute_lieu_swing" name="communaute_lieu_swing" value="Swing">Swing-Lindy-Balboa-Charleston-Blues</label>
																</div>
																<div class="checkbox">
																  <label><input type="checkbox" id="communaute_lieu_wcs" name="communaute_lieu_wcs" value="WCS">West Coast Swing</label>
																</div>
																<label>Danses de salon</label>
																<div class="checkbox">
																  <label><input type="checkbox" id="communaute_lieu_tango" name="communaute_lieu_tango" value="Tango Argentin">Tango Argentin</label>
																</div>
																<div class="checkbox">
																  <label><input type="checkbox" id="communaute_lieu_salon" name="communaute_lieu_salon" value="Salon">Danses de salon</label>
																</div>
														  </div>											  
														</div>
													</div>
													<div class="form-group">
														<label>Activités</label>
														<div class="input-group">
														<div class="input-group-addon"><img src="/ressources/images/website/icon-human-shoes-footprints.png" alt="footprints" style="width:16px;height:16px;"></div>
														<div class="form-control zonecheckbox">
															  <div class="checkbox">
															   <label><input type="checkbox" id="activite_cours" name="activite_cours" value="cours">Cours réguliers</label>
															 </div>
															 <div class="checkbox">
															  <label><input type="checkbox" id="activite_soiree" name="activite_soiree" value="soiree">Pratiques/Soirées régulières</label>
															 </div>
															 <div class="checkbox">
															  <label><input type="checkbox" id="activite_event" name="activite_event" value="event">Évènements</label>
															 </div>
														  </div>
														</div>
													</div>
												</div>
												<div class="margintop10 bouton">
													<input id="btn_ajout_lieu" class="btn btn-block btn-espace-membre" type="button" value="Ajouter le lieu">
												</div>
											</form>
										</div>
										<div role="tabpanel" class="tab-pane text-center" id="affection_proprio">
											<form id="form_affection_proprietaire" action="/ressources/controleur/action/affection_proprietaire.php" method="post">
												<div class="form-group">
													<label for="email">Adresse email du propriétaire</label>
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-at"></i></div>
														<input type="text" class="form-control" name="affection_email_proprio" id="affection_email_proprio" placeholder="Ex: lachevre@gmail.com" required>
													</div>
												</div>
												<div id="form-group-nom_lieu" class="form-group">
													<label for="email">Nom de l'organisation ou du lieu</label>
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-home"></i></div>
														<input type="text" class="form-control" name="affection_proprio_lieu" id="affection_proprio_lieu" placeholder="Ex: Ecole de Danse Davy" required>
													</div>
												</div>
												<div class="margintop10 bouton">
													<input id="btn_affecter_proprio" class="btn btn-block btn-espace-membre" type="button" value="Affecter">
												</div>
											</form>
										</div>
										<div role="tabpanel" class="tab-pane text-center" id="crediter_membre">
											<form id="form_crediter_membre" action="/ressources/controleur/action/crediter_membre.php" method="post">
												<div class="form-group">
													<label for="email">Adresse email à créditer</label>
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-at"></i></div>
														<input type="text" class="form-control" name="email_credit" id="email_credit" placeholder="Ex: lachevre@gmail.com" required>
													</div>
												</div>
												<div class="form-group">
													<label for="email">Nombre de jetons à créditer</label>
													<div class="input-group">
														<div class="input-group-addon"><img src="/ressources/images/website/icon-coin.jpg" alt="icon coin" style="width:16px;height:16px;"></div>
														<input type="text" class="form-control" name="nb_jeton_credit" id="nb_jeton_credit" placeholder="Ex: 50" required>
													</div>
												</div>
												<div class="margintop10 bouton">
													<input id="btn_crediter_membre" class="btn btn-block btn-espace-membre" type="button" value="Créditer">
												</div>
											</form>
										</div>
										<?php }?>
									<?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<!-- SCRIPTS UTILISES -->
	<script src="ressources/controleur/js/jquery.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="ressources/controleur/js/jquery.autocomplete.js"></script>
	<script src="ressources/controleur/js/bootstrap.min.js"></script>
	<script src="ressources/controleur/js/please-wait.js"></script>
	<script src="ressources/controleur/js/boutons.js"></script>
	<script src="ressources/controleur/js/geocode.js"></script>
	<script src="ressources/controleur/js/verif_form.js"></script>
	<script src="ressources/controleur/js/verif_form_chgt-mdp.js"></script>
	<script src="ressources/controleur/js/menu.js"></script>
	<script src="ressources/controleur/js/jquery-ui.multidatespicker.js"></script>
	<script src="ressources/controleur/js/datepicker-fr.js"></script>
	<script src="ressources/controleur/js/ajout_event.js"></script>
	<script src="ressources/controleur/js/ajout_annonceur.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	<script src="ressources/controleur/js/timepicker-config.js"></script>		
	<script src="ressources/controleur/js/alertify/alertify.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVvPab8JGafCZMvlwtWEBWgUE0-3d88gs&signed_in=true&libraries=places&callback=initAutocomplete" async defer></script>
	<script src="ressources/controleur/js/autocomplete_gmaps.js"></script>
	<script src="ressources/controleur/js/autocomplete_nom_organisation.js"></script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-88006358-1', 'auto');
	  ga('send', 'pageview');
	</script>
	<script src="ressources/controleur/js/dropdown.js"></script>
    </body>
</html>