                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-xxl">
                        <a href="/">
                            <img href="/" src="/pics/logo.png" alt="logo" style="width:6rem;">
                        </a>

                                    @auth
                                        Something                                     
                                    @else
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="btn btn-primary">
                                                Sign Up
                                            </a>
                                        @endif
                                    @endauth



                    </div>
                </nav>