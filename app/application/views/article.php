<!-- technology-left -->
	<div class="technology">
	<div class="container">

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- HEADER -->
    <ins class="adsbygoogle"
        style="display:inline-block;width:970px;height:90px"
        data-ad-client="ca-pub-3136901199458158"
        data-ad-slot="1590837902"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

		<div class="col-md-9 technology-left">
			<div class="agileinfo">
		  <h2 class="w3"><?php echo $title; ?></h2>

          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
            style="display:inline-block;width:336px;height:280px"
            data-ad-client="ca-pub-3136901199458158"
            data-ad-slot="3941752193"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>



			<div class="single">
			   <img src="<?php echo assets_url('images/articles/'.$picture); ?>" class="img-responsive" alt="<?php echo $title; ?>">
			    <div class="b-bottom">
                    <p><a class="span_link" href="#"><span class="glyphicon glyphicon-calendar"></span> <?php echo $a_date; ?> </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span> <?php echo $views; ?></a></p>
                    <div style="clear: both;"></div>
                   <br>
				    <p class="sub">
                        <?php echo $text; ?>
                    </p>
				</div>
			 </div>


                <h5 class="top" style="text-align: center">Artículos que te puedan interesar:</h5>
                <?php
                    $fot = $this->articles->get_footer_three($id);
                ?>
                <div class="featured-services">
                    <div class="featured-services-grids">
                        <?php

                        foreach ($fot as $article)
                        {
                        ?>
                        <div class="col-md-4" style="padding-bottom: 2em;">
                            <div class="featured-services-grd">
                                <div class="blog-grid-left1">
                                    <a href="<?php echo site_url($article->uri); ?>"><img src="<?php echo assets_url('images/articles/' . $article->picture); ?>" alt=" " class="img-responsive"></a>
                                </div>
                                <div style="position: relative; display: table; text-align: center">
                                    <a href="<?php echo site_url($article->uri); ?>"><h4 style="display: table-cell; vertical-align: middle;"><?php echo $article->title;?></h4></a>
                                </div>
                                <div class="dot1 box after">
                                    <p><?php echo strip_tags($article->summary);?></p>
                                </div>
                                <div style="position:relative;width: 100%;">
                                    <div style="float: right; padding-top: 0.3em;">
                                        <a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span> <?php echo $article->views;?></a>
                                    </div>
                                    <div class="bht1" style="float: left;">
                                        <a href="<?php echo site_url($article->uri); ?>">Leer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="clearfix"> </div>
                    </div>
                    <div style="width: 100%">
					</div>
                </div>

				<div class="clearfix"></div>
			</div>
		</div>

		<!-- technology-right -->
		<?php $this->load->view('right_bar.php'); ?>
		<div class="clearfix"></div>
		<!-- technology-right -->

	</div>
</div>
