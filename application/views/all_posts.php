<!DOCTYPE html>
<html lang="en">

  <head>
    <?php $this->load->view("_parts/head.php") ?>  
  </head>
  
  <body>

    <?php $this->load->view("_parts/navbar.php") ?>  

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1><?php echo SITE_NAME ?></h1>
              <span class="subheading">A Blog Theme by Start Bootstrap</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <?php foreach($posts as $p) : ?>
            <div class="post-preview">
              <a href="<?php echo site_url('welcome/detailPost/'.$p->id_post) ?>">
                <div class='row'>
                  <div class="col-md-3">
                    <img src="<?php echo base_url('upload/posts/'.$p->image) ?>" class='img img-fluid'>
                  </div>
                  <div class="col-md-7">
                    <h2 class="post-title">
                      <?php echo $p->title ?>
                    </h2>
                    <p class="post-subtitle">
                      <?php echo substr($p->content, 0, 120) ?>...
                    </p>
                  </div>
                </div>
              </a>
              <p class="post-meta">Posted by
                <a href="#"><?php echo $p->user_name ?></a>
                on <?php echo date("d M Y", strtotime($p->date_created)) ?>
                | <?php echo $p->category ?>
              </p>
            </div>
          <?php endforeach; ?>
          <hr>
          <!-- Pager -->
          <div class="clearfix">
            <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
          </div>
        </div>
      </div>
    </div>

    <hr>

    <?php $this->load->view("_parts/footer.php") ?> 

    <?php $this->load->view("_parts/js.php") ?> 

  </body>

</html>
