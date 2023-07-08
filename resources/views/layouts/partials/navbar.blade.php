                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-xxl">
                        <a href="/">
                            <img href="/" src="/pics/logo.png" alt="logo" style="width:6rem;">
                        </a>
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link {{ (Route::current()->getName() == 'list.create') ? 'active' : '' }}" href="{{ route('list.create') }}">
                                    Create List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (Route::current()->getName() == 'list.index') ? 'active' : '' }}" href="{{ route('list.index') }}">
                                    Your Lists
                                </a>
                            </li>
                        </ul>
                        <div class="flex items-right lg:order-2">
                            @auth
                            <div style="display: flex; align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                                <p style="margin: 2px 20px 0 8px">{{ Auth::user()->name }}</p>                         
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