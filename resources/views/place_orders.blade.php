<x-app-layout>
    <x-modal name="confirm-order" maxWidth="md">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg dark:bg-gray-700">
                <button type="button" x-on:click="$dispatch('close')" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Do you want to confirm this order ?</h3>
                    <button id="confirmPlaceOrder" x-on:click="document.getElementById('order-form').submit()" type="button" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                        Yes, I'm sure
                    </button>
                    <button x-on:click="$dispatch('close')" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                </div>
            </div>
        </div>
    </x-modal>
    <div class="relative overflow-x-auto mx-10 my-8">
        <div class="flex flex-column sm:flex-row flex-wrap items-center justify-between pb-4">
            <div class="flex items-center gap-1">
                <button id="confirm-order-btn" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-order')" class="flex gap-2 items-center focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2 dark:bg-green-600 dark:hover:bg-green-700 disabled:bg-gray-400 disabled:cursor-not-allowed">Confirm Order</button>
            </div>
            
            @php
                $clients = App\Models\Client::all();
            @endphp

            @if (Auth::user()->client_id == null)
                <button id="clientSelector" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    <span id="clientSelectorValue">Select Client</span>
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                
                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-gray-200 divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        @foreach ($clients as $client)
                            <li>
                                <button type="button" x-data="" x-on:click="document.getElementById('client_id').value = {{$client->id}}; document.getElementById('clientSelectorValue').innerText = '{{$client->name}}';" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $client->name }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:focus:ring-blue-800">
                    {{ App\Models\Client::find(Auth::user()->client_id)->name }}
                </div>
            @endif
    
        </div>
        <table id="product-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 px-2">
                <tr>
                    <th scope="col" class="px-4 py-4">
                        Item Code
                    </th>
                    <th scope="col" class="px-4 py-4">
                        Item Name
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Item Group
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Case Config
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Unit Price
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Order Qty
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Lower Limit
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Upper Limit
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Total Value
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <form id="order-form" action="{{ route('dashboard.orders.place_order') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="client_id" name="client_id" value="{{ Auth::user()->client_id }}">
                    @foreach ($products as $product)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 px-2">
                            <td class="px-4 py-3">
                                {{ $product->id }}
                                <input type="hidden" name="products[{{$product->id}}][id]" value="{{ $product->id }}">
                            </td>
                            <td scope="row" class="px-4 py-3">
                                {{ $product->name }}
                            </td>
                            <td scope="row" class="px-4 py-3 text-center">
                                {{ $product->group }}
                            </td>
                            <td scope="row" class="px-4 py-3 text-center">
                                {{ $product->case_config }}
                            </td>
                            <td scope="row" class="px-4 py-3 text-center">
                                {{ $product->unit_price }}
                            </td>
                            <td scope="row" class="px-4 py-3 text-center">
                                <input type="text" id="{{ $product->id }}" name="products[{{$product->id}}][qty]" class="order_qty w-16 text-center bg-gray-100 border border-gray-400 rounded-lg dark:bg-gray-700 dark:border-gray-600 py-1 text-sm" value="0" onchange="document.getElementById('total-value-{{ $product->id }}').innerText = Number(this.value * {{ $product->unit_price }}).toLocaleString();">
                            </td>
                            <td scope="row" class="px-4 py-3 text-center">
                                {{ $product->lower_limit }}
                            </td>
                            <td scope="row" class="px-4 py-3 text-center">
                                {{ $product->upper_limit }}
                            </td>
                            <td scope="row" class="px-4 py-3 text-center">
                                <span id="total-value-{{ $product->id }}">0</span>
                            </td>
                            <td class="px-4 py-3">
                                
                            </td>
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
    </div>
    <div id="alert-toast" class="fixed bottom-5 right-5 flex flex-col gap-2 items-center justify-between">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="text-sm text-red-600 dark:text-red-400 flex items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-gray-500 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800">
                    <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ps-4 text-sm font-normal">{{ $error }}</div>
                </div>
            @endforeach
        @endif
    </div>
    <script>
        let validConfirmQty = true;
        let confirmOrderBtn = document.getElementById('confirm-order-btn');
        let alertToast = document.getElementById('alert-toast');
        let alertError = (id, message) => { return `
        <div id="alert-error-${id}" class="text-sm text-red-600 dark:text-red-400 flex items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-gray-500 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800">
            <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
              </svg>
            <div class="ps-4 text-sm font-normal">${message}</div>
        </div>
        `}
        document.querySelectorAll('.order_qty').forEach(function (input) {
            input.addEventListener('input', function() {
                if (this.value >= {{ $product->lower_limit }} && this.value <= {{ $product->upper_limit }} && !isNaN(this.value) && this.value != '') { 
                    this.classList.remove('border-2', 'border-red-600', 'focus:ring-red-600', 'focus:border-red-600'); 
                    this.classList.add('border-gray-400');
                    if (document.getElementById(`alert-error-${this.id}`)) {
                        document.getElementById(`alert-error-${this.id}`).remove();
                    }
                    validConfirmQty = true;
                } else { 
                    this.classList.add('border-2', 'border-red-600', 'focus:ring-red-600', 'focus:border-red-600'); 
                    this.classList.remove('border-gray-400');
                    if (!document.getElementById(`alert-error-${this.id}`)) {
                        alertToast.appendChild(new DOMParser().parseFromString(alertError(this.parentElement.parentElement.children[0].innerText,`Invalid order quantity for #${this.parentElement.parentElement.children[0].innerText}`), 'text/html').body.firstChild);
                    }
                    validConfirmQty = false;
                }

                if (validConfirmQty) {
                    if (confirmOrderBtn.attributes.getNamedItem('disabled') != null) {
                        confirmOrderBtn.removeAttribute('disabled');
                    }
                } else {
                    if (confirmOrderBtn.attributes.getNamedItem('disabled') == null) {
                        confirmOrderBtn.setAttribute('disabled', 'disabled');
                    }
                }
            });
        });

        // document.getElementById('confirmPlaceOrder').addEventListener('click', function() {
        //     axios.post("{{ route('dashboard.orders.place_order') }}", {
        //         client_id: document.getElementById('client_id').value,
        //         products: document.getElementById('order-form').elements
        //     }).then(response => {
        //         console.log(response);
        //     }).catch(error => {
        //         console.log(error);
        //     });
        // });
    </script>
</x-app-layout>