<!DOCTYPE html>
<html lang="en">

  <head>

    <?php $this->load->view('_parts/head.php') ?>

  </head>

  <body>

    <?php $this->load->view("_parts/navbar.php") ?>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/post-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <h1><?php echo $detail->title ?></h1>
              <h2 class="subheading"><?php echo $detail->category ?></h2>
              <span class="meta">Posted by
                <a href="#"><?php echo $detail->user_name ?></a>
                on <?php echo date("l, F jS Y", strtotime($detail->date_created)) ?></span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <?php echo $detail->content ?>
          </div>
        </div>
        
      </div>
    </article>
    <hr>

    <div class='container'>
      <div class='row'>
        <form class="col-lg-8 col-md-10 mx-auto" action="<?php echo site_url('welcome/addComment/'. $detail->id_post) ?>" method='post'>
          <input type='hidden' id='parent_id' value='' name='parent_id'>
          <input type='hidden' id='id_post' value='<?php echo $detail->id_post ?>' name='id_post'>
          <input type='hidden' id='id_user' value='2' name='id_user'>
          <div class='form-group'>
            <label for='comment'>Leave a comment :</label>
            <textarea name='comment' class="form-control <?php echo form_error('comment') ? 'is-invalid':'' ?>"></textarea>
          </div>
          <input type="submit" value="Comment" class="btn btn-primary">
        </form>
      </div>
      
      <?php if ($comment__) : ?>
      <!-- Comment Content -->
      
          <div class='row'>
              <div class="col-lg-8 col-md-10 mx-auto">
                  <?php echo $comment__ ?>
              </div>
          </div>

      <?php endif; ?>
    </div>
    

   

    <?php $this->load->view("_parts/footer.php") ?> 

    <?php $this->load->view("_parts/js.php") ?> 
    <script>
      $(function() {
        $("a.reply").click(function() {
          var id = $(this).attr('id');
          $('#parent_id').attr('value', id);
          console.log(id);
        });
      });
    </script>
  </body>

</html>
