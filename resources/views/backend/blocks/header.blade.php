 <header class="topbar" data-navbarbg="skin6">
     <nav class="navbar top-navbar navbar-expand-md navbar-dark">
         <div class="navbar-header" data-logobg="skin6">
             <a class="navbar-brand ms-4" href="index.html">
                 <b class="logo-icon">
                     <img src="{{ asset('backend/images/logo-light-icon.png') }}" alt="homepage" class="dark-logo" />
                 </b>
                 <span class="logo-text">
                     <img src="{{ asset('backend/images/logo-light-text.png') }}" alt="homepage" class="dark-logo" />

                 </span>
             </a>
             <a class="nav-toggler waves-effect waves-light text-white d-block d-md-none" href="javascript:void(0)"><i
                     class="ti-menu ti-close"></i></a>
         </div>
         <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
             <ul class="navbar-nav d-lg-none d-md-block ">
                 <li class="nav-item">
                     <a class="nav-toggler nav-link waves-effect waves-light text-white " href="javascript:void(0)"><i
                             class="ti-menu ti-close"></i></a>
                 </li>
             </ul>
             <ul class="navbar-nav me-auto mt-md-0 ">
                 <li class="nav-item search-box">
                     <a class="nav-link text-muted" href="javascript:void(0)"><i class="ti-search"></i></a>
                     <form class="app-search" style="display: none;">
                         <input id="dynamic-placeholder" type="text" class="form-control"
                             placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                     </form>
                 </li>
             </ul>
             <ul class="navbar-nav">

             </ul>
             <ul class="navbar-nav d-flex align-items-center">
                 <li class="nav-item dropdown px-3">
                     <a href="{{ route('home') }}" style="color: #000" class="btn bg-light" target="_blank">Visit
                         website</a>
                 </li>
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#"
                         id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                         <img src="{{ asset('storage/users/' . Auth::user()->avatar) }}" alt="user"
                             class="profile-pic me-2">{{ Auth::user()->name }}
                     </a>
                     <ul class="dropdown-menu" id="action-link" aria-labelledby="navbarDropdown">
                         <li class="nav-item"><a href="" class="nav-link">Profile</a></li>
                         <li class="nav-item"><a href="" class="nav-link">Logout</a></li>
                     </ul>
                     <style>
                         .dropdown-menu#action-link {
                             left: unset !important;
                             right: 0 !important;
                             padding: 10px 0px;
                         }

                         .dropdown-menu#action-link li {
                             transition: all 0.4s ease;
                         }

                         .dropdown-menu#action-link li a {
                             color: #54667a !important;
                             padding-left: 15px;
                             font-size: 1.1875rem;
                             font-weight: 300;
                             padding-top: 5px !important;
                             padding-bottom: 5px !important;
                             transition: all 0.4s ease;
                         }

                         .dropdown-menu#action-link li:hover {
                             background: #26c6da;
                         }

                         .dropdown-menu#action-link li:hover a {
                             color: white !important;
                         }
                     </style>
                 </li>
             </ul>
         </div>
     </nav>
 </header>
