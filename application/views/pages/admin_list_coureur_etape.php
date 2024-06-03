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
                    <div class="row">
						<div class="col-md-12 ">
							<div class="x_panel">
								<div class="x_title">
                                <h2>Coureur <small>liste et affectation de temps</small></h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table class="table">
                                        <thead>
                                          <tr>
                                            <th>Equipe</th>
                                            <th>Coureur</th>
                                            <th>Numéro de dossard</th>
                                            <th>Genre</th>
                                            <th>Heure de départ</th>
                                            <th>Heure d'arrivée</th>
                                            <th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($coureurlist as $coureur){ ?>
                                          <tr>
                                            <td><?php echo $coureur->equipe; ?></td>
                                            <td><?php echo $coureur->nom; ?></td>
                                            <td><?php echo $coureur->num_dossard; ?></td>
                                            <td><?php echo $coureur->nomgenre; ?></td>
                                            <td><?php echo $coureur->heure_depart; ?></td>
                                            <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url('CTL_Etape/affectationTemps'); ?>">
                                            <td><input type="datetime-local" step="1" name="heure_arrivee" value="<?php echo $coureur->heure_arrivee; ?>"></td>
                                            <input type="hidden" name="idcoureur" value=<?php echo $coureur->idcoureur; ?>>
                                            <input type="hidden" name="idetape" value=<?php echo $coureur->idetape; ?>>
                                            <td><button type="submit" class="btn btn-success">Affecter</button></td>
                                            
                                            </form>
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