<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

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
          <div class="site-logo mr-auto w-25 d-none d-md-block d-lg-block"><a href="login/login" style="color:black">Water Billing System</a></div>
          <div class="site-logo mr-auto w-25 d-md-none d-sm-block d-xs-block"><a href="login/login" style="color:black">WBS</a></div>

          <!-- <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-block  m-0 p-0">
                <li><a href="consumer/account" class="nav-link">Account</a></li>
              </ul>
            </nav>
          </div> -->

          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-block m-0 p-0">
                <li class="cta"><a href="user/logout" class="nav-link"><span>Logout</span></a></li>
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>

    <div class="site-section bg-light" id="contact-section">
      <div class="container">

        <div class="row justify-content-center">
          <div class="col-md-12">

            <div class="row">
              <div class="col-md-6">
                <h5>Account No.:</h5> <?php echo $consumer->lastname. ', ' . $consumer->firstname ?>
              </div>
              <div class="col-md-6">
                <h5>Name:</h5> <?php echo $consumer->account_number ?>
              </div>
            </div><hr>

            <h4 class="mb-3">Account Bills & History</h4>
            <div class="table-responsive-md">
              <table class="table table-striped table-hover table-sm">
                <thead>
                  <tr>
                    <th>Period From</th>
                    <th>Period To</th>
                    <th>Previous Reading</th>
                    <th>Present Reading</th>
                    <th>Consumption</th>
                    <th>Total Amount</th>
                    <th>Due Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($records as $record){ ?>
                  <tr>
                    <td><?php echo $record->previous_date ?></td>
                    <td><?php echo $record->present_date ?></td>
                    <td><?php echo $record->previous_meter ?></td>
                    <td><?php echo $record->present_meter ?></td>
                    <td><?php echo $record->consumption ?></td>
                    <td><?php echo '₱'.$record->bill ?></td>
                    <td><?php echo $record->due_date ?></td>
                    <?php if($record->status == 'Unpaid'){ ?>
                      <td><a href="consumer/paymentdetails/<?php echo $record->bill_id ?>" class="btn btn-info">Pay</a></td>
                    <?php }else{ ?>
                      <td>Paid</td>
                    <?php } ?>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php $this->load->view('layout/footer'); ?>