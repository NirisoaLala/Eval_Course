<?php if(!isset($etapelist)) $etapelist = array();?>
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
                    <div class="row">
						<div class="col-md-12 ">
							<div class="x_panel">
								<div class="x_title">
                                <h2>Etape <small>liste</small></h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table class="table">
                                        <thead>
                                          <tr>
                                            <th>Etape</th>
                                            <th>Nom</th>
                                            <th>Longueur</th>
                                            <th>Nombre de coureur</th>
                                            <th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($etapelist as $etape){ ?>
                                          <tr>
                                            <td>Etape <?php echo $etape->rang; ?></td>
                                            <td><?php echo $etape->nom; ?></td>
                                            <td><?php echo $etape->longueur; ?></td>
                                            <td><?php echo $etape->nbre_coureur; ?></td>
                                            <td><a href="<?php echo site_url('CTL_Etape/affectationCoureurForm')?>?idetape=<?php echo $etape->id; ?>" class="btn btn-info">Affectation de coureur</a></td>
                                          </tr>
                                        <?php } ?>
                                        </tbody>
                                      </table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->