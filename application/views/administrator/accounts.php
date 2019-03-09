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
                        <h1>Accounts</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                          <li><a href="administrator/">Dashboard</a></li>
                          <li class="active">Accounts</li>
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
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <strong class="card-title">Data Table</strong>
            </div>
            <div class="card-body table-responsive">
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
              <thead>
            <tr>
              <th>Full Name</th>
              <th>username</th>
              <th>User Level</th>
              <th>User Email Address</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($accounts as $account){ ?>
            <tr>
              <td><?php echo $account->fullname ?></td>
              <td><?php echo $account->username ?></td>
              <td><?php echo $account->userLevel ?></td>
              <td><?php echo $account->email ?></td>
              <td><button data-toggle="modal" data-target="#myModal" data-email="<?php echo $account->email ?>" data-id="<?php echo $account->id ?>" data-fullname="<?php echo $account->fullname ?>" data-username="<?php echo $account->username ?>" data-userlevel="<?php echo $account->userLevel ?>" class="btn btn-info"><span class="ti ti-pencil"></span> Edit</button></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>

      </div> <!-- .content -->
    </div><!-- /#right-panel -->
    <?php $this->load->view('layout/footer'); ?>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="mediumModalLabel">Update Account</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form class="" action="administrator/updateaccount" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" id="hid">
                    <div class="row">
                      <div class="col-md-12 form-group">
                        <label for="fullname">Fullname</label>
                        <input type="text" name="fullname" id="fullname" placeholder="Fullname" class="form-control">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Username" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 form-group">
                        <label for="userlevel">User Level (<span class="text-info userlvl"></span>)</label>
                        <select class="form-control" name="accounttype">
                          <option value="" selected>Select User Level</option>
                          <?php
                          foreach($userlevel as $ul){
                            // if($ul->userlevel == $)
                            ?> <option value="<?php echo $ul->user_level ?>"><?php echo $ul->user_level ?></option> <?php
                          }
                           ?>
                        </select>
                        <!-- <input type="text" name="userlevel" id="userlevel" placeholder="User Level" class="form-control"> -->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Email Address" class="form-control">
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
              </form>
          </div>
      </div>
  </div>

<script type="text/javascript" src="assets/js/validator.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id')
      var fullname = button.data('fullname')
      var username = button.data('username')
      var userlevel = button.data('userlevel')
      var userlocation = button.data('userlocation')
      var email = button.data('email')
      var modal = $(this)
      modal.find('#hid').val(id)
      modal.find('#fullname').val(fullname)
      modal.find('#username').val(username)
      modal.find('.userlvl').html(userlevel)
      modal.find('.userloc').html(userlocation)
      modal.find('#email').val(email)
    })
  })
</script>
