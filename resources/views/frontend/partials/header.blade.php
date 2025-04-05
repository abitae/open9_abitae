<header class="site_header site_header_2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col col-lg-3 col-5">
                <div class="site_logo">
                    <a class="site_link" href="index.html">
                        <img src="collab/assets/images/logo/site_logo.svg"
                            alt="Collab - Online Learning Platform"><span>Open9</span>
                    </a>
                </div>
            </div>
            <div class="col col-lg-6 col-2">
                <nav class="main_menu navbar navbar-expand-lg">
                    <div class="main_menu_inner collapse navbar-collapse justify-content-center"
                        id="main_menu_dropdown">
                        <ul class="main_menu_list unordered_list_center">
                            <li><a class="nav-link" href="{{ route('frontend.index') }}">Home</a></li>
                            <li><a class="nav-link" href="{{ route('frontend.course') }}">Courses</a></li>
                            <li><a class="nav-link" href="{{ route('frontend.blog') }}">Blog</a></li>
                            <li><a class="nav-link" href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col col-lg-3 col-5">
                <ul class="header_btns_group unordered_list_end">
                    <li>
                        <button class="mobile_menu_btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#main_menu_dropdown" aria-controls="main_menu_dropdown"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="far fa-bars"></i>
                        </button>
                    </li>
                    <li>
                        <a class="btn border_dark" href="login.html">
                            <span><small>Login</small>
                                <small>Login</small></span>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn_dark" href="signup.html">
                            <span><small>Sign Up</small>
                                <small>Sign Up</small></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
