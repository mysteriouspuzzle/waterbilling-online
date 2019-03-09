<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('layout/header'); ?>
<body>

    <?php $this->load->view('layout/admin-sales'); ?>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <?php $this->load->view('layout/user'); ?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Sales</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                          <li><a href="administrator/">Dashboard</a></li>
                          <li class="active">Sales</li>
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
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <strong class="card-title">List of Sales</strong>
            </div>
            <div class="card-body table-responsive">
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Location Sales</th>
                  <th>Type</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($sales as $sale){ ?>
                <tr>
                  <td><?php echo date('F d, Y', strtotime($sale->date)) ?></td>
                  <td><?php echo date('h:i A', strtotime($sale->time)) ?></td>
                  <td><?php echo $sale->location ?></td>
                  <td><?php echo $sale->type ?></td>
                  <td><?php echo $sale->amount ?></td>
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
            <form class="" action="administrator/updateTrip" method="post">
              <div class="modal-header">
                  <h5 class="modal-title" id="mediumModalLabel">Confirmation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="date" id="mdate" value="">
                <input type="hidden" name="time" id="mtime" value="">
                  This will send SMS notification to the passengers of the specific date and time scheduled.<br>
                  Are you sure to proceed?
              </div>
              <div class="modal-footer">
                  <a target="_blank" id="sms"></a>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" id="modal1" class="btn btn-primary">Yes</button>
                  <input type="submit" style="display:none" value="submit" id="msubmit">
              </div>
            </form>
          </div>
      </div>
  </div>

<script type="text/javascript" src="assets/js/validator.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#modal1').click(function(){
      document.getElementById('sms').click();
      $('#msubmit').click();

    });
    $('#myModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var date = button.data('date')
      var time = button.data('time')
      var tid = button.data('tid')
      var modal = $(this)
      modal.find('#mdate').val(date)
      modal.find('#mtime').val(time)
      modal.find('#sms').prop('href','administrator/sms?date='+date+'&time='+tid);
    })
    $('#bootstrap-data-table').DataTable( {
        destroy: true,
        "order": [[ 0, "desc" ]]
    } );
  })
</script>
