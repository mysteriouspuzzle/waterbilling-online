<style>
  @media only screen and (max-width:1000px){
    #date_time{
      display: none !important;
    }
  }
</style>
<!-- Header-->
<header id="header" class="header">

    <div class="header-menu">
        <div class="col-sm-12 col-md-7 text-info">
          <span class="text-danger"></span> <span id="date_time"></span>
        </div>
        <div class="">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- <img class="user-avatar rounded-circle" src="assets/img/admin.jpg" alt="User Avatar"> -->
                    <?php echo $_SESSION['wbUser'] ?> (<?php echo $_SESSION['wbUserLevel'] ?>) <span class="ti ti-angle-down" style="font-size:10px"></span>
                </a>

                <div class="user-menu dropdown-menu">

                  <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>
                  <?php if($_SESSION['wbUserLevel']=='Administrator'){ ?>
                    <a class="nav-link" href="administrator/logout"><i class="fa fa-power -off"></i>Logout</a>
                  <?php }else{ ?>
                    <a class="nav-link" href="user/logout"><i class="fa fa-power -off"></i>Logout</a>
                  <?php } ?>
                </div>
            </div>

            <div class="language-select dropdown" id="language-select">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                    <i class="flag-icon flag-icon-us"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="language" >
                    <div class="dropdown-item">
                        <span class="flag-icon flag-icon-fr"></span>
                    </div>
                    <div class="dropdown-item">
                        <i class="flag-icon flag-icon-it"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

</header><!-- /header -->
