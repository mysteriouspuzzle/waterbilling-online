<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
<nav class="navbar navbar-expand-sm navbar-default">

    <?php $this->load->view('layout/title'); ?>

    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="">
                <a href="administrator/"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
            </li>
            <li class="menu-item-has-children dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Accounts</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><a href="administrator/addaccount">Add Account</a></li>
                    <li><a href="administrator/accounts">View Accounts</a></li>
                </ul>
            </li>
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Consumers</a>
                <ul class="sub-menu children dropdown-menu">
                  <li><a href="teller/addconsumer">Add Consumer</a></li>
                    <li><a href="teller/viewconsumers">View Consumers</a></li>
                </ul>
            </li>
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tint"></i>Rates</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><a href="administrator/addrate">New Rate</a></li>
                    <li><a href="administrator/rates">View Rates</a></li>
                </ul>
            </li>
            <li class="">
                <a href="administrator/sales"> <i class="menu-icon ti ti-money"></i>Sales </a>
            </li>
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-envelope"></i>SMS</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><a href="administrator/smsapi">SMS API</a></li>
                    <li><a href="administrator/sms">Send SMS</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->
