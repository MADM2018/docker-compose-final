<script>
var seconds = 9;
var timeOut = 1000;
var counter = null;

function init_counter() {
    if (!counter) {
        counter = setInterval(counter_step, timeOut);
    }
}

function counter_step()
{
    if (seconds > 0) {
        document.getElementById("mytimer").innerHTML = "Artículo completo en: " + seconds;
        seconds = seconds - 1;
    } else {
        document.getElementById("mytimer").innerHTML = '<a href="<?php echo $url; ?>" rel="nofollow">Ver artículo completo aquí.</a>';
        clearInterval(counter);
    }
}

</script>


<div class="technology link-body" >
	<div class="container" >
		<div class="row">

            <div class="col-md-12 single" style="text-align: center; margin-top: 0px;">

				<!-- box1 -->
                <?php
                $ad_code = $this->links->get_box_1($user_id);
                if (!$ad_code) { ?>
                    <!-- box2 -->
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <ins class="adsbygoogle"
                        style="display:inline-block;width:336px;height:280px"
                        data-ad-client="ca-pub-3136901199458158"
                        data-ad-slot="3941752193"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                    <!-- end box2 -->
                <?php } else {echo $ad_code;}
                ?>
    			<!-- end box1 -->
                <br>
                <p class="link-description"><?php echo short_text($summary, 100); ?></p>

                <div class="bht2">
                    <span id="mytimer">Artículo completo en: 10</span>
                </div>
                <br>

                <!-- box2 -->
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                    style="display:inline-block;width:336px;height:280px"
                    data-ad-client="ca-pub-3136901199458158"
                    data-ad-slot="3941752193"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
    			<!-- end box2 -->

                <?php
                $footer_articles = array($this->articles->get_article_by_id($footer_one_id), $this->articles->get_article_by_id($footer_two_id), $this->articles->get_article_by_id($footer_three_id));

                if (count($footer_articles) > 0) { ?>
                <h5 class="top" style="text-align: center">También te pueden interesar:</h5>

                <div class="featured-services">
                    <div class="featured-services-grids">
                        <?php foreach ($footer_articles as $link) { ?>
                        <div class="col-md-4" style="padding-bottom: 2em;">
                            <div class="featured-services-grd">
                                <div>
                                    <a href="<?php echo site_url($link->uri); ?>"><h4><?php echo $link->title; ?></h4></a>
                                    <div class="blog-grid-left1">
                                    <a href="<?php echo site_url($link->uri); ?>"><img src="<?php echo ImageService::getInstance()->getScaledLinkImage(
    assets_url('images/articles/' . $link->picture)
); ?>" alt=" " class="img-responsive"></a>
                                	</div>
                                    <p style="color: #333;"><?php echo short_text(strip_tags($link->summary), 250); ?></p>
                                </div>
                                <div style="position:relative;width: 100%;">
                                    <div style="float: right; padding-top: 0.3em;">
                                        <a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span> <?php echo $link->views; ?></a>
                                    </div>
                                    <div class="bht1" style="float: left;">
                                        <a href="<?php echo site_url($link->uri); ?>">Leer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php
                        $tematic = $this->links->get_tematic_text_by_id($tematic_text_id);
                        if ($tematic == false) {
                            $tematic = $this->links->get_random_tematic_text();
                        }
                        ?>
                        <div style="clear: both"></div>
                        <hr>
                        <h3 style="margin: 0.8em 0; text-align: left;"><?php echo $tematic['title']; ?></h3>
                        <div style="text-align: justify;">
                            <?php echo $tematic['text']; ?>
                        </div>
                    </div>
                </div>
                <?php }
                ?>
                </div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
