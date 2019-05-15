    <?php
        $cant = count($articles);
        $steps = $cant / 2;
        $remain = $cant % 2;
        $i = 0;

    ?>
    <!-- technology-left -->
	<div class="technology">
	<div class="container">

		<div style="width: 100%; padding-bottom: 0.5em;">

		</div>
		<div style="clear: both;"></div>
		<div class="col-md-9 technology-left">
			<div class="blog">
				<h1><?php echo $title; ?></h1>
                <?php
                    for ($ii = 1; $ii <= $steps; $ii++)
                    {

                ?>
				<div class="blog-grids1">
					<?php
                        for ($jj = 0; $jj < 2; $jj++) {
                            ?>
                            <div class="col-md-6 blog-grid" id="<?php echo "art_".$articles[$i]->id; ?>">
                                <div class="blog-grid-left1">
                                    <a href="<?php echo site_url($articles[$i]->uri); ?>"><img src="<?php echo assets_url('images/articles/' . $articles[$i]->picture); ?>" alt="<?php echo $articles[$i]->title; ?>" class="img-responsive"></a>
                                </div>
                                <div class="blog-grid-right1">
                                    <div style="position: relative; height: 110px; display: table; text-align: center">
                                        <a style="display: table-cell; vertical-align: middle;" href="<?php echo site_url($articles[$i]->uri); ?>">
                                            <?php echo short_text($articles[$i]->title,80); ?></a>
                                    </div>
                                    <h4><?php echo date('d M Y',$articles[$i]->date); ?></h4>
                                    <div class="dot1 box after"><p><?php  echo $articles[$i]->summary; ?></p></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="bht1">
                                    <a href="<?php echo site_url($articles[$i]->uri); ?>">Leer</a>
                                    <?php if ($this->session->logged_in && $this->session->login_user_type == 'admin') { ?>
                                    <button class="btn btn-warning btn-xs" id="edit_btn" type="button" data-edit="<?php echo $articles[$i]->id; ?>">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    <button class="btn btn-danger btn-xs" id="delete_btn" type="button" data-delete="<?php echo $articles[$i]->id;?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                    <?php } ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php
                            $i++;
                        }
                    ?>
					<div class="clearfix"> </div>
				</div>
                <?php
                    }
                    if ($remain == 1)
                    {
                ?>
                <div class="blog-grids1">

                    <div class="col-md-6 blog-grid" id="<?php echo "art_".$articles[$i]->id; ?>">
                        <div class="blog-grid-left1">
                            <a href="<?php echo site_url($articles[$i]->uri); ?>"><img src="<?php echo assets_url('images/articles/' . $articles[$i]->picture); ?>" alt="<?php echo $articles[$i]->title; ?>" class="img-responsive"></a>
                        </div>
                        <div class="blog-grid-right1">
                            <div style="position: relative; height: 110px; display: table; text-align: center">
                                <a style="display: table-cell; vertical-align: middle;" href="<?php echo site_url($articles[$i]->uri); ?>">
                                    <?php echo short_text($articles[$i]->title,80); ?></a>
                            </div>
                            <h4><?php echo date('d M Y',$articles[$i]->date); ?></h4>
                            <div class="dot1 box after"><p><?php  echo $articles[$i]->summary; ?></p></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="bht1">
                            <a href="<?php echo site_url($articles[$i]->uri); ?>">Leer</a>
                            <?php if ($this->session->logged_in && $this->session->login_user_type == 'admin') { ?>
                                <button class="btn btn-warning btn-xs" id="edit_btn" type="button" data-edit="<?php echo $articles[$i]->id; ?>">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <button class="btn btn-danger btn-xs" id="delete_btn" type="button" data-delete="<?php echo $articles[$i]->id;?>">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            <?php } ?>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <?php } ?>
			</div>
		</div>
		<!-- technology-right -->
		<?php $this->load->view('right_bar.php'); ?>
		<div class="clearfix"></div>
		<!-- technology-right -->
	</div>
</div>
