 <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <?php $slider = slider_content(); ?>
      <ol class="carousel-indicators">
        <?php if ($slider): ?>
          <?php $j=0; foreach ($slider as $slide): ?>
            <?php if ($j == 0): ?>
              <?php $class='class="active"'; ?>
            <?php else: ?>
              <?php $class=''; ?>
            <?php endif ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>" <?php echo $class; ?>></li>
          <?php $j++; endforeach ?>
        <?php else: ?>
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        <?php endif ?>
      </ol>
      <div   class="carousel-inner">
           <?php if ($slider): ?>
              <?php $i=1; foreach ($slider as $slide): ?>
              <?php if($i==1){$class = 'active';}else{$class='';} ?>
                <div class="item <?php echo $class; ?>">
                  <img style="width:100%;" src="<?php echo base_url() ?>assets/uploads/slider_images/<?php echo $slide->image; ?>" alt="">
                  <div class="container">
                    <div class="carousel-caption">
                      <!-- <h1>Example headline.</h1> -->
                      <!-- <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> -->
                      <?php if($i==1){ ?>
                        <a href="<?php echo base_url().'store/designs' ?>"><img src="<?php echo base_url() ?>assets/front_theme/img/G_sharing_1.png"></a>
                      <?php }else if($i==2){ ?>
                        <a href="<?php echo base_url().'store/signup' ?>"><img src="<?php echo base_url() ?>assets/front_theme/img/G_started_1.png"></a>

                      <?php }else if($i==3){ ?>
                        <a href="<?php echo base_url().'store/signup' ?>"><img src="<?php echo base_url() ?>assets/front_theme/img/G_register_1.png"></a>

                      <?php }else if($i==4){ ?>
                        <a href="<?php echo base_url().'store/design_your_own' ?>"><img src="<?php echo base_url() ?>assets/front_theme/img/G_creating_1.png"></a>

                      <?php }?>                   
                    </div>
                  </div>
                </div>
              <?php $i++; ?>
              <?php endforeach ?>
           <?php else: ?>
                <div style="margin:0% 10%;" class="item active">
                  <img src="<?php echo base_url() ?>assets/front_theme/img/slide1.jpg" alt="">
                  <div class="container">
                    <!-- <div class="carousel-caption">
                      <h1>Example headline.</h1>
                      <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                      <a class="btn btn-large btn-primary" href="#">Sign up today</a>
                    </div> -->
                  </div>
                </div>

                <div style="margin:0% 10%;" class="item">
                  <img src="<?php echo base_url() ?>assets/front_theme/img/slide2.jpg" alt="">
                  <div class="container">
                    <!-- <div class="carousel-caption">
                      <h1>Another example headline.</h1>
                      <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                      <a class="btn btn-large btn-primary" href="#">Learn more</a>
                    </div> -->
                  </div>
                </div>

                <div style="margin:0% 10%;" class="item">
                  <img src="<?php echo base_url() ?>assets/front_theme/img/slide3.jpg" alt="">
                  <div class="container">
                    <!-- <div class="carousel-caption">
                      <h1>One more for good measure.</h1>
                      <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                      <a class="btn btn-large btn-primary" href="#">Browse gallery</a>
                    </div> -->
                  </div>
                </div>
          <?php endif ?>
      </div>

      <a class="left carousel-control" href="#myCarousel" data-slide="prev" style="top:50%;" >&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next" style="top:50%;" >&rsaquo;</a>
    </div><!-- /.carousel -->

    <style type="text/css">

      .carousel-caption {
        background: none !important;
      }
      .carousel-caption a img{
              border: 2px solid !important;
              border-color: #E5E5E5 !important;
              border-radius: 35px 35px 35px 35px !important;
              float: right !important;
              margin-bottom: 40px !important;
      }
      .carousel-indicators{
        top: 380px !important;
      }
      .carousel-indicators li.active {
        background-color: #8BC43F !important;
      }
      .carousel-indicators li {
        background-color: #EEEEEE !important;
        border-radius: 10px !important;
        height: 15px !important;
        width: 15px !important;
      }
      /*.carousel-indicators{
            background-color: #3B5998;
            border: 1px solid #3B5998;
            border-radius: 29px 29px 29px 29px;
            padding: 1%;
      }*/
      .carousel-fade .item {-webkit-transition: opacity 3s; -moz-transition: opacity 3s; -ms-transition: opacity 3s; -o-transition: opacity 3s; transition: opacity 3s;}
      .carousel-fade .active.left {left:0;opacity:0;z-index:2;}
       .carousel-fade .next {left:0;opacity:1;z-index:1;}
    </style>