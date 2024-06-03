<?php if(!isset($coureurlist)) $coureurlist = array();?>
            <!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Formulaire</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Coureur <small>affectation</small></h2>
									<div class="clearfix"></div>
								</div>
                                <?php if (isset($_GET['error'])) { ?>
                                    <div class="x_content bs-example-popovers">
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <?php echo $_GET['error']; ?>
                                        </div>
                                    </div>
                                <?php } ?>
								<div class="x_content">
									<br />
                                    <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url('CTL_Etape/saveCoureurEtape'); ?>">
                                        <input type="hidden" name="idetape" value="<?php echo $idetape; ?>">
                                        <div class="form-group row ">
                                            <label class="control-label col-md-3 col-sm-3 ">Coureur</label>
											<div class="col-md-9 col-sm-9 ">
                                                <div class="checkbox">
                                                    <?php for ($i=0; $i < count($coureurlist); $i++) { ?>
                                                    <div class="col-md-6 col-sm-6 ">
													<label>
                                                        <input type="checkbox" value="<?php echo $coureurlist[$i]->id; ?>" name="coureur[]" class="flat"> <?php echo $coureurlist[$i]->nom; ?>
													</label>
                                                    </div>
                                                    <?php } ?>
												</div>
											</div>
										</div>
                                        
										<div class="x_content">
											<button type="submit" class="btn btn-success">Affecter</button>
                                            <a href="<?php echo site_url('CTL_Etape/coureurEtapeByEquipe'); ?>" class="btn btn-secondary">Annuler</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->