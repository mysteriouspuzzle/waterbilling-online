<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">

                    </a>
                </div>
                <div class="login-form">
                  <div align="center">
                    <h4>Forgot Password</h4>
                  </div>
                  <?php if($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger">
                       <a href="#" class="close" data-dismiss="alert">&times;</a>
                       <strong>Sorry!</strong> <?php echo $this->session->flashdata('error'); ?>
                   </div>
                  <?php } ?>
                    <form method="get" action="login/checkemail">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">GET CODE</button>
                        <!-- <div class="social-login-content">
                            <div class="social-button">
                                <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                                <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
                            </div>
                        </div>
                        <div class="register-link m-t-15 text-center">
                            <p>Don't have account ? <a href="#"> Sign Up Here</a></p>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


</body>
</html>
