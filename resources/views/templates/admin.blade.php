<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('/css/fa.all.css') }}">
    <link href="{{ url('/css/tailwind.min.css') }}" rel="stylesheet">

    <style>
        .border-b-1 {
            border-bottom-width: 1px;
        }

        .border-l-1 {
            border-left-width: 1px;
        }

        hover\:border-none:hover {
            border-style: none;
        }

        #sidebar {
            transition: ease-in-out all .3s;
            z-index: 9999;
        }

        #sidebar span {
            opacity: 0;
            position: absolute;
            transition: ease-in-out all .1s;
        }

        #sidebar:hover {
            width: 220px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            /*shadow-2xl*/
        }

        #sidebar:hover span {
            opacity: 1;
        }


    </style>

</head>

<body class="flex h-screen bg-gray-100 font-sans">

    <!-- Side bar-->
    <div id="sidebar" class="h-screen w-16 menu bg-white text-white px-4 flex items-center nunito static fixed shadow">

        <ul class="list-reset ">
            <li class="my-2 md:my-0">
                <a href="{{ url('/admin/') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                    <svg class="svg-icon mr-3 w-5 inline-block" viewBox="0 0 20 20">
                        <path fill="gray" d="M16.803,18.615h-4.535c-1,0-1.814-0.812-1.814-1.812v-4.535c0-1.002,0.814-1.814,1.814-1.814h4.535c1.001,0,1.813,0.812,1.813,1.814v4.535C18.616,17.803,17.804,18.615,16.803,18.615zM17.71,12.268c0-0.502-0.405-0.906-0.907-0.906h-4.535c-0.501,0-0.906,0.404-0.906,0.906v4.535c0,0.502,0.405,0.906,0.906,0.906h4.535c0.502,0,0.907-0.404,0.907-0.906V12.268z M16.803,9.546h-4.535c-1,0-1.814-0.812-1.814-1.814V3.198c0-1.002,0.814-1.814,1.814-1.814h4.535c1.001,0,1.813,0.812,1.813,1.814v4.534C18.616,8.734,17.804,9.546,16.803,9.546zM17.71,3.198c0-0.501-0.405-0.907-0.907-0.907h-4.535c-0.501,0-0.906,0.406-0.906,0.907v4.534c0,0.501,0.405,0.908,0.906,0.908h4.535c0.502,0,0.907-0.406,0.907-0.908V3.198z M7.733,18.615H3.198c-1.002,0-1.814-0.812-1.814-1.812v-4.535c0-1.002,0.812-1.814,1.814-1.814h4.535c1.002,0,1.814,0.812,1.814,1.814v4.535C9.547,17.803,8.735,18.615,7.733,18.615zM8.64,12.268c0-0.502-0.406-0.906-0.907-0.906H3.198c-0.501,0-0.907,0.404-0.907,0.906v4.535c0,0.502,0.406,0.906,0.907,0.906h4.535c0.501,0,0.907-0.404,0.907-0.906V12.268z M7.733,9.546H3.198c-1.002,0-1.814-0.812-1.814-1.814V3.198c0-1.002,0.812-1.814,1.814-1.814h4.535c1.002,0,1.814,0.812,1.814,1.814v4.534C9.547,8.734,8.735,9.546,7.733,9.546z M8.64,3.198c0-0.501-0.406-0.907-0.907-0.907H3.198c-0.501,0-0.907,0.406-0.907,0.907v4.534c0,0.501,0.406,0.908,0.907,0.908h4.535c0.501,0,0.907-0.406,0.907-0.908V3.198z"></path>
                    </svg>
                    <span class="w-full inline-block pb-1 md:pb-0 text-sm">Dashboard</span>
                </a>
            </li>
            <li class="my-2 md:my-0 ">
                <a href="{{ url('/admin/validasi') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                    <svg class="svg-icon w-5 mr-3 inline-block" viewBox="0 0 20 20">
                        <path fill="gray" d="M19.404,6.65l-5.998-5.996c-0.292-0.292-0.765-0.292-1.056,0l-2.22,2.22l-8.311,8.313l-0.003,0.001v0.003l-0.161,0.161c-0.114,0.112-0.187,0.258-0.21,0.417l-1.059,7.051c-0.035,0.233,0.044,0.47,0.21,0.639c0.143,0.14,0.333,0.219,0.528,0.219c0.038,0,0.073-0.003,0.111-0.009l7.054-1.055c0.158-0.025,0.306-0.098,0.417-0.211l8.478-8.476l2.22-2.22C19.695,7.414,19.695,6.941,19.404,6.65z M8.341,16.656l-0.989-0.99l7.258-7.258l0.989,0.99L8.341,16.656z M2.332,15.919l0.411-2.748l4.143,4.143l-2.748,0.41L2.332,15.919z M13.554,7.351L6.296,14.61l-0.849-0.848l7.259-7.258l0.423,0.424L13.554,7.351zM10.658,4.457l0.992,0.99l-7.259,7.258L3.4,11.715L10.658,4.457z M16.656,8.342l-1.517-1.517V6.823h-0.003l-0.951-0.951l-2.471-2.471l1.164-1.164l4.942,4.94L16.656,8.342z"></path>
                    </svg>
                    <span class="w-full inline-block pb-1 md:pb-0 text-sm">Validasi</span>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="{{ url('/admin/data') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                    <svg class="svg-icon mr-3 w-5 inline-block" viewBox="0 0 20 20">
                        <path fill="gray" d="M3.314,4.8h13.372c0.41,0,0.743-0.333,0.743-0.743c0-0.41-0.333-0.743-0.743-0.743H3.314
                            c-0.41,0-0.743,0.333-0.743,0.743C2.571,4.467,2.904,4.8,3.314,4.8z M16.686,15.2H3.314c-0.41,0-0.743,0.333-0.743,0.743
                            s0.333,0.743,0.743,0.743h13.372c0.41,0,0.743-0.333,0.743-0.743S17.096,15.2,16.686,15.2z M16.686,9.257H3.314
                            c-0.41,0-0.743,0.333-0.743,0.743s0.333,0.743,0.743,0.743h13.372c0.41,0,0.743-0.333,0.743-0.743S17.096,9.257,16.686,9.257z"></path>
                    </svg>
                    <span class="w-full inline-block pb-1 md:pb-0 text-sm">Semua Data</span>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="{{ url('/admin/data/tervalidasi') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                    <svg class="svg-icon mr-3 w-5 inline-block" viewBox="0 0 20 20">
                        <path fill="gray" d="M7.197,16.963H7.195c-0.204,0-0.399-0.083-0.544-0.227l-6.039-6.082c-0.3-0.302-0.297-0.788,0.003-1.087
                        C0.919,9.266,1.404,9.269,1.702,9.57l5.495,5.536L18.221,4.083c0.301-0.301,0.787-0.301,1.087,0c0.301,0.3,0.301,0.787,0,1.087
                        L7.741,16.738C7.596,16.882,7.401,16.963,7.197,16.963z"></path>
                    </svg>
                    <span class="w-full inline-block pb-1 md:pb-0 text-sm">Data Valid</span>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="{{ url('/admin/data/pending') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                    <svg class="svg-icon mr-3 w-5 inline-block" viewBox="0 0 20 20">
                        <path fill="gray" d="M3.254,6.572c0.008,0.072,0.048,0.123,0.082,0.187c0.036,0.07,0.06,0.137,0.12,0.187C3.47,6.957,3.47,6.978,3.484,6.988c0.048,0.034,0.108,0.018,0.162,0.035c0.057,0.019,0.1,0.066,0.164,0.066c0.004,0,0.01,0,0.015,0l2.934-0.074c0.317-0.007,0.568-0.271,0.56-0.589C7.311,6.113,7.055,5.865,6.744,5.865c-0.005,0-0.01,0-0.015,0L5.074,5.907c2.146-2.118,5.604-2.634,7.971-1.007c2.775,1.912,3.48,5.726,1.57,8.501c-1.912,2.781-5.729,3.486-8.507,1.572c-0.259-0.18-0.618-0.119-0.799,0.146c-0.18,0.262-0.114,0.621,0.148,0.801c1.254,0.863,2.687,1.279,4.106,1.279c2.313,0,4.591-1.1,6.001-3.146c2.268-3.297,1.432-7.829-1.867-10.101c-2.781-1.913-6.816-1.36-9.351,1.058L4.309,3.567C4.303,3.252,4.036,3.069,3.72,3.007C3.402,3.015,3.151,3.279,3.16,3.597l0.075,2.932C3.234,6.547,3.251,6.556,3.254,6.572z"></path>
                    </svg>
                    <span class="w-full inline-block pb-1 md:pb-0 text-sm">Data Pending</span>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="{{ url('/admin/data/gagal') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                    <svg class="svg-icon mr-3 w-5 inline-block" viewBox="0 0 20 20">
                        <path fill="gray" d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
                    </svg>
                    <span class="w-full inline-block md:pb-0 text-sm">Data Batal</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="flex flex-row flex-wrap flex-1 flex-grow content-start pl-16">

        <div class="h-40 lg:h-20 w-full flex flex-wrap">
            <nav id="header1" class="bg-gray-100 w-auto flex-1 border-b-1 border-gray-300 order-1 lg:order-2">

                <div class="flex h-full justify-between items-center">

                    <!--Search-->
                    <div class="relative w-full max-w-3xl px-6">
                        <div class="absolute h-10 mt-1 left-0 top-0 flex items-center pl-10">
                            <svg class="h-4 w-4 fill-current text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                            </svg>
                        </div>

                        <form action="{{ url('/admin/search') }}" method="GET">
                            <input id="search-toggle" type="search" placeholder="search" class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow-md text-gray-700 font-bold rounded-full pl-12 pr-4 py-3" name="q" value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}">
                        </form>

                    </div>
                    <!-- / Search-->

                    <!--Menu-->

                    <div class="flex relative inline-block pr-6">

                        <div class="relative text-sm">
                            <button id="userButton" class="flex items-center focus:outline-none mr-3">
                                <span class="icon:clock mr-3">
                                    {{ tanggal(date("d/m/Y H:i:s"), true) }}
                                </span>
                                <span class="hidden md:inline-block">Hi, {{ $username }} </span>
                                <svg class="pl-2 h-2" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                    <g>
                                        <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z"></path>
                                    </g>
                                </svg>
                            </button>
                            <div id="userMenu" class="bg-white nunito rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                                <ul class="list-reset">
                                    <li><a href="{{ url('admin/add') }}" class="px-4 py-2 block text-gray-900 hover:bg-indigo-400 hover:text-white no-underline hover:no-underline">add new admin</a></li>
                                    <li><a href="{{ url('/change') }}" class="px-4 py-2 block text-gray-900 hover:bg-indigo-400 hover:text-white no-underline hover:no-underline">Ganti Password</a></li>
                                    <li>
                                        <hr class="border-t mx-2 border-gray-400">
                                    </li>
                                    <li><a href="{{ url('/keluar') }}" class="px-4 py-2 block text-gray-900 hover:bg-indigo-400 hover:text-white no-underline hover:no-underline">Logout</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <!-- / Menu -->

                </div>
            </nav>
        </div>

       @if(isset($html['sidebar']))
         <!--Dash Content -->
        <div id="dash-content" class="bg-gray-200 py-6 lg:py-0 w-full lg:max-w-sm flex flex-wrap content-start">

            <div class="w-1/2 lg:w-full">
                <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                    <div class="flex-1 text-center">
                        <h3 class="font-bold text-3xl" id="data-counter-all"><?= isset($registrasi['semua']->counter) ? $registrasi['semua']->counter : '0' ?></h3>

                        <h5 class="font-bold text-gray-500">Total Pendaftar</h5>
                    </div>
                </div>
            </div>

            <div class="w-1/2 lg:w-full">
                <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                    <div class="flex-1 text-center">
                        <h3 class="font-bold text-3xl" data-counter-valid="" id="data-counter-valid"><?= isset($registrasi['tervalidasi']->counter) ? $registrasi['tervalidasi']->counter : '0' ?></h3>
                        <h5 class="font-bold text-gray-500">Tervalidasi</h5>
                    </div>
                </div>
            </div>

            <div class="w-1/2 lg:w-full">
                <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                    <div class="flex-1 text-center">
                        <h3 class="font-bold text-3xl" data-counter-waiting="" id="data-counter-waiting"><?= isset($registrasi['menunggu']->counter) ? $registrasi['menunggu']->counter : '0' ?></h3>
                        <h5 class="font-bold text-gray-500">Menunggu</h5>
                    </div>
                </div>
            </div>

            <div class="w-1/2 lg:w-full">
                <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                    <div class="flex-1 text-center">
                        <h3 class="font-bold text-3xl" data-counter-pending="" id="data-counter-pending"><?= isset($registrasi['pending']->counter) ? $registrasi['pending']->counter : '0' ?></h3>
                        <h5 class="font-bold text-gray-500">Pending</h5>
                    </div>
                </div>
            </div>

            <div class="w-1/2 lg:w-full">
                <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                    <div class="flex-1 text-center">
                        <h3 class="font-bold text-3xl" data-counter-failure="" id="data-counter-failure"><?= isset($registrasi['gagal']->counter) ? $registrasi['gagal']->counter : '0' ?></h3>
                        <h5 class="font-bold text-gray-500">Batal</h5>
                    </div>
                </div>
            </div>

        </div>

       @endif

        <div class="w-full flex-1 p-6">
            <div id="main-title" class="mb-3 text-2xl">{{ isset($html[0]['title']) ? ucfirst($html[0]['title']) : '' }}</div>
            <div class="w-full">
                <div id="main-content">
                    @if(isset($message))
                        {!! getErrorMessage($message) !!}
                    @endif
                    @yield('content')
                </div>
                <div id="content-pagination" class="mt-6"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ url('/js/axios.min.js') }}"></script>
    <script>

        function validate(event){
            let message = 'Anda yakin ingin membatalkan pendaftar ini?';
            let color = 'red';
            let deleted = event.previousElementSibling
            if (event.dataset.status == 'tervalidasi') {
                message = 'Anda yakin ingin memvalidasi pendaftar ini?';
                color = 'green';
                deleted = event.nextElementSibling
            }

            if (confirm(message)) {
                axios.post("{{ url('/admin/validator') }}", event.dataset)
                    .then(res => {
                        if (res.data.status) {
                            event.innerHTML = res.data.message
                            event.classList.add(`bg-${color}-500`)
                            deleted.remove()
                        }
                    })
            }
        }

        /*Toggle dropdown list*/
        /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

        var userMenuDiv = document.getElementById("userMenu");
        var userMenu = document.getElementById("userButton");

        document.onclick = check;

        function check(e) {
            var target = (e && e.target) || (event && event.srcElement);

            //User Menu
            if (!checkParent(target, userMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, userMenu)) {
                    // click on the link
                    if (userMenuDiv.classList.contains("invisible")) {
                        userMenuDiv.classList.remove("invisible");
                    } else {
                        userMenuDiv.classList.add("invisible");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    userMenuDiv.classList.add("invisible");
                }
            }

        }

        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) {
                    return true;
                }
                t = t.parentNode;
            }
            return false;
        }
    </script>

</body>
</html>
