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
          <div class="site-logo mr-auto w-25"><a href="login/login" style="color:black">Water Billing System</a></div>

          <!-- <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="consumer/account" class="nav-link">Account</a></li>
              </ul>
            </nav>
          </div> -->

          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
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
          <div class="col-md-8">

            <h5 class="mb-3">Bill on <?php echo date('F d, Y', strtotime($bill->present_date)) ?></h5>

            <div class="row">
              <div class="col-md-6">
                <h5>Account No.: </h5><span class="p-1 bg-info text-white"><?php echo $consumer->account_number ?></span>
              </div>
              <div class="col-md-6">
                <h5>Name: </h5><span class="p-1 bg-info text-white"><?php echo $consumer->lastname. ', ' . $consumer->firstname ?></span>
              </div>
            </div><hr>
            <div class="row">
              <div class="col-md-6">
                <h5>Period To:</h5> <span class="p-1 bg-info text-white"><?php echo $bill->present_date ?></span>
              </div>
              <div class="col-md-6">
                <h5>Period From:</h5> <span class="p-1 bg-info text-white"><?php echo $bill->previous_date ?></span>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <h5>Present Reading:</h5> <span class="p-1 bg-info text-white"><?php echo $bill->present_meter ?></span>
              </div>
              <div class="col-md-6">
                <h5>Previous Reading:</h5> <span class="p-1 bg-info text-white"><?php echo $bill->previous_meter ?></span><br>
                <h5>Consumption:</h5> <span class="p-1 bg-info text-white"><?php echo $bill->consumption ?></span>
              </div>
            </div><hr>
            <div class="row">
              <div class="col-md-6">
                <h5>TOTAL AMOUNT DUE:</h5> <span class="p-1 bg-info text-white"><?php echo $bill->bill ?></span>
              </div>
              <div class="col-md-6">
                <h5>DUE DATE:</h5> <span class="p-1 bg-info text-white"><?php echo date('M d, Y', strtotime($bill->due_date)) ?></span>
              </div>
            </div><br><br>
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <?php $encbill = base64_encode($bill->bill_id) ?>
                <!-- <a href="paypal?sandbox=AZAuyMwdMbtZPTRrf-AP5H9VK7XUBvHgp78LJoa0RWojFQpSR00QSBjq5ZsqpTJbPJRtfs7lg4XOMLjL&bill=<?php echo $encbill ?>&consumer=<?php echo $consumer->id ?>" class="btn btn-default" style="border: 1px solid rgba(0, 0, 0, 0.1)">
                  <img id="paypal-button-container" style="width:100%" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppmcvdam.png" alt="Buy now with PayPal" /><br>
                  <span style="font-style:italic; font-weight:normal" class="text-info">Pay via Paypal/Credit Card</span> 
                </a> -->
              </div>
            </div>

            <script src="https://www.paypalobjects.com/api/checkout.js"></script>

          <div id="paypal-button-container"></div>
          <script>
              var bal =  '<?php echo $bill->bill ?>';
              var billId = '<?php echo $bill->bill_id ?>';
              paypal.Button.render({

                  env: 'sandbox', // sandbox | production

                  // PayPal Client IDs - replace with your own
                  // Create a PayPal app: https://developer.paypal.com/developer/applications/create
                  client: {
                      sandbox:    'AZAuyMwdMbtZPTRrf-AP5H9VK7XUBvHgp78LJoa0RWojFQpSR00QSBjq5ZsqpTJbPJRtfs7lg4XOMLjL',
                      production: '<insert production client id>'
                  },

                  style: {
                    size: 'responsive',
                    label: 'pay',
                    layout: 'horizontal',
                    fundingicons: 'true',
                  },

                  funding: {
                    allowed: [ paypal.FUNDING.CARD, paypal.FUNDING.CREDIT ],
                  },

                  // Show the buyer a 'Pay Now' button in the checkout flow
                  commit: true,

                  // payment() is called when the button is clicked
                  payment: function(data, actions) {

                      // Make a call to the REST api to create the payment
                      return actions.payment.create({
                          payment: {
                              transactions: [
                                  {
                                      amount: { total: bal, currency: 'PHP' }
                                  }
                              ]
                          }
                      });
                  },

                  // onAuthorize() is called when the buyer approves the payment
                  onAuthorize: function(data, actions) {

                      // Make a call to the REST api to execute the payment
                      return actions.payment.execute().then(function() {
                          window.alert('Payment Complete! e-receipt sent on your email.');
                          window.location = "http://localhost/waterbilling-online/paypal/receipt/" + billId;
                      });
                  }

              }, '#paypal-button-container');

          </script>
            
           
          </div>
        </div>
      </div>
    </div>
    <?php $this->load->view('layout/footer'); ?>

    