<x-app-layout>
    <div class="relative overflow-x-auto mx-10 my-8">
        <div class="flex flex-column sm:flex-row flex-wrap items-center justify-between pb-4">
            <div class="flex items-center gap-1">
                <button id="confirm-order-btn" class="flex gap-2 items-center focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2 dark:bg-green-600 dark:hover:bg-green-700 disabled:bg-gray-400 disabled:cursor-not-allowed">Confirm Order</button>
            </div>
        </div>
        <table id="product-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 px-2">
                <tr>
                    {{-- <th scope="col" class="px-4 py-4">
                        <div class="flex items-center">
                            <input id="checkbox-all" type="checkbox" class="focus:ring-0 w-4 h-4 text-blue-600 bg-gray-200 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all" class="sr-only">checkbox</label>
                        </div>
                    </th> --}}
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
                @foreach ($products as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 px-2">
                        {{-- <td class="px-4 py-3">
                            <div class="flex items-center">
                                <input id="checkbox-item-{{ $product->id }}" value="{{ $product->id }}" type="checkbox" class="item-checkbox focus:ring-0 w-4 h-4 text-blue-600 bg-gray-200 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td> --}}
                        <td class="px-4 py-3">
                            {{ $product->id }}
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
                            <input type="text" id="{{ $product->id }}" name="order_qty" class="w-16 text-center bg-gray-100 border border-gray-400 rounded-lg dark:bg-gray-700 dark:border-gray-600 py-1 text-sm" value="0" onchange="document.getElementById('total-value-{{ $product->id }}').innerText = Number(this.value * {{ $product->unit_price }}).toLocaleString();">
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
            </tbody>
        </table>
    </div>
    <div id="alert-toast" class="fixed bottom-5 right-5 flex flex-col gap-2 items-center justify-between">
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
        document.getElementsByName('order_qty').forEach(function (input) {
            input.addEventListener('change', function() {
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
    </script>
</x-app-layout>