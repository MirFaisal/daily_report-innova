<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Report</title>


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
            rel="stylesheet"
        />

        <!-- Styles -->
        <script
            src="https://kit.fontawesome.com/deb5ec3c82.js"
            crossorigin="anonymous"
        ></script>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
            crossorigin="anonymous"
        />

        <script
            src="https://cdn.tiny.cloud/1/68ciiht3te3d1erk0blb60tq6j4lkakbw7pdmn85lx4fffpv/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"
        ></script>
        <script>
            tinymce.init({
                selector: "#mytextarea",
            });
        </script>
        <link
            href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
            rel="stylesheet"
        />
    </head>
    <body style="height: 90dvh" class="antialiased position-relative">
        <main>@yield('content')</main>

        <div
            style="
                display: flex;
                justify-content: center;
                align-items: center;
                top: 70%;
                right: 5%;
                width: 50px;
                height: 50px;
                background: rgb(248, 63, 63);
            "
            class="position-fixed"
        >
            <a
                class="w-100 h-100 d-flex justify-content-center align-items-center"
                href="{{ url('/') }}"
            >
                <i class="fa-solid fa-house" style="color: #ffffff"></i>
            </a>
        </div>
        <!-- search -->
        <div
            style="
                display: flex;
                justify-content: center;
                align-items: center;
                top: 80%;
                right: 5%;
                width: 50px;
                height: 50px;
                background: rgb(248, 63, 63);
            "
            class="position-fixed"
        >
            <a
                class="w-100 h-100 d-flex justify-content-center align-items-center text-decoration-none"
                href="{{ route('SEARCH::VIEW') }}"
            >
                <i
                    class="fa-solid fa-magnifying-glass"
                    style="color: #ffffff"
                ></i>
            </a>
        </div>
        <!-- logout -->
        <div
            style="
                display: flex;
                justify-content: center;
                align-items: center;
                top: 90%;
                right: 5%;
                width: 50px;
                height: 50px;
                background: rgb(248, 63, 63);
            "
            class="position-fixed"
        >
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-link
                    :href="route('logout')"
                    onclick="event.preventDefault();
                    this.closest('form').submit();"
                >
                    <i
                        class="fa-solid fa-right-from-bracket"
                        style="color: #ffffff"
                    ></i>
                </x-link>
            </form>
        </div>
        <!-- SELECT2 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $(".js-example-basic-single").select2();
            });
        </script>
        <!-- bs script -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
