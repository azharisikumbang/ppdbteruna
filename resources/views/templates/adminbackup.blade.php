<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tailwind Starter Template - Minimal Admin Template: Tailwind Toolbox</title>
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
            width: 150px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            /*shadow-2xl*/
        }

        #sidebar:hover span {
            opacity: 1;
        }

        #main-content table {

        }

    </style>

</head>

<body class="flex h-screen bg-gray-100 font-sans">

    <!-- Side bar-->
    <div id="sidebar" class="h-screen w-16 menu bg-white text-white px-4 flex items-center nunito static fixed shadow">

        <ul class="list-reset ">
            <li class="my-2 md:my-0">
                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                    <i class="fas fa-home fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Home</span>
                </a>
            </li>
            <li class="my-2 md:my-0 ">
                <a href="{{ url('/admin/validasi') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                    <i class="fas fa-tasks fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Validasi</span>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                    <i class="fa fa-envelope fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Messages</span>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                    <i class="fas fa-chart-area fa-fw mr-3 text-indigo-400"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Analytics</span>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                    <i class="fa fa-wallet fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Payments</span>
                </a>
            </li>
        </ul>

    </div>

    <div class="flex flex-row flex-wrap flex-1 flex-grow content-start pl-16">

        <div class="h-40 lg:h-20 w-full flex flex-wrap">
            <nav id="header" class="bg-gray-200 w-full lg:max-w-sm flex items-center border-b-1 border-gray-300 order-2 lg:order-1">

                <div class="px-2 w-full">
                    <select name="" class="bg-gray-300 border-2 border-gray-200 rounded-full w-full py-3 px-4 text-gray-500 font-bold leading-tight focus:outline-none focus:bg-white focus:shadow-md" id="counter-label">
                        <option value="all">Semua</option>
                        <option value="valid">Tervalidasi</option>
                        <option value="waiting">Menunggu</option>
                        <option value="pending">Pending</option>
                        <option value="failure">Batal</option>
                    </select>
                </div>

            </nav>
            <nav id="header1" class="bg-gray-100 w-auto flex-1 border-b-1 border-gray-300 order-1 lg:order-2">

                <div class="flex h-full justify-between items-center">

                    <!--Search-->
                    <div class="relative w-full max-w-3xl px-6">
                        <div class="absolute h-10 mt-1 left-0 top-0 flex items-center pl-10">
                            <svg class="h-4 w-4 fill-current text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                            </svg>
                        </div>

                        <input id="search-toggle" type="search" placeholder="search" class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow-md text-gray-700 font-bold rounded-full pl-12 pr-4 py-3" onkeypress="updateSearchResults(event);">

                    </div>
                    <!-- / Search-->

                    <!--Menu-->

                    <div class="flex relative inline-block pr-6">

                        <div class="relative text-sm">
                            <button id="userButton" class="flex items-center focus:outline-none mr-3">
                                <span class="icon:user"></span>
                                <span class="hidden md:inline-block">Hi, {{ $username }} </span>
                                <svg class="pl-2 h-2" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                    <g>
                                        <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z"></path>
                                    </g>
                                </svg>
                            </button>
                            <div id="userMenu" class="bg-white nunito rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                                <ul class="list-reset">
                                    <li><a href="#" class="px-4 py-2 block text-gray-900 hover:bg-indigo-400 hover:text-white no-underline hover:no-underline">My account</a></li>
                                    <li><a href="#" class="px-4 py-2 block text-gray-900 hover:bg-indigo-400 hover:text-white no-underline hover:no-underline">Notifications</a></li>
                                    <li>
                                        <hr class="border-t mx-2 border-gray-400">
                                    </li>
                                    <li><a href="#" class="px-4 py-2 block text-gray-900 hover:bg-indigo-400 hover:text-white no-underline hover:no-underline">Logout</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <!-- / Menu -->

                </div>

            </nav>
        </div>

        <!--Dash Content -->
        <div id="dash-content" class="bg-gray-200 py-6 lg:py-0 w-full lg:max-w-sm flex flex-wrap content-start">

            <div class="w-1/2 lg:w-full">
                <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                    <div class="flex-1 text-center">
                        <h3 class="font-bold text-3xl" id="data-counter-all">0</h3>
                        <h5 class="font-bold text-gray-500">Total Pendaftar</h5>
                    </div>
                </div>
            </div>

            <div class="w-1/2 lg:w-full">
                <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                    <div class="flex-1 text-center">
                        <h3 class="font-bold text-3xl" data-counter-valid="" id="data-counter-valid">0</h3>
                        <h5 class="font-bold text-gray-500">Tervalidasi</h5>
                    </div>
                </div>
            </div>

            <div class="w-1/2 lg:w-full">
                <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                    <div class="flex-1 text-center">
                        <h3 class="font-bold text-3xl" data-counter-waiting="" id="data-counter-waiting">0</h3>
                        <h5 class="font-bold text-gray-500">Menunggu</h5>
                    </div>
                </div>
            </div>

            <div class="w-1/2 lg:w-full">
                <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                    <div class="flex-1 text-center">
                        <h3 class="font-bold text-3xl" data-counter-pending="" id="data-counter-pending">0</h3>
                        <h5 class="font-bold text-gray-500">Pending</h5>
                    </div>
                </div>
            </div>

            <div class="w-1/2 lg:w-full">
                <div class="border-2 border-gray-400 border-dashed hover:border-transparent hover:bg-white hover:shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                    <div class="flex-1 text-center">
                        <h3 class="font-bold text-3xl" data-counter-failure="" id="data-counter-failure">0</h3>
                        <h5 class="font-bold text-gray-500">Batal</h5>
                    </div>
                </div>
            </div>


        </div>

        <!--Graph Content -->
        <div class="w-full flex-1 p-6">
            <div id="main-title" class="mb-3 text-2xl">Dashboard</div>
            <div class="w-full bg-white p-6 shadow rounded-md">
                <div id="main-content"></div>
                <div id="content-pagination" class=" mt-6"></div>
            </div>
        </div>

    </div>

    <script type="text/javascript" src="{{ url('/js/axios.min.js') }}"></script>
    <script>

        const data = {};

        const elMainContent = document.getElementById("main-content");

        const elCounterLabel = document.getElementById("counter-label");

        const elPagination = document.getElementById("content-pagination");

        const elCounterDataAll = document.getElementById("data-counter-all");
        const elCounterDataValid = document.getElementById("data-counter-valid");
        const elCounterDataWaiting = document.getElementById("data-counter-waiting");
        const elCounterDataPending = document.getElementById("data-counter-pending");
        const elCounterDataFailure = document.getElementById("data-counter-failure");


        const dataSend = 'all';

        main();

        async function main() {
            await axios.post(`{{ url('admin/${dataSend}') }}`)
            .then(res => {
                data.all = res.data.data;
                data.paginate = {
                        "current_page": res.data.current_page,
                        "first_page_url": res.data.first_page_url,
                        "from": res.data.from,
                        "last_page": res.data.last_page,
                        "last_page_url": res.data.last_page_url,
                        "next_page_url": res.data.next_page_url,
                        "path": res.data.path,
                        "per_page": res.data.per_page,
                        "prev_page_url": res.data.prev_page_url,
                        "to": res.data.to,
                        "total": res.data.total
                }

                reloadData(data.all);


                // const paginationLabel = ['prev_page_url', 'current_page', 'next_page_url'];

                // let li, span;

                // const ul = document.createElement("ul")
                // ul.classList.add('flex', 'justify-end')

                // paginationLabel.map(l => {
                //     li = document.createElement("li");
                //     li.classList.add('py-1', 'px-3', 'hover:bg-blue-600', 'hover:text-white', 'rounded-l', 'border-l', 'border-t', 'border-b');

                //     span = document.createElement("span")
                //     span.setAttribute(`data-${l}`, data.paginate.)
                //     span.innerHTML = l

                //     li.innerHTML = span.outerHTML

                //     ul.append(li);
                // })

                // elPagination.innerHTML = ul.outerHTML



            });
        }

        function reloadData(globalData){
            data.valid = globalData.filter(value => {
                return value.status_registration == 'valid';
            }).length;

            data.waiting = globalData.filter(value => {
                return value.status_registration == 'waiting';
            }).length;

            data.pending = globalData.filter(value => {
                return value.status_registration == 'pending';
            }).length;

            data.failure = globalData.filter(value => {
                return value.status_registration == 'failure';
            }).length;

            elCounterDataAll.innerHTML = globalData.length
            elCounterDataValid.innerHTML = data.valid
            elCounterDataWaiting.innerHTML = data.waiting
            elCounterDataPending.innerHTML = data.pending
            elCounterDataFailure.innerHTML = data.failure

            elMainContent.innerHTML = createTable(globalData, [
                'No', 'No. Pendaftaran', 'Nama Pendaftar', 'Status'
            ]).outerHTML
        }

        function updateSearchResults(event){
            if (event.keyCode == 13) {
                axios.post("{{ url('admin') }}", { search : event.target.value })
                    .then(res => {
                         reloadData(res.data.data);
                    })
            }
        }

         elCounterLabel.addEventListener('change', function() {
            let selected = this.value;

            let selectedData = data.all.filter(value => {

                if (selected == 'all') {
                    return data.all;
                }

                return value.status_registration == selected;
            })

            elMainContent.innerHTML = createTable(selectedData, [
                'No', 'No. Pendaftaran', 'Nama Pendaftar', 'Status'
            ]).outerHTML
        });

        function createTable(data, tableTitle){

            let table, tableValue;

            table = document.createElement("table");
            table.classList.add('table', 'table-auto', 'w-full');
            table.setAttribute("border", "1");

            let tableBody, tableBodyCell, cellClass;

                data.map((d, index) => {
                    tableBody = table.insertRow();
                    tableBodyCell = tableBody.insertCell();
                    tableBodyCell.innerHTML = (index + 1);
                    tableBodyCell.classList.add('px-4', 'py-3', 'border', 'text-center')

                    tableBodyCell = tableBody.insertCell();
                    tableBodyCell.innerHTML = d.id_registration;
                    tableBodyCell.classList.add('px-4', 'py-3', 'border')

                    tableBodyCell = tableBody.insertCell();
                    tableBodyCell.innerHTML = d.student[0].name_student;
                    tableBodyCell.classList.add('px-4', 'py-3', 'border')

                    tableBodyCell = tableBody.insertCell();

                    switch(d.status_registration){
                        case 'valid':
                            label = 'Tervalidasi';
                            cellClass = 'green';
                            break;
                        case 'waiting':
                            label = 'Menunggu';
                            cellClass = 'yellow';
                            break;
                        case 'failure':
                            label = 'Gagal';
                            cellClass = 'red';
                            break;

                        default:
                            label = 'Pending';
                            cellClass = 'gray';
                    }

                    tableBodyCell.innerHTML = `<span class='text-${cellClass}-600 px-6 py-2 text-sm rounded-md text-white'>${label.toUpperCase()}</span>`;
                    tableBodyCell.classList.add('px-4', 'py-3', 'border', 'text-center')
                });

            const tableHeader = table.createTHead();
            const tableRow = tableHeader.insertRow(0);

            tableHeader.classList.add('bg-gray-200')

            let tableCell;

            tableTitle.map(title => {
                tableCell = tableRow.insertCell();
                tableCell.innerHTML = title;
                tableCell.classList.add('px-4', 'py-4', 'border', 'font-bold', 'text-center')
            });

            return table;
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
