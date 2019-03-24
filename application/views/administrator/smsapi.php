<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('layout/header'); ?>
<body>

    <?php $this->load->view('layout/admin-sms'); ?>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <?php $this->load->view('layout/user'); ?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>API Endpoint</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                          <li><a href="administrator/">Dashboard</a></li>
                          <li class="active">API Endpoint</li>
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
          <form action="administrator/updateapi" method="post">
            <div class="card">
              <div class="card-header">
                <strong>Update API Endpoint</strong>
              </div>
              <div class="card-body card-block">
                <div class="row form-group">
                  <div class="col col-md-3"><label for="fullname" class=" form-control-label">API Endpoint</label></div>
                  <div class="col-12 col-md-6">
                    <?php echo $endpoint->endpoint ?>
                  </div>
                  <div class="col-12 col-md-3">
                    <a data-toggle="modal" data-target="#testModal" class="btn btn-info">Test SMS</a>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3"><label for="api_endpoint" class=" form-control-label">New API Endpoint</label></div>
                  <div class="col-12 col-md-9"><input type="text" id="api_endpoint" name="api_endpoint" placeholder="New API Endpoint" class="form-control" required></div>
                </div>
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

    <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <form action="administrator/testsms" method="post">
              <div class="modal-header">
                  <h5 class="modal-title" id="mediumModalLabel">Contact Number</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <input type="text" name="mobile" class="form-control" placeholder="Contact Number">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" id="modal1" class="btn btn-primary">Send</button>
              </div>
            </form>
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
