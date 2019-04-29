<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('layout/header'); ?>
  <!-- <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300"> -->
  <style>
    .main-menu li {
      display: inline-block !important;
      margin: 15px 0;
    }
  </style>
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
      
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-25"><a href="index.html" style="color:black">Water Billing System</a></div>

          <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="#home-section" class="nav-link">Home</a></li>
                <li><a href="#about-us-section" class="nav-link">About Us</a></li>
                <!-- <li><a href="#programs-section" class="nav-link">Programs</a></li>
                <li><a href="#teachers-section" class="nav-link">Teachers</a></li> -->
              </ul>
            </nav>
          </div>

          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                <li class="cta"><a href="#contact-section" class="nav-link"><span>Contact Us</span></a></li>
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>

    <div class="site-section bg-light" id="contact-section">
      <div class="container">

        <div class="row justify-content-center">
          <div class="col-md-7">


            
            <h2 class="section-title mb-3">Enroll Account</h2>
            <form action="login/checkenroll" method="post" data-aos="fade">

              <div class="form-group row">
                <div class="col-md-12">
                  <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success">
                      <a href="#" class="close" data-dismiss="alert">&times;</a>
                      <span class="ti ti-check"></span> <?php echo $this->session->flashdata('success'); ?>
                  </div>
                  <?php } ?>
                  <?php if($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger">
                      <a href="#" class="close" data-dismiss="alert">&times;</a>
                      <span class="ti ti-info"></span> <?php echo $this->session->flashdata('error'); ?>
                  </div>
                  <?php } ?>
                  <?php if($this->session->flashdata('error1')){ ?>
                    <div class="alert alert-danger">
                      <a href="#" class="close" data-dismiss="alert">&times;</a>
                      <span class="ti ti-info"></span> <?php echo $this->session->flashdata('error'); ?>
                  </div>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="number" class="form-control" name="account_number" placeholder="Account Number">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="email" class="form-control" name="email" placeholder="Email Address">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  
                  <input type="submit" class="btn btn-primary py-3 px-5 btn-block btn-pill" value="Enroll Account">
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    <?php $this->load->view('layout/footer'); ?>