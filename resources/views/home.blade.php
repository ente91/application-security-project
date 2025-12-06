<!DOCTYPE HTML>
<html>
    <head>
        <title>Application Security - Project</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

        {{-- Vite: CSS + JS --}}
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        @vite(['resources/assets/css/main.css'])
        
    </head>
    <body class="is-preload">

        <!-- Wrapper -->
        <div id="wrapper">

            <!-- Header -->
            <header id="header">
                <h1><a href="{{ url('/') }}">APPLICATION SECURITY - PROJECT</a></h1>
                <nav class="links">
                    <ul>
                        <li><a href="#">Home</a></li>
                    </ul>
                </nav>
                <nav class="main">

                </nav>
            </header>

            <!-- Menu -->
            <section id="menu">
                <!-- Search -->
                <section>
                    <form class="search" method="get" action="#">
                        <input type="text" name="query" placeholder="Search" />
                    </form>
                </section>

                <!-- Links -->
                <section>
                    <ul class="links">
                        <li>
                            <a href="#">
                                <h3>Lorem ipsum</h3>
                                <p>Feugiat tempus veroeros dolor</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <h3>Dolor sit amet</h3>
                                <p>Sed vitae justo condimentum</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <h3>Feugiat veroeros</h3>
                                <p>Phasellus sed ultricies mi congue</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <h3>Etiam sed consequat</h3>
                                <p>Porta lectus amet ultricies</p>
                            </a>
                        </li>
                    </ul>
                </section>

                <!-- Actions -->
                <section>
                    <ul class="actions stacked">
                        <li><a href="#" class="button large fit">Log In</a></li>
                    </ul>
                </section>
            </section>

            <!-- Main -->
            <div id="main">

                <!-- Post -->


                <!-- Pagination -->
                <ul class="actions pagination">
                    <li><a href="" class="disabled button large previous">Previous Page</a></li>
                    <li><a href="#" class="button large next">Next Page</a></li>
                </ul>

            </div>

            <!-- Sidebar -->
            <section id="sidebar">

                <!-- Intro -->
                <section id="intro">
                    <a href="#" class="logo">
                        <img src="{{ Vite::asset('resources/assets/images/logo.jpg') }}" alt="" />
                    </a>
                    <header>
                        <h2>Future Imperfect</h2>
                        <p>Another fine responsive site template by <a href="http://html5up.net">HTML5 UP</a></p>
                    </header>
                </section>

                <!-- Mini Posts, Posts List, About, Footer -->
                {{-- tu zostawia Pani swój dotychczasowy kod, tylko obrazki na Vite::asset jak już Pani zrobiła --}}

            </section>

        </div>
    </body>
</html>
