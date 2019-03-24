<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('layout/header'); ?>
<body>

    <?php $this->load->view('layout/reader-consumers'); ?>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <?php $this->load->view('layout/user'); ?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Read Meter</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                          <li><a href="administrator/">Dashboard</a></li>
                          <li><a href="reader/viewconsumers">View Consumers</a></li>
                          <li class="active">Read Meter</li>
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
        </div>
        <div class="col-lg-3 col-sm-12">
            <div class="card">
                <div class="card-body card-block">
                    <form action="reader/readmeter/<?php echo $id ?>" method="post">
                        <div>
                            <label for="">Previous Reading</label>
                            <div style="word-spacing: 15px" class="">
                                <?php 
                            if($prev_meter == 0) { ?>
                                <input type="text" value="0000" style="text-align:right" class="form-control" readonly> <?php
                            }else{ ?>
                                <input type="text" value="<?php echo $prev_meter ?>" style="text-align:right" class="form-control" readonly> <?php
                            } ?>
                        </div>
                    </div><br>
                    <div>
                        <label for="">Current Reading</label>
                        <div style="word-spacing: 15px" class="">
                            <input type="text" style="text-align:right" maxlength="4" class="form-control" name="current_meter" required autofocus>
                        </div>
                    </div><br/>
                    <div>
                        <button type="submit" class="btn btn-block btn-primary">Calculate</button>
                    </div>
                </form>
                    
              </div>
            </div>
        </div>

        <div class="col-lg-9 col-sm-12">
            <div class="card">
                <div class="card-body card-block">
                    <div>
                        <label for="">Consumer</label>
                        <div style="padding: 2px 10px" class="text-white bg-info">
                            <?php echo $consumer->lastname . ', ' . $consumer->firstname . ' ' . ($consumer->middlename =='' ? '':$consumer->middlename[0] . '.') ?>
                        </div>
                    </div><br>
                    <div>
                        <label for="">Previous Reading</label>
                        <div style="padding: 2px 10px" class="text-white bg-info">
                            <?php echo $prev_meter ?>
                        </div>
                    </div><br>
                    <div>
                        <label for="">Current Reading</label>
                        <div style="padding: 2px 10px" class="text-white bg-info">
                            <?php 
                            if($current_meter == ''){
                                ?> No current reading yet. <?php
                            }else{
                                echo $current_meter;
                            } ?>
                        </div>
                    </div><br/>
                    <div>
                        <label for="">Bill</label>
                        <div style="padding: 2px 10px" class="text-white bg-info">
                            <?php 
                            if($current_meter == ''){
                                ?> No current reading yet. <?php
                            }else{
                                echo '₱'.sprintf('%.2f', $bill);
                            } ?>
                        </div>
                    </div><br/>
                    <div>
                        <a class="btn btn-block btn-primary" href="reader/sendreceipt">Send Email & SMS</a>
                    </div>
              </div>
            </div>
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
<script type="text/javascript" src="assets/js/vendor/jquery-ui.min.js"></script>
<script type="text/javascript" src="assets/js/validator.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#modal1').click(function(){
      $('#submit').click();
    });
    $( ".datepicker" ).datepicker({
      dateFormat: 'yy-mm-dd'
    });
  })
</script>
