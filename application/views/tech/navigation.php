<nav class="navbar navbar-expand-md bg-dark  navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="<?php echo base_url('/technician/'); ?>">Wifi Vendo</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('/technician/reports'); ?>"><i class='fa fa-file'></i> Report</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('/technician/voucher'); ?>"><i class='fa fa-cogs'></i> Voucher</a>
      </li>      
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('/technician/settings'); ?>"><i class='fa fa-cogs'></i> Controller</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('/wifivendo/logout'); ?>"><i class='fa fa-sign-out'></i> Logout</a>
      </li> 
    </ul>
  </div> 
</nav>


  <div class="content-wrapper">
    <div  class="container">