<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('layout/header'); ?>
<body>

    <?php $this->load->view('layout/admin-users'); ?>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <?php $this->load->view('layout/user'); ?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Account</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                          <li><a href="administrator/">Dashboard</a></li>
                          <li class="active">Add Account</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
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
        </div>
        <div class="col-lg-8">
          <form action="administrator/storeaccount" method="post">
            <div class="card">
              <div class="card-header">
                <strong>New Account</strong> Form
              </div>
              <div class="card-body card-block">
                <form action="administrator/storeaccount" method="post" class="form-horizontal">
                  <div class="row form-group">
                    <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Account Type</label></div>
                    <div class="col-12 col-md-9">
                      <select class="form-control" name="accounttype" required>
                        <option value="">Select Account Type</option>
                        <option value="Administrator">Administrator</option>
                        <option value="Reader">Reader</option>
                        <option value="Teller">Teller</option>
                        <option value="Accounting">Accounting</option>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-3"><label for="fullname" class=" form-control-label">Full Name</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="fullname" name="fullname" placeholder="Full Name" class="form-control text-capitalize" required></div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-3"><label for="email" class=" form-control-label">Email Address</label></div>
                    <div class="col-12 col-md-9"><input type="email" id="email" name="email" placeholder="Email Address" class="form-control" required></div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-3"><label for="username" class=" form-control-label">Username</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="username" name="username" placeholder="Username" class="form-control" required></div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-3"><label for="password" class=" form-control-label">Password</label></div>
                    <div class="col-12 col-md-9"><input type="password" id="password" name="password" placeholder="Password" class="form-control" required></div>
                    <!-- <div class="help-block">Minimum of 6 characters</div> -->
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-3"><label for="cpassword" class=" form-control-label">Confirm Password</label></div>
                    <div class="col-12 col-md-9"><input type="password" name="cpassword" placeholder="Confirm Password" class="form-control" id="inputPasswordConfirm" data-match="#password" data-match-error="Whoops, these don't match" ></div>
                    <!-- <div class="help-block with-errors"></div> --> 
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-dot-circle-o"></i> Submit
                </button>
                <input type="submit" name="submit" id="submit" style="display:none">
                <button type="reset" class="btn btn-danger btn-sm">
                  <i class="fa fa-ban"></i> Reset
                </button>
              </div>
            </div>
          </form>
        </div>

      </div> <!-- .content -->
    </div><!-- /#right-panel -->
    <?php $this->load->view('layout/footer'); ?>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="mediumModalLabel">Confirm first</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  Are you sure?
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" id="modal1" class="btn btn-primary">Confirm</button>
              </div>
          </div>
      </div>
  </div>

<script type="text/javascript" src="assets/js/validator.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#modal1').click(function(){
      $('#submit').click();
    });
  })
</script>
