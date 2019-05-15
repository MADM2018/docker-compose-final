
<div class="col-md-3 technology-right">
    <div class="blo-top1">
        <div class="tech-btm">

            <?php
                $art = $this->articles->get_recent_articles(10);
                $cant = count($art);
            ?>
            <h4>Reciente</h4>
            <?php
                foreach ($art as $article)
                {
            ?>
            <div class="blog-grids wow fadeInDown" data-wow-duration=".4s" data-wow-delay=".2s">
                <div style="display: table">
                    <div style="display: table-cell; vertical-align: middle;" class="blog-grid-left">
                        <a href="<?php echo site_url($article->uri); ?>"><img src="<?php echo ImageService::getInstance()->getScaledLinkImage(assets_url('images/articles/' . $article->picture)); ?>" class="img-responsive" alt="<?php echo $article->title; ?>"></a>
                    </div>
                    <div class="blog-grid-right">
                        <h5><a href="<?php echo site_url($article->uri); ?>"><?php echo short_text(strip_tags($article->title),96);?></a> </h5>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <?php } ?>
            <?php
                $art = $this->articles->get_popular_articles(10);
                $cant = count($art);
            ?>

			<!-- righbar -->



			<br>
            <h4>Popular</h4>
                <?php
                foreach ($art as $article)
                {
                ?>
                    <div class="blog-grids wow fadeInDown"  data-wow-duration=".4s" data-wow-delay=".2s">
                        <div style="display: table">
                            <div style="display: table-cell; vertical-align: middle;" class="blog-grid-left">
                                <a href="<?php echo site_url($article->uri); ?>"><img src="<?php echo ImageService::getInstance()->getScaledLinkImage(assets_url('images/articles/' . $article->picture)); ?>" class="img-responsive" alt="<?php echo $article->title; ?>"></a>
                            </div>
                            <div class="blog-grid-right">
                                <h5><a href="<?php echo site_url($article->uri); ?>"><?php echo short_text(strip_tags($article->title),96);?></a> </h5>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php if ($this->session->logged_in && $this->session->login_user_type == 'admin') { ?>
            <div style="margin-top: 2em;">
                <h4>Editar</h4>
                <div class="blog-grids">
                    <button type="button" class="btn btn-primary" id="add_article_btn">Agregar nuevo artículo</button>
                </div>
                <div class="blog-grids">
                    <button type="button" class="btn btn-success" id="">Test #2</button>
                </div>
                <div class="blog-grids">
                    <a class="span_link" href="<?php echo site_url('site/logout');?>" id="logout_btn"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php if ($this->session->logged_in && $this->session->login_user_type == 'admin') { ?>

    <!-- Modal Add Article -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Agregar nuevo artículo:</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" id="upload_article" method="post">
                        <div class="form-group">
                            <label for="__title" class="col-sm-3 control-label">Título:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="_title" id="__title" placeholder="Ejemplo: Descubre las 10 nuevas formas de lavarte la cara">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="__summary" class="col-sm-3 control-label">Resumen:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="_summary" id="__summary" placeholder="Ejemplo: Las 10 nuevas formas de lavarse la cara, descubiertas por el cientifico H. Pattersen estan revolucionando al mundo..."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="__text" class="col-sm-3 control-label">Texto:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name = "_text" id="__text" placeholder="Ejemplo: Las 10 nuevas formas de lavarse la cara, descubiertas por el cientifico H. Pattersen estan revolucionando al mundo. De esta forma cambiara el modo en que las personas se levanten todos los dias y se miren en el espejo de su baño. Todo esto condicionado por la falta de agua y de jabón........."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="__picture" class="col-sm-3 control-label">Imágen principal (700x440px JPEG):</label>
                            <div class="col-sm-9">
                                <input type="file" id="__picture" name="_picture">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="__category" class="col-sm-3">Categoría:</label>
                            <div class="col-sm-6">
                                <select id="__category" name="_category" class="form-control">
                                    <option value="none" selected="selected">Ninguna</option>
                                    <?php
                                        $cat = $this->articles->get_category_list();
                                        foreach ($cat as $item)
                                        { ?>
                                            <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id = "new_save_btn">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- Modal Edit Article -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Modificar el artículo:</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" id="upload_edited_article" method="post">
                        <input type="hidden" name = "_edit_id" id="__edit_id" value="">
                        <div class="form-group">
                            <label for="__edit_title" class="col-sm-3 control-label">Título:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="_edit_title" id="__edit_title" placeholder="Ejemplo: Descubre las 10 nuevas formas de lavarte la cara">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="__edit_summary" class="col-sm-3 control-label">Resumen:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="_edit_summary" id="__edit_summary" placeholder="Ejemplo: Las 10 nuevas formas de lavarse la cara, descubiertas por el cientifico H. Pattersen estan revolucionando al mundo..."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="__edit_text" class="col-sm-3 control-label">Texto:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name = "_edit_text" id="__edit_text" placeholder="Ejemplo: Las 10 nuevas formas de lavarse la cara, descubiertas por el cientifico H. Pattersen estan revolucionando al mundo. De esta forma cambiara el modo en que las personas se levanten todos los dias y se miren en el espejo de su baño. Todo esto condicionado por la falta de agua y de jabón........."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="__edit_picture" class="col-sm-3 control-label">Imágen principal (736x356px JPEG):</label>
                            <div class="col-sm-9">
                                <input type="file" id="__edit_picture" name="_edit_picture">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="__edit_category" class="col-sm-3">Categoría:</label>
                            <div class="col-sm-6">
                                <select id="__edit_category" name="_edit_category" class="form-control">
                                    <option value="none" selected="selected">Ninguna</option>
                                    <?php
                                    $cat = $this->articles->get_category_list();
                                    foreach ($cat as $item)
                                    { ?>
                                        <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id = "edit_save_btn">Modificar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal edit -->

<?php } ?>

<?php if ($this->session->logged_in && $this->session->login_user_type == 'admin') { ?>
    <script src="<?php echo assets_url('js/sweetalert.min.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo assets_url('css/sweetalert.css'); ?>">

    <script type="text/javascript">
        $(document).ready(function() {
            /* add new article section */
            $('#add_article_btn').click(function (e) {
                e.preventDefault();

                $('#addModal').modal({
                    keyboard: true
                })
            });

            $('#new_save_btn').click(function (e) {

                e.preventDefault();

                var formData = new FormData(document.getElementById("upload_article"));
                $.ajax({
                        url: "<?php echo site_url('article/add_article');?>",
                        type: "post",
                        dataType: "html",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                    .done(function (response) {
                        if (response == "true") {
                            swal("Hecho!", "El artículo se ha agregado correctamente.", "success");
                            $('#addModal').modal('hide');
                        }
                        else {
                            swal("Error1111", "revise el articulo: " + response, "error");
                        }
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        swal("Algo sucede con el servidor: " + textStatus + " " + errorThrown);
                    });
            });
            /* END add new article section */


            /* delete article section */
            var delete_article = function(id) {
                return $.getJSON("<?php echo site_url('article/delete_article'); ?>", {
                    "_id": id
                });
            }

            $('[data-delete]').click(function(e) {
                e.preventDefault();
                var gid = $(this).data('delete');

                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this Article.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){
                        delete_article( gid  )
                            .done(function(response) {
                                if (response.success) {
                                    swal("Deleted!", "The article has been deleted.", "success");
                                    $("#art_" + gid).remove();
                                } else {
                                    swal("Error removing article :(");
                                }
                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {
                                swal("Something is wrong with the server: " + textStatus);
                            });
                    });
            });

            /* END delete article section */

            /* edit article section */
            var get_modal_values = function(id) {
                return $.getJSON("<?php echo site_url('article/edit_article_html'); ?>", {
                    "id": id
                });
            }

            $('[data-edit]').click(function(e) {
                e.preventDefault();
                var gid = $(this).data('edit');

                get_modal_values(gid)
                    .done(function(response) {
                        $('#__edit_title').attr('value', response.title);
                        $('#__edit_text').val(response.text);
                        $('#__edit_summary').val(response.summary);
                        $('#__edit_id').attr('value',gid);

                        $('#editModal').modal({
                            keyboard: false
                        })
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        swal("Error!", "Something is wrong with the server." + textStatus, "warning");
                    });
            });

            $('#edit_save_btn').click(function(e) {
                e.preventDefault();

                var formData = new FormData(document.getElementById("upload_edited_article"));
                $.ajax({
                        url: "<?php echo site_url('article/edit_article_info');?>",
                        type: "post",
                        dataType: "html",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                    .done(function (response) {
                        if (response == "true") {
                            swal("Hecho!", "El artículo se ha modificado correctamente.", "success");
                            $('#editModal').modal('hide');
                        }
                        else {
                            swal("Error", "Revise el error: ", "error");
                            $('#__edit_text').val(response);
                        }
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        swal("Algo sucede con el servidor: " + textStatus + " " + errorThrown);
                    });
            });

            /* END edit article section */

        }); //final key $jquery
    </script>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.dot1').dotdotdot({watch: 'window'});
    });
</script>
