<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('layout/header'); ?>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-25 d-none d-md-block d-lg-block"><a href="login/login" style="color:black">Water Billing System</a></div>
          <div class="site-logo mr-auto w-25 d-md-none d-sm-block d-xs-block"><a href="login/login" style="color:black">WBS</a></div>

          <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-block  m-0 p-0">
                <li><a href="#home-section" class="nav-link">Home</a></li>
                <li><a href="#about-us-section" class="nav-link">About Us</a></li>
                <!-- <li><a href="#programs-section" class="nav-link">Programs</a></li>
                <li><a href="#teachers-section" class="nav-link">Teachers</a></li> -->
              </ul>
            </nav>
          </div>

          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-block m-0 p-0">
                <li class="cta"><a href="#contact-section" class="nav-link"><span>Contact Us</span></a></li>
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>
      
    </header>

    <div class="intro-section" id="home-section">
      
      <div class="slide-1" style="background-image: url('assets/images/hero_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                  <h1  data-aos="fade-up" data-aos-delay="100">Save time by managing your account needs</h1>
                  <p class="mb-4"  data-aos="fade-up" data-aos-delay="200">Get free 24/7 secure online access to your account.</p>
                  <p class="mb-4"  data-aos="fade-up" data-aos-delay="200">Review and pay your bill online.</p>
                  <p data-aos="fade-up" data-aos-delay="300"><a href="login/enroll" class="btn btn-primary py-3 px-5 btn-pill">Enroll here</a></p>

                </div>

                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                  <form action="login/login" method="post" class="form-box">
                    <h3 class="h4 text-black mb-4">Sign In</h3>
                    <div class="form-group">
                      <input type="text" class="form-control" name="email" placeholder="Email Addresss">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <?php if($this->session->flashdata('error')){ ?>
                    <div class="text text-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary btn-pill" value="Sign In">
                    </div>
                  </form>

                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    
    <div class="site-section courses-title" id="about-us-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">About Us</h2>
          </div>
        </div>
      </div>
      <div class="offset-md-1 col-md-10">
    
        <div class="row">
  
          <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
  
            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="assets/images/about_us1.jpg" alt="Image" style="width:100%"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <h3><a href="#">Services</a></h3>
                <p>Involve the implementation of water loss reduction activities—such as leak repair, valve replacement, installation of new connections, and replacement of water meters.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
  
            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="assets/images/about_us3.jpg" alt="Image" style="width:100%"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <h3><a href="#">Profile</a></h3>
                <p>Includes the planning, design, construction, commissioning, and process-proving of water facilities.</p>
              </div>
            </div>
          </div>
  
          <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="assets/images/about_us2.jpg" alt="Image" style="width:100%"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <h3><a href="#">Facilities</a></h3>
                <p>Uses simulation software to design new water systems and to optimize existing water networks.</p>
              </div>
            </div>
          </div>
  
        </div>
      </div>
    </div>

    <div class="site-section bg-light" id="contact-section">
      <div class="container">

        <div class="row justify-content-center">
          <div class="col-md-7">


            
            <h2 class="section-title mb-3">Message Us</h2>
            <p class="mb-5">Natus totam voluptatibus animi aspernatur ducimus quas obcaecati mollitia quibusdam temporibus culpa dolore molestias blanditiis consequuntur sunt nisi.</p>
          
            <form method="post" data-aos="fade">
              <div class="form-group row">
                <div class="col-md-6 mb-3 mb-lg-0">
                  <input type="text" class="form-control" placeholder="First name">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Last name">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Subject">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="email" class="form-control" placeholder="Email">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <textarea class="form-control" id="" cols="30" rows="10" placeholder="Write your message here."></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  
                  <input type="submit" class="btn btn-primary py-3 px-5 btn-block btn-pill" value="Send Message">
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    <?php $this->load->view('layout/footer'); ?>