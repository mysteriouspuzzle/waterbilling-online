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

                    <h4>Water Billing</h4>
                  </div>
                  <?php if($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger">
                       <a href="#" class="close" data-dismiss="alert">&times;</a>
                       <strong>Sorry!</strong> <?php echo $this->session->flashdata('error'); ?>
                   </div>
                  <?php } ?>

                  <div>
                    The receipt was sent via email. Thank you!
                  </div>



                  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
  <section id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div id="paypal-button-container"></div>
          <script>
              var bal =  '<?php echo $bill->bill ?>';
              paypal.Button.render({

                  env: 'sandbox', // sandbox | production

                  // PayPal Client IDs - replace with your own
                  // Create a PayPal app: https://developer.paypal.com/developer/applications/create
                  client: {
                      sandbox:    'AZAuyMwdMbtZPTRrf-AP5H9VK7XUBvHgp78LJoa0RWojFQpSR00QSBjq5ZsqpTJbPJRtfs7lg4XOMLjL',
                      production: '<insert production client id>'
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
                          window.alert('Payment Complete!');
                          window.location = "http://localhost/waterbilling/paypal/receipt";
                      });
                  }

              }, '#paypal-button-container');

          </script>
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
