<?php if(!isset($classementlist)) $classementlist = array();?>
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
                                <h2>Classement <small>par étape</small></h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table class="table">
                                        <thead>
                                          <tr>
                                            <th>Rang étape</th>
                                            <th>Etape</th>
                                            <th>Rang</th>
                                            <th>Equipe</th>
                                            <th>Coureur</th>
                                            <th>Genre</th>
                                            <th>Durée</th>
                                            <th>Point</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($classementlist as $classement){ ?>
                                          <tr>
                                            <td><?php echo $classement->rang_etape; ?></td>
                                            <td><?php echo $classement->etape; ?></td>
                                            <th><?php echo $classement->rang; ?></th>
                                            <td><?php echo $classement->equipe; ?></td>
                                            <td><?php echo $classement->nom; ?></td>
                                            <td><?php echo $classement->nomgenre; ?></td>
                                            <td><?php echo $classement->duree; ?></td>
                                            <td><?php echo $classement->point; ?></td>
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