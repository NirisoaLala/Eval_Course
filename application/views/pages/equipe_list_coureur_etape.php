<?php if(!isset($coureurlist)) $coureurlist = array();?>
<!-- page content -->
<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Liste</h3>
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
                    <?php if (isset($_GET['error'])) { ?>
                                    <div class="x_content bs-example-popovers">
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <?php echo $_GET['error']; ?>
                                        </div>
                                    </div>
                                <?php } ?>
					<?php foreach ($coureurlist as $idetape => $etape) { ?>
                    <div class="row">
						<div class="col-md-12 ">
							<div class="x_panel">
								<div class="x_title">
                                <h2>Etape <?php echo $etape['rang_etape']; ?> : <?php echo $etape['etape']; ?> (<?php echo $etape['longueur']; ?> km) - <?php echo $etape['nbre_coureur']; ?> coureur(s)</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table class="table">
                                        <thead>
                                          <tr>
                                            <th>Coureur</th>
                                            <th>Durée</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($etape['details'] as $coureur){ ?>
                                          <tr>
                                            <td><?php echo $coureur['nom']; ?></td>
                                            <td><?php echo $coureur['duree']; ?></td>
                                          </tr>
                                        <?php } ?>
                                        </tbody>
                                      </table>
                                      <a href="<?php echo site_url('CTL_Etape/affectationCoureurForm'); ?>?idetape=<?php echo $etape['idetape']; ?>" class="btn btn-info">Ajouter coureur</a>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<!-- /page content -->