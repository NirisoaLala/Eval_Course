<?php if(!isset($classementlist)) $classementlist = array();?>
<!-- page content -->
<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Classement</h3>
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
					<?php foreach ($classementlist as $idetape => $etape) { ?>
                    <div class="row">
						<div class="col-md-12 ">
							<div class="x_panel">
								<div class="x_title">
                                <h2>Etape <?php echo $etape['rang_etape']; ?> : <?php echo $etape['etape']; ?></h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table class="table">
                                        <thead>
                                          <tr>
                                            <th>Rang</th>
                                            <th>Equipe</th>
                                            <th>Coureur</th>
                                            <th>Genre</th>
                                            <th>Durée</th>
                                            <th>Point</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($etape['details'] as $classement){ ?>
                                          <tr>
                                            <th><?php echo $classement['rang']; ?></th>
                                            <td><?php echo $classement['equipe']; ?></td>
                                            <td><?php echo $classement['nom']; ?></td>
                                            <td><?php echo $classement['nomgenre']; ?></td>
                                            <td><?php echo $classement['duree']; ?></td>
                                            <td><?php echo number_format($classement['point'], 2, '.', ' '); ?></td>
                                          </tr>
                                        <?php } ?>
                                        </tbody>
                                      </table>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<!-- /page content -->