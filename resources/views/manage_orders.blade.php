<x-app-layout>
    <div class="relative overflow-x-auto mx-10 my-8">
        <table id="order-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 px-2">
                <tr>
                    <th scope="col" class="px-4 py-4">
                        Order ID
                    </th>
                    <th scope="col" class="px-4 py-4">
                        Client Name
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        User Name
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Total Qty
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Total Order Value
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Status
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 px-2">
                        <td class="px-4 py-3">
                            {{ $order->id }}
                        </td>
                        <td scope="row" class="px-4 py-3">
                            {{ \App\Models\Client::find($order->client_id)->name }}
                        </td>
                        <td scope="row" class="px-4 py-3 text-center">
                            {{ \App\Models\User::find($order->user_id)->name }}
                        </td>
                        <td scope="row" class="px-4 py-3 text-center">
                            {{ \App\Models\OrderItem::where('order_id', $order->id)->sum('qty')}}
                        </td>
                        <td scope="row" class="px-4 py-3 text-center">
                            {{ number_format($order->total_order_value,  0, '.', ',') }}
                        </td>
                        <td scope="row" class="px-4 py-3 text-center">
                            @if ($order->status == 'pending')
                                <span class="bg-gray-500 text-white whitespace-nowrap text-xs font-medium m-0.5 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ Str::ucfirst($order->status) }}</span>
                            @elseif ($order->status == 'processing')
                                <span class="bg-green-500 text-white whitespace-nowrap text-xs font-medium m-0.5 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ Str::ucfirst($order->status) }}</span>
                            @elseif ($order->status == 'cancelled')
                                <span class="bg-red-500 text-white whitespace-nowrap text-xs font-medium m-0.5 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ Str::ucfirst($order->status) }}</span>
                            @elseif ($order->status == 'completed')
                                <span class="bg-blue-500 text-white whitespace-nowrap text-xs font-medium m-0.5 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ Str::ucfirst($order->status) }}</span>
                            @endif
                        </td>
                        <td scope="row" class="px-4 py-3 text-center">
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'view-order-{{ $order->id }}')" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach ($orders as $order)
            <x-modal name="view-order-{{ $order->id }}">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        View Order#{{ $order->id }}
                    </h3>
                    <button type="button" id="add-modal-close" x-on:click="$dispatch('close')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-7">
                    <div class="flex flex-col">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/2">
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">Client Name</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ \App\Models\Client::find($order->client_id)->name }}</p>
                            </div>
                            <div class="md:w-1/2">
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">User Name</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ \App\Models\User::find($order->user_id)->name }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/2">
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">Total Qty</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ \App\Models\OrderItem::where('order_id', $order->id)->sum('qty')}}</p>
                            </div>
                            <div class="md:w-1/2">
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">Total Order Value</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ number_format($order->total_order_value,  0, '.', ',') }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/2">
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">Order Date</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ $order->created_at }}</p>
                            </div>
                            <div class="md:w-1/2">
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">Order Status</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ Str::ucfirst($order->status) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-y-show">
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
                                        Total Value
                                    </th>
                                </tr>
                            </thead>
                            @php
                                $orderItems = \App\Models\OrderItem::where('order_id', $order->id)->get();
                            @endphp
                            <tbody>
                                @foreach ($orderItems as $product)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 px-2">
                                        <td class="px-4 py-3">
                                            {{ $product->product_id }}
                                        </td>
                                        <td scope="row" class="px-4 py-3">
                                            {{ \App\Models\RetailProduct::find($product->product_id)->name }}
                                        </td>
                                        <td scope="row" class="px-4 py-3 text-center">
                                            {{ \App\Models\RetailProduct::find($product->product_id)->group }}
                                        </td>
                                        <td scope="row" class="px-4 py-3 text-center">
                                            {{ \App\Models\RetailProduct::find($product->product_id)->case_config }}
                                        </td>
                                        <td scope="row" class="px-4 py-3 text-center">
                                            {{ \App\Models\RetailProduct::find($product->product_id)->unit_price }}
                                        </td>
                                        <td scope="row" class="px-4 py-3 text-center">
                                            {{ $product->qty }}
                                        </td>
                                        <td scope="row" class="px-4 py-3 text-center">
                                            {{ number_format(\App\Models\RetailProduct::find($product->product_id)->unit_price * $product->qty, 0, '.', ',') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end mt-4">
                        @if ($order->status == 'pending')
                            <form action="{{ route('dashboard.orders.update_order_status', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-600 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 dark:focus:ring-offset-gray-700 focus:ring-gray-500 dark:focus:ring-gray-500">Decline</button>
                            </form>
                            <form action="{{ route('dashboard.orders.update_order_status', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="status" value="processing">
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 dark:bg-blue-500 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 dark:focus:ring-offset-gray-700 focus:ring-blue-500 dark:focus:ring-blue-500 ms-2">Accept</button>
                            </form>
                        @endif
                    </div>
                </div>
            </x-modal>
        @endforeach
    </div>
</x-app-layout>