

<div class="banner">

	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- HEADER -->
	<ins class="adsbygoogle"
		style="display:inline-block;width:970px;height:90px"
		data-ad-client="ca-pub-3136901199458158"
		data-ad-slot="1590837902"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>

<div class="container">
    <div class="flexslider">
        <ul class="slides">
            <?php
                $N = 10;
                $art = $this->articles->get_recent_articles($N);

                $sld = $art;
                shuffle($sld);
                for ($ii = 0; $ii < 5; $ii++) {
					$article = $art[$ii];
                    $pic = assets_url('images/articles/'.$article->picture);
            ?>
            <li>
                <a href="<?php echo site_url($article->uri); ?>"> <img src="<?php echo ImageService::getInstance()->getScaledSliderImage($pic); ?>" /></a>
                <a class="flex-caption" href="<?php echo site_url($article->uri); ?>"><?php echo short_text($article->title,60); ?></a>
            </li>
            <?php } ?>
        </ul>
    </div>
	</div>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- HEADER -->
		<ins class="adsbygoogle"
			style="display:inline-block;width:970px;height:90px"
			data-ad-client="ca-pub-3136901199458158"
			data-ad-slot="1590837902"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
			</div>
	</div>

	<!-- technology-left -->
	<div class="technology" style="margin-top: 1em;">
	<div class="container">
		<div class="col-md-9 technology-left">
		<div class="tech-no">
			<!-- technology-top -->
			<?php

			$first = $art[0]; ?>
			 <div class="tc-ch wow fadeInDown"  data-wow-duration=".4s" data-wow-delay=".2s">
					<div class="tch-img">
						<a href="<?php echo $first->uri; ?>"><img src="<?php echo assets_url('images/articles/'.$first->picture); ?>" class="img-responsive" alt="<?php echo $first->title; ?>"></a>
					</div>
					<h3><a href="<?php echo site_url($first->uri); ?>"><?php echo $first->title; ?></a></h3>
					<h6><?php echo date('d M Y',$first->date); ?></h6>
						<p style="text-align: justify;"><?php echo short_text($first->summary,500); ?></p>
						<div class="bht1">
							<a href="<?php echo site_url($first->uri); ?>">Leer artículo completo</a>
						</div>

						<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			<!-- technology-top -->
			<!-- technology-top -->
            <?php $first = $art[1]; ?>
			<div class="w3ls">
				<div class="col-md-6 w3ls-left wow fadeInDown"  data-wow-duration=".4s" data-wow-delay=".2s">
					 <div class="tc-ch">
						<div class="tch-img">
							<a href="<?php echo site_url($first->uri); ?>">
							<img src="<?php echo assets_url('images/articles/'.$first->picture); ?>" class="img-responsive" alt="<?php echo $first->title; ?>"></a>
						</div>

						<h3><a href="<?php echo site_url($first->uri); ?>"><?php echo $first->title; ?></a></h3>
						<h6><?php echo date('d M Y',$first->date); ?></h6>
							<p style="text-align: justify;"><?php echo short_text($first->summary,350); ?></p>
							<div class="bht1">
								<a href="<?php echo site_url($first->uri); ?>">Leer artículo completo</a>
							</div>

							<div class="clearfix"></div>
					</div>
				</div>
                <?php $first = $art[2]; ?>
				<div class="col-md-6 w3ls-left wow fadeInDown"  data-wow-duration=".4s" data-wow-delay=".2s">
                    <div class="tc-ch">
                        <div class="tch-img">
                            <a href="<?php echo site_url($first->uri); ?>">
                                <img src="<?php echo assets_url('images/articles/'.$first->picture); ?>" class="img-responsive" alt="<?php echo $first->title; ?>"></a>
                        </div>

                        <h3><a href="<?php echo site_url($first->uri); ?>"><?php echo $first->title; ?></a></h3>
                        <h6><?php echo date('d M Y',$first->date); ?></h6>
                        <p style="text-align: justify;"><?php echo short_text($first->summary,350); ?></p>
                        <div class="bht1">
                            <a href="<?php echo site_url($first->uri); ?>">Leer artículo completo</a>
                        </div>

                        <div class="clearfix"></div>
                    </div>
				</div>
				<div class="clearfix"></div>
			</div>
			<!-- technology-top -->

            <?php

                for ($i = 3; $i < $N; $i++)
                {
                    $first = $art[$i];
            ?>
			<div class="wthree">
				 <div class="col-md-6 wthree-left wow fadeInDown"  data-wow-duration=".4s" data-wow-delay=".2s">
					<div class="tch-img">
							<a href="<?php echo site_url($first->uri); ?>"><img src="<?php echo assets_url('images/articles/'.$first->picture); ?>" class="img-responsive" alt="<?php echo $first->title; ?>"></a>
						</div>
				 </div>
				 <div class="col-md-6 wthree-right wow fadeInDown"  data-wow-duration=".4s" data-wow-delay=".2s">
						<h3><a href="<?php echo site_url($first->uri); ?>"><?php echo $first->title; ?></a></h3>
						<h6><?php echo date('d M Y',$first->date); ?></h6>
							<p style="text-align: justify;"><?php echo short_text(strip_tags($first->summary),200); ?></p>
							<div class="bht1">
								<a href="<?php echo site_url($first->uri); ?>">Leer artículo completo</a>
							</div>

							<div class="clearfix"></div>

				 </div>
					<div class="clearfix"></div>
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
