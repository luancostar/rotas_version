<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.svg" alt="" height="26">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-sm.svg" alt="" height="26"> <span class="logo-txt">Vuesy</span>
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.svg" alt="" height="26">
                    </span>
                    <span class="logo-lg  ">
                        <img src="assets/images/logo.png" alt="" height="30"> <span class="logo-txt">ROTAS</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item" data-bs-toggle="collapse" id="horimenu-btn" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <div class="topnav">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle arrow-none" href="index.html" id="topnav-dashboard" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-home-circle icon"></i>
                                    <span data-key="t-dashboard">Home</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-tone icon"></i>
                                <span data-key="t-elements">Cadastros</span> <div class="arrow-down"></div>
                                </a>

                                <div style="width: 20rem;" class="justify-content-between dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl" aria-labelledby="topnav-uielement">
                                    <div class="ps-2 p-lg-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div>
                                                    <div class="menu-title">Listagem e Cadastro de:</div>
                                                    <div class="row g-0 d-flex justify-content-center">
                                                        <div class="col-lg-5">
                                                            <div>
                                                                <a href="ui-alerts.html" class="dropdown-item" data-key="t-alerts">Cidades</a>
                                                                <a href="ui-buttons.html" class="dropdown-item" data-key="t-buttons">Bairros</a>
                                                                <a href="ui-cards.html" class="dropdown-item" data-key="t-cards">Clientes</a>
                                                                <a href="ui-carousel.html" class="dropdown-item" data-key="t-carousel">Rotas</a>
                                                                <a href="ui-dropdowns.html" class="dropdown-item" data-key="t-dropdowns">Ocorrências</a>
                                                 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
 
                                                            <div>
                                                                <a href="ui-alerts.html" class="dropdown-item" data-key="t-alerts">Embalagens</a>
                                                                <a href="ui-buttons.html" class="dropdown-item" data-key="t-buttons">Motoristas</a>
                                                                <a href="ui-cards.html" class="dropdown-item" data-key="t-cards">Perguntas</a>
                                                                <a href="ui-carousel.html" class="dropdown-item" data-key="t-carousel">Usuários</a>
                                                                <a href="ui-dropdowns.html" class="dropdown-item" data-key="t-dropdowns">Veículos</a>
                                                 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
 
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="bx bx-customize icon"></i>
                                    <span data-key="t-apps">Acompanhamento</span> <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="apps-calendar.html" class="dropdown-item" data-key="t-calendar">Coletas em Tempo Real</a>
                                    <a href="apps-chat.html" class="dropdown-item" data-key="t-chat">Painel de Fechamento</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button"
                                >
                                    <i class="bx bx-layer icon"></i>
                                    <span data-key="t-components">Coletas</span> <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-components">
                                     
                                    <div class="dropdown">
                                    <a href="apps-calendar.html" class="dropdown-item" data-key="t-calendar">Listar Coletas</a>
                                    <a href="apps-calendar.html" class="dropdown-item" data-key="t-calendar">Nova Coleta</a>
                                        
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button"
                                >
                                    <i class="bx bx-file icon"></i>
                                    <span data-key="t-pages">Romaneio</span> 
                                </a>
                                
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>

        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block">
     
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                    <form class="p-2">
                        <div class="search-box">
                            <div class="position-relative">
                                <input type="text" class="form-control rounded bg-light border-0" placeholder="Search...">
                                <i class="bx bx-search search-icon"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    
            <div class="dropdown d-inline-block language-switch">
         
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell icon-sm"></i>
                    <span class="noti-dot bg-danger rounded-pill">1</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-15"> Últimas Atualizações </h5>
                            </div>
                            <div class="col-auto">
                                <a href="javascript:void(0);" class="small">  </a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 250px;">
 
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                   
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Atualizações</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Foi implementado um novo layout com foco na experiência do usuário<span class="badge badge-soft-success">documentação do update</span></p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle" id="right-bar-toggle">
                    <i class="bx bx-cog icon-sm"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-3.jpg"
                    alt="Header Avatar">
                    <span class="ms-2 d-none d-xl-inline-block user-item-desc">
                        <span class="user-name">Usuário<i class="mdi mdi-chevron-down"></i></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <h6 class="dropdown-header">Welcome Marie N!</h6>
                    <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                    <a class="dropdown-item" href="apps-chat.html"><i class="mdi mdi-message-text-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Messages</span></a>
                    <a class="dropdown-item" href="apps-kanban-board.html"><i class="mdi mdi-calendar-check-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Taskboard</span></a>
                    <a class="dropdown-item" href="pages-faqs.html"><i class="mdi mdi-lifebuoy text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-wallet text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Balance : <b>$6951.02</b></span></a>
                    <a class="dropdown-item d-flex align-items-center" href="contacts-settings.html"><i class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Settings</span><span class="badge badge-soft-success ms-auto">New</span></a>
                    <a class="dropdown-item" href="auth-lockscreen-cover.html"><i class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a>
                    <a class="dropdown-item" href="auth-signout-cover.html"><i class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Logout</span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="collapse show dash-content" id="dashtoggle">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Welcome !</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Welcome !</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- start dash info -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card dash-header-box shadow-none border-0">
                        <div class="card-body p-0">
                            <div class="row row-cols-xxl-6 row-cols-md-3 row-cols-1 g-0">
                                <div class="col">
                                    <div class="mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Campaign Sent </p>
                                        <h3 class="text-white mb-0">197</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Annual Profit</p>
                                        <h3 class="text-white mb-0">$489.4k</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Lead Coversation</p>
                                        <h3 class="text-white mb-0">32.89%</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Sales Forecast</p>
                                        <h3 class="text-white mb-0">75.35%</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-lg-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Daily Average Income</p>
                                        <h3 class="text-white mb-0">$1,596.5</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-lg-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Annual Deals</p>
                                        <h3 class="text-white mb-0">2,659</h3>
                                    </div>
                                </div><!-- end col -->

                            </div><!-- end row -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end dash info -->
        </div>
    </div>

      <!-- start dash troggle-icon -->
      <div>
        <a class="dash-troggle-icon" id="dash-troggle-icon" data-bs-toggle="collapse" href="#dashtoggle" aria-expanded="true" aria-controls="dashtoggle">
            <i class="bx bx-up-arrow-alt"></i>
        </a>
    </div>
  <!-- end dash troggle-icon -->

</header>