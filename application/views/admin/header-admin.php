    <body>

      <section id="container" >

        <header class="header black-bg">
          
            <div class="sidebar-toggle-box">
                <i class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation" id="esconder"></i>
            </div>

            <!--logo start-->
            <a href="<?php echo base_url('Admin'); ?>" class="logo"><b>WELCOMEJ</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme">4</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 4 pending tasks</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">DashGum Admin Panel</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Database Update</div>
                                        <div class="percent">60%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Product Development</div>
                                        <div class="percent">80%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Payments Sent</div>
                                        <div class="percent">70%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            <span class="sr-only">70% Complete (Important)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
             <ul class="nav pull-right top-menu">
              <li><a class="logout" href="<?= base_url('Admin/logout') ?>">Sair <span class="glyphicon glyphicon-log-out"></span></a></li>
            </ul>
          </div>
        </header>
    <!--header end-->

        <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
        <!--sidebar start-->

        <aside>
          <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

               <p class="centered"><img src="<?= base_url()?>" class="img-circle" width="60"></p>
               <h5 class="centered">ADMIN</h5>


               <li class="sub-menu">
                <a href="<?= base_url('Admin/eventos') ?>" >
                  <i class="fas fa-newspaper" style="margin-right: 5px;"></i>
                  <span>Eventos</span>
                </a>
              </li>
         

              <li class="sub-menu">
                <a href="<?= base_url('Admin/congressistas') ?>" >
                  <i class="fas fa-briefcase" style="margin-right: 5px;"></i>
                  <span>Congressistas</span>
                </a>
              </li>

              <li class="sub-menu">
                <a href="<?= base_url('Admin/comprovantes') ?>" >
                  <i class="fa fa-users" style="margin-right: 5px;"></i>
                  <span>Comprovantes</span>
                </a>
              </li>

              <li class="sub-menu">
                <a href="<?= base_url('Admin/relatorios') ?>" >
                  <i class="fa fa-bolt" style="margin-right: 5px;"></i>
                  <span>Relatórios</span>
                </a>
              </li>

              <li class="sub-menu">
                <a href="<?= base_url('Admin/presencaEvento') ?>" >
                  <i class="fas fa-user" style="margin-right: 5px;"></i>
                  <span>Presença</span>
                </a>
              </li>
          </ul>
          <!-- sidebar menu end-->
        </div>
      </aside>
      <!--sidebar end-->

      