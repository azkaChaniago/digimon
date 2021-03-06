<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("indirect/_parts/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("indirect/_parts/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("indirect/_parts/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("indirect/_parts/breadcrumb.php") ?>

				<div class="container">
                    <div class="post-comments">

                        <form>
                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea name="comment" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Send</button>
                        </form>

                        <div class="comments-nav">
                        <ul class="nav nav-pills">
                            <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    there are 2593 comments <span class="caret"></span>
                                    </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Best</a></li>
                                <li><a href="#">Hot</a></li>
                            </ul>
                            </li>
                        </ul>
                        </div>

                        <div class="row">

                        <div class="media">
                            <!-- first comment -->

                            <div class="media-heading">
                            <button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseExample"><span class="fas fa-minus" aria-hidden="true"></span></button> <span class="label label-info">12314</span> terminator 12 hours ago
                            </div>

                            <div class="panel-collapse collapse in" id="collapseOne">

                            <div class="media-left">
                                <div class="vote-wrap">
                                <div class="save-post">
                                    <a href="#"><span class="fas fa-star" aria-label="Save"></span></a>
                                </div>
                                <div class="vote up">
                                    <i class="fas fa-chevron-up"></i>
                                </div>
                                <div class="vote inactive">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                </div>
                                <!-- vote-wrap -->
                            </div>
                            <!-- media-left -->


                            <div class="media-body">
                                <p>yazmayın artık amk, görmeyeyim sol framede. insan bi meraklanıyor, ümitleniyor. sonra yine özlem dolu yazıları görüp hayal kırıklığıyla okuyorum.</p>
                                <div class="comment-meta">
                                <span><a href="#">delete</a></span>
                                <span><a href="#">report</a></span>
                                <span><a href="#">hide</a></span>
                                <span>
                                            <a class="" role="button" data-toggle="collapse" href="#replyCommentT" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                        </span>
                                <div class="collapse" id="replyCommentT">
                                    <form>
                                    <div class="form-group">
                                        <label for="comment">Your Comment</label>
                                        <textarea name="comment" class="form-control" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-default">Send</button>
                                    </form>
                                </div>
                                </div>
                                <!-- comment-meta -->

                                <div class="media">
                                <!-- answer to the first comment -->

                                <div class="media-heading">
                                    <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseExample"><span class="fas fa-minus" aria-hidden="true"></span></button> <span class="label label-info">12314</span> vertu 12 sat once yazmis
                                </div>

                                <div class="panel-collapse collapse in" id="collapseTwo">

                                    <div class="media-left">
                                    <div class="vote-wrap">
                                        <div class="save-post">
                                        <a href="#"><span class="fas fa-star" aria-label="Save"></span></a>
                                        </div>
                                        <div class="vote up">
                                        <i class="fas fa-chevron-up"></i>
                                        </div>
                                        <div class="vote inactive">
                                        <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                    <!-- vote-wrap -->
                                    </div>
                                    <!-- media-left -->


                                    <div class="media-body">
                                    <p>yazmayın artık amk, görmeyeyim sol framede. insan bi meraklanıyor, ümitleniyor. sonra yine özlem dolu yazıları görüp hayal kırıklığıyla okuyorum.</p>
                                    <div class="comment-meta">
                                        <span><a href="#">delete</a></span>
                                        <span><a href="#">report</a></span>
                                        <span><a href="#">hide</a></span>
                                                <span>
                                                <a class="" role="button" data-toggle="collapse" href="#replyCommentThree" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                                </span>
                                        <div class="collapse" id="replyCommentThree">
                                        <form>
                                            <div class="form-group">
                                            <label for="comment">Your Comment</label>
                                            <textarea name="comment" class="form-control" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-default">Send</button>
                                        </form>
                                        </div>
                                    </div>
                                    <!-- comment-meta -->
                                    </div>
                                </div>
                                <!-- comments -->

                                </div>
                                <!-- answer to the first comment -->

                            </div>
                            </div>
                            <!-- comments -->

                        </div>
                        <!-- first comment -->
                        <div class="media">
                            <!-- first comment -->

                            <div class="media-heading">
                            <button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseExample"><span class="fas fa-minus" aria-hidden="true"></span></button> <span class="label label-info">12314</span> vertu 12 sat once yazmis
                            </div>

                            <div class="panel-collapse collapse in" id="collapseThree">

                            <div class="media-left">
                                <div class="vote-wrap">
                                <div class="save-post">
                                    <a href="#"><span class="fas fa-star" aria-label="Kaydet"></span></a>
                                </div>
                                <div class="vote up">
                                    <i class="fas fa-chevron-up"></i>
                                </div>
                                <div class="vote inactive">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                </div>
                                <!-- vote-wrap -->
                            </div>
                            <!-- media-left -->


                            <div class="media-body">
                                <p>yazmayın artık amk, görmeyeyim sol framede. insan bi meraklanıyor, ümitleniyor. sonra yine özlem dolu yazıları görüp hayal kırıklığıyla okuyorum.</p>
                                <div class="comment-meta">
                                <span><a href="#">sil</a></span>
                                <span><a href="#">kaydet</a></span>
                                <span><a href="#">sikayer et</a></span>
                                <span>
                                            <a class="" role="button" data-toggle="collapse" href="#replyCommentFour" aria-expanded="false" aria-controls="collapseExample">cevapla</a>
                                        </span>
                                <div class="collapse" id="replyCommentFour">
                                    <form>
                                    <div class="form-group">
                                        <label for="comment">Yorumunuz</label>
                                        <textarea name="comment" class="form-control" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-default">Yolla</button>
                                    </form>
                                </div>
                                </div>
                                <!-- comment-meta -->

                                <div class="media">
                                <!-- answer to the first comment -->

                                <div class="media-heading">
                                    <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseExample"><span class="fas fa-minus" aria-hidden="true"></span></button> <span class="label label-info">12314</span> vertu 12 sat once yazmis
                                </div>

                                <div class="panel-collapse collapse in" id="collapseFour">

                                    <div class="media-left">
                                    <div class="vote-wrap">
                                        <div class="save-post">
                                        <a href="#"><span class="fas fa-star" aria-label="Kaydet"></span></a>
                                        </div>
                                        <div class="vote up">
                                        <i class="fas fa-chevron-up"></i>
                                        </div>
                                        <div class="vote inactive">
                                        <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                    <!-- vote-wrap -->
                                    </div>
                                    <!-- media-left -->


                                    <div class="media-body">
                                    <p>yazmayın artık amk, görmeyeyim sol framede. insan bi meraklanıyor, ümitleniyor. sonra yine özlem dolu yazıları görüp hayal kırıklığıyla okuyorum.</p>
                                    <div class="comment-meta">
                                        <span><a href="#">sil</a></span>
                                        <span><a href="#">kaydet</a></span>
                                        <span><a href="#">sikayer et</a></span>
                                        <span>
                                                <a class="" role="button" data-toggle="collapse" href="#replyCommentFive" aria-expanded="false" aria-controls="collapseExample">cevapla</a>
                                                </span>
                                        <div class="collapse" id="replyCommentFive">
                                        <form>
                                            <div class="form-group">
                                            <label for="comment">Yorumunuz</label>
                                            <textarea name="comment" class="form-control" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-default">Yolla</button>
                                        </form>
                                        </div>
                                    </div>
                                    <!-- comment-meta -->

                                    <div class="media">
                                        <!-- first comment -->

                                        <div class="media-heading">
                                        <button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseExample"><span class="fas fa-minus" aria-hidden="true"></span></button> <span class="label label-info">12314</span> vertu 12 sat once yazmis
                                        </div>

                                        <div class="panel-collapse collapse in" id="collapseFive">

                                        <div class="media-left">
                                            <div class="vote-wrap">
                                            <div class="save-post">
                                                <a href="#"><span class="fas fa-star" aria-label="Kaydet"></span></a>
                                            </div>
                                            <div class="vote up">
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                            <div class="vote inactive">
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                            </div>
                                            <!-- vote-wrap -->
                                        </div>
                                        <!-- media-left -->


                                        <div class="media-body">
                                            <p>yazmayın artık amk, görmeyeyim sol framede. insan bi meraklanıyor, ümitleniyor. sonra yine özlem dolu yazıları görüp hayal kırıklığıyla okuyorum.</p>
                                            <div class="comment-meta">
                                            <span><a href="#">sil</a></span>
                                            <span><a href="#">kaydet</a></span>
                                            <span><a href="#">sikayer et</a></span>
                                            <span>
                                            <a class="" role="button" data-toggle="collapse" href="#replyCommentSix" aria-expanded="false" aria-controls="collapseExample">cevapla</a>
                                        </span>
                                            <div class="collapse" id="replyCommentSix">
                                                <form>
                                                <div class="form-group">
                                                    <label for="comment">Yorumunuz</label>
                                                    <textarea name="comment" class="form-control" rows="3"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-default">Yolla</button>
                                                </form>
                                            </div>
                                            </div>
                                            <!-- comment-meta -->

                                            <div class="media">
                                            <!-- answer to the first comment -->

                                            <div class="media-heading">
                                                <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseExample"><span class="fas fa-minus" aria-hidden="true"></span></button> <span class="label label-info">12314</span> vertu 12 sat once yazmis
                                            </div>

                                            <div class="panel-collapse collapse in" id="collapseSix">

                                                <div class="media-left">
                                                <div class="vote-wrap">
                                                    <div class="save-post">
                                                    <a href="#"><span class="fas fa-star" aria-label="Kaydet"></span></a>
                                                    </div>
                                                    <div class="vote up">
                                                    <i class="fas fa-chevron-up"></i>
                                                    </div>
                                                    <div class="vote inactive">
                                                    <i class="fas fa-chevron-down"></i>
                                                    </div>
                                                </div>
                                                <!-- vote-wrap -->
                                                </div>
                                                <!-- media-left -->


                                                <div class="media-body">
                                                <p>yazmayın artık amk, görmeyeyim sol framede. insan bi meraklanıyor, ümitleniyor. sonra yine özlem dolu yazıları görüp hayal kırıklığıyla okuyorum.</p>
                                                <div class="comment-meta">
                                                    <span><a href="#">sil</a></span>
                                                    <span><a href="#">kaydet</a></span>
                                                    <span><a href="#">sikayer et</a></span>
                                                    <span>
                                                <a class="" role="button" data-toggle="collapse" href="#replyCommentOne" aria-expanded="false" aria-controls="collapseExample">cevapla</a>
                                                </span>
                                                    <div class="collapse" id="replyCommentOne">
                                                    <form>
                                                        <div class="form-group">
                                                        <label for="comment">Yorumunuz</label>
                                                        <textarea name="comment" class="form-control" rows="3"></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-default">Yolla</button>
                                                    </form>
                                                    </div>
                                                </div>
                                                <!-- comment-meta -->


                                                </div>
                                            </div>
                                            <!-- comments -->

                                            </div>
                                            <!-- answer to the first comment -->

                                        </div>
                                        </div>
                                        <!-- comments -->

                                    </div>
                                    <!-- first comment -->
                                    </div>
                                </div>
                                <!-- comments -->

                                </div>
                                <!-- answer to the first comment -->

                            </div>
                            </div>
                            <!-- comments -->

                        </div>
                        <!-- first comment -->
                        </div>

                    </div>
                    <!-- post-comments -->
                </div>

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<?php $this->load->view("indirect/_parts/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("indirect/_parts/scrolltop.php") ?>
	<?php $this->load->view("indirect/_parts/modal.php") ?>

	<?php $this->load->view("indirect/_parts/js.php") ?>

	<script>
		function deleteConfirm(url)
		{
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>

</html>
