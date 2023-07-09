                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-xxl">
                        <a href="/">
                            <img href="/" src="/pics/logo.png" alt="logo" style="width:6rem;">
                        </a>
                        <ul class="navbar-nav me-auto">
                            @auth
                            <li class="nav-item">
                                <a class="nav-link {{ (Route::current()->getName() == 'list.createAndIndex') ? 'active' : '' }}" href="{{ route('list.createAndIndex') }}">
                                    Your Lists
                                </a>
                            </li>
                            @endauth
                            @hasrole('Admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ (Route::current()->getName() == 'list.indexForAdmin') ? 'admin-menu-active' : '' }} admin-menu" href="{{ route('list.indexForAdmin') }}">View All Lists</a>
                                </li>
                            @endhasrole
                        </ul>
                        <div class="flex items-right lg:order-2">
                            @auth
                            <div style="display: flex; align-items: center;">
                                @hasrole('Admin')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="darkorange" class="bi bi-person-lock" viewBox="0 0 16 16">
                                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 5.996V14H3s-1 0-1-1 1-4 6-4c.564 0 1.077.038 1.544.107a4.524 4.524 0 0 0-.803.918A10.46 10.46 0 0 0 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h5ZM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/>
                                    </svg>
                                    <p style="margin: 2px 20px 0 8px; color:darkorange">{{ Auth::user()->name }}</p>  
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                                <p style="margin: 2px 20px 0 8px">{{ Auth::user()->name }}</p>
                                @endhasrole                        
                                <a href="{{ route('logout') }}" class="btn btn-primary" data-method="post" rel="nofollow">
                                    Log Out
                                </a>   
                                </div>                     
                            @else                                        
                                <a href="{{ route('login') }}" class="btn btn-primary">
                                    Log In
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-primary">
                                    Sign Up
                                </a>                                       
                            @endauth
                        </div>
                    </div>
                </nav>