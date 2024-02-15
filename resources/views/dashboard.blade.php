<x-app-layout>
    <div class="py-12 px-3 sm:px-10 lg:px-16">
        <div class="mb-10 bg-white px-5 py-3 rounded-lg shadow">
            <p class="text-2xl font-semibold">Good Day</p>
            <p class="text-md">{{ Auth::user()->name }}</p>
        </div>
        @if (Auth::user()->status != 'active')
            <div class="flex items-center justify-center w-full h-96 bg-white rounded-lg">
                @if (Auth::user()->status == 'pending')
                    <div class="flex flex-col items-center">
                        <div class="mb-5"><i class="fa-solid fa-hourglass fa-2xl"></i></div>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">Your account is pending</p>
                        <p class="text-md text-gray-500 dark:text-gray-400">Your account is pending for approval</p>
                    </div>
                @elseif (Auth::user()->status == 'inactive')
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-circle-exclamation fa-2xl"></i>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">Your account is inactive</p>
                        <p class="text-md text-gray-500 dark:text-gray-400">Speak to one of our representative to activate the account</p>
                    </div>
                    
                @endif
            </div>
        @else
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
            <div class="flex flex-wrap justify-center xl:justify-between sm:justify-start w-full gap-2 mb-5">
                @php
                    $productsCount = \App\Models\RetailProduct::all()->count();
                    $ordersCount = \App\Models\Order::all()->count();
                    $totalOrderValue = \App\Models\Order::all()->sum('total_order_value');
                @endphp
                <div
                    class="block w-80 p-4 md:p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5
                        class="mb-2 text-lg font-extrabold whitespace-nowrap tracking-tight text-gray-900 dark:text-white">
                        Total Products</h5>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white">{{$productsCount}}</p>
                </div>
                <div
                    class="block w-80 p-4 md:p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5
                        class="mb-2 text-lg font-extrabold whitespace-nowrap tracking-tight text-gray-900 dark:text-white">
                        Total Orders</h5>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white">{{$ordersCount}}</p>
                </div>
                <div
                    class="block w-80 p-4 md:p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5
                        class="mb-2 text-lg font-extrabold whitespace-nowrap tracking-tight text-gray-900 dark:text-white">
                        Total Order Value</h5>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white">{{number_format($totalOrderValue,  0, '.', ',')}}</p>
                </div>
                <div
                    class="block w-80 p-4 md:p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5
                        class="mb-2 text-lg font-extrabold whitespace-nowrap tracking-tight text-gray-900 dark:text-white">
                        Available Couriers</h5>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white">10</p>
                </div>
            </div>
            @endif
            
            <div class="flex md:flex-row flex-col justify-center xl:justify-between sm:justify-start max-sm:items-center w-full gap-10 mb-5 sm:mb-10">
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between items-start w-full">
                        <div class="flex-col items-center">
                            <div class="flex items-center mb-1">
                                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">
                                    Order Demographics
                                </h5>
                            </div>
                        </div>
                        <div class="flex justify-end items-center">
                            <button id="widgetDropdownButton" data-dropdown-toggle="widgetDropdown"
                                data-dropdown-placement="bottom" type="button"
                                class="inline-flex items-center justify-center text-gray-500 w-8 h-8 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm"><svg
                                    class="w-3.5 h-3.5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                    <path
                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                </svg><span class="sr-only">Open dropdown</span>
                            </button>
                            <div id="widgetDropdown"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="widgetDropdownButton">
                                    <li>
                                        <a href="#"
                                            class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                                                class="w-3 h-3 me-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                                <path
                                                    d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                            </svg>Download data
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Line Chart -->
                    <div class="py-6" id="pie-chart"></div>
                    <div
                        class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                            <!-- Button -->
                            {{-- <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                                data-dropdown-placement="bottom"
                                class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                                type="button">
                                Last 7 days
                                <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <div id="lastDaysdropdown"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownDefaultButton">
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                            7 days</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                            30 days</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                            90 days</a>
                                    </li>
                                </ul>
                            </div> --}}
                            {{-- <a href="#"
                                class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                                Traffic analysis
                                <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                            </a> --}}
                        </div>
                    </div>
                </div>
                @endif
                <div class="bg-white rounded-lg shadow w-full p-4 md:p-6">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">
                        Notifications
                    </h5>
                    <div class="flex flex-col gap-2 mt-4 h-full">
                        @php
                            $pendingAcc = \App\Models\User::where('status', 'pending')->get();
                            $notifications = false;
                            if ($pendingAcc->count() > 0) {
                                $notifications = true;
                            }
                        @endphp
                        @if (!$notifications)
                            <div class="flex items-center justify-center w-full h-full">
                                <div class="flex flex-col items-center text-gray-400 pb-10">
                                    <div class="mb-5"><i class="fa-solid fa-bell fa-2xl"></i></div>
                                    <p class="text-lg font-semibold text-gray-600 dark:text-white">No notifications</p>
                                    <p class="text-md text-gray-400 dark:text-gray-400">You have no pending notifications</p>
                                </div>
                            </div>
                        @else
                            @foreach ($pendingAcc as $user)
                                @php
                                    $client = \App\Models\Client::where('id', $user->client_id)->get()->first();
                                @endphp
                                <x-toast id="user-toast-{{ $user->id }}">
                                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:text-blue-300 dark:bg-blue-900">
                                        <i class="fa-regular fa-user"></i>
                                        <span class="sr-only">Refresh icon</span>
                                    </div>
                                    <div class="ms-3 text-sm font-normal flex items-center justify-between w-full gap-2">
                                        <div class="sm:min-w-56">
                                            <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">Pending account creation</span>
                                            <div class="text-sm font-normal">{{ $user->name }} | {{ $client ? $client->name : "No Company" }}</div> 
                                        </div>
                                        <div class="flex flex-nowrap gap-2">
                                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'view-{{ $user->id }}')" class="px-2 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">View</button>
                                        </div>
                                    </div>
                                </x-toast>
                                <x-modal name="view-{{ $user->id }}">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Register Request
                                        </h3>
                                        <button type="button" id="add-modal-close" x-on:click="$dispatch('close'); document.getElementById('edit-form-{{ $user->id }}').reset()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-4 md:p-5" id="edit-form-{{ $user->id }}" action="{{ route('dashboard.products_manager.update_product', $user->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid gap-4 mb-10 grid-cols-2">
                                            <div>
                                                <div class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</div>
                                                <div class="text-sm bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 py-2 px-4">{{ $user->name }}</div>
                                            </div>
                                            <div>
                                                <div class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</div>
                                                <div class="text-sm bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 py-2 px-4">{{ $user->email }}</div>
                                            </div>
                                            <div>
                                                <div class="block text-sm font-medium text-gray-700 dark:text-gray-200">Phone</div>
                                                <div class="text-sm bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 py-2 px-4">{{ $user->phone_number }}</div>
                                            </div>
                                            <div>
                                                <div class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</div>
                                                <div class="text-sm bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 py-2 px-4 capitalize">{{ $user->status }}</div>
                                            </div>
                                            <div>
                                                <div class="block text-sm font-medium text-gray-700 dark:text-gray-200">Company</div>
                                                <div class="text-sm bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 py-2 px-4">{{ $client ? $client->name : "No Company" }}</div>
                                            </div>
                                        </div>
                                        <button class="text-white focus:outline-none text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700">Accept</button>
                                        <button class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Deny</button>
                                    </form>
                                </x-modal>
                            @endforeach
                        @endif
                    </div>
                </div>        
            </div>
        @endif
    </div>
    @php
        $orderCountEachClient = \App\Models\Order::select('client_id', \DB::raw('count(*) as total'))->groupBy('client_id')->get();
        // dd($orderCountEachClient->pluck('client_id')->map(function($id) { return \App\Models\Client::where('id', $id)->first()->name; })->join(", "))
    @endphp
    <script>
        // ApexCharts options and config
        window.addEventListener("load", function() {
            const getChartOptions = () => {
                return {
                    series: [{{ $orderCountEachClient->pluck('total')->join(', ') }}],
                    colors: ["#1C64F2", "#16BDCA", "#9061F9"],
                    chart: {
                        height: 420,
                        width: "100%",
                        type: "pie",
                    },
                    stroke: {
                        colors: ["white"],
                        lineCap: "",
                    },
                    plotOptions: {
                        pie: {
                            labels: {
                                show: true,
                            },
                            size: "100%",
                            dataLabels: {
                                offset: -25
                            }
                        },
                    },
                    labels: @json($orderCountEachClient->pluck('client_id')->map(function($id) {return \App\Models\Client::where('id', $id)->first()->name;})->toArray()),
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                        },
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value + "%"
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function(value) {
                                return value + "%"
                            },
                        },
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                    },
                }
            }

            if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
                chart.render();
            }
        });
    </script>
</x-app-layout>
