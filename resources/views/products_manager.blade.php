<x-app-layout>
    <div class="relative overflow-x-auto mx-10 my-8">
        <div class="flex flex-column sm:flex-row flex-wrap items-center justify-between pb-4">
            <div class="flex items-center gap-1">
                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-item')" class="flex gap-2 items-center focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2 dark:bg-green-600 dark:hover:bg-green-700"><i class="fa-solid fa-plus"></i>Add Product</button>
                <button type="button" id="batch-delete-btn" class="hidden focus:outline-none text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2 dark:bg-red-600 dark:hover:bg-red-700"><i class="fa-solid fa-trash"></i></button>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
            </div>
        </div>
        <table id="product-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="ps-6 pe-4 py-4">
                        <div class="flex items-center">
                            <input id="checkbox-all" type="checkbox" class="focus:ring-0 w-4 h-4 text-blue-600 bg-gray-200 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-4">
                        ID
                    </th>
                    <th scope="col" class="px-4 py-4 flex justify-between items-center">
                        <div>Product name</div>
                        <div>Tags</div>
                    </th>
                    <th scope="col" class="ps-4 pe-6 py-4 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="ps-6 pe-4 py-3">
                            <div class="flex items-center">
                                <input id="checkbox-item-{{ $product->id }}" value="{{ $product->id }}" type="checkbox" class="item-checkbox focus:ring-0 w-4 h-4 text-blue-600 bg-gray-200 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            {{ $product->id }}
                        </td>
                        <th scope="row" class="px-4 py-3 flex justify-between">
                            <div class="font-medium text-gray-900 dark:text-white">{{ $product->name }}</div>
                            <div class="flex gap-5">
                                <div>
                                    @foreach (explode(',', $product->tags) as $tag)
                                        <span class="bg-gray-500 text-white whitespace-nowrap text-xs font-medium m-0.5 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </th>
                        <td class="ps-4 pe-6 py-3">
                            <div class="flex items-center justify-evenly">
                                <form action="{{ route('dashboard.products_manager.delete_product', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn font-medium text-blue-600 dark:text-blue-500 hover:underline"><i class="fa-solid fa-trash-can text-red-500"></i></button>
                                </form>
                                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-item-{{ $product->id }}')" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><i class="fa-solid fa-edit text-blue-500"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach ($products as $product)
            <x-modal name="edit-item-{{ $product->id }}">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Product
                    </h3>
                    <button type="button" id="add-modal-close" x-on:click="$dispatch('close'); document.getElementById('edit-form-{{ $product->id }}').reset()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="edit-form-{{ $product->id }}" action="{{ route('dashboard.products_manager.update_product', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-10 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="" value="{{ $product->name }}"/>
                            @error('name')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="description" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Product Description</label>
                            <textarea name="description" id="description" rows="4" class="block p-2.5 min-h-[70px] max-h-32 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here">{{ $product->description }}</textarea>                    
                            @error('description')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="name" class="flex items-end gap-1 mb-2"><p class="text-sm font-bold text-gray-900 dark:text-white">Tags</p><p class="text-xs font-regular text-gray-900 dark:text-white">(Seperate the tags by a comma)</p></label>
                            <input type="text" name="tags" id="tags" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Add the tags seperated by commas" required value="{{ $product->tags }}"/>
                            @error('tags')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Display Image</label>
                            <input name="image" id="image" type="file" accept="image/png, image/jpeg, image/jpg" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"/>
                            @error('image')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button class="text-white focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2 dark:bg-green-600 dark:hover:bg-green-700">Confirm</button>
                </form>
            </x-modal>
        @endforeach

        <x-modal name="add-item">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add Product
                </h3>
                <button type="button" id="add-modal-close" x-on:click="$dispatch('close'); document.getElementById('add-form').reset()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" id="add-form" action="{{ route('dashboard.products_manager.add_product') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-10 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="" value="{{ old('name') }}"/>
                        @error('name')
                            <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Product Description</label>
                        <textarea name="description" id="description" rows="4" class="block p-2.5 min-h-[70px] max-h-32 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here">{{ old('description') }}</textarea>                    
                        @error('description')
                            <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="name" class="flex items-end gap-1 mb-2"><p class="text-sm font-bold text-gray-900 dark:text-white">Tags</p><p class="text-xs font-regular text-gray-900 dark:text-white">(Seperate the tags by a comma)</p></label>
                        <input type="text" name="tags" id="tags" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Add the tags seperated by commas" required value="{{ old('tags') }}"/>
                        @error('tags')
                            <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Display Image</label>
                        <input name="image" id="image" type="file" accept="image/png, image/jpeg, image/jpg" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" value="{{ old('image') }}"/>
                        @error('image')
                            <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button class="text-white focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2 dark:bg-green-600 dark:hover:bg-green-700">Confirm</button>
            </form>
        </x-modal>
    </div>

    @if ($errors->any())
        <script type="module">
            dispatchEvent(new CustomEvent('open-modal', {
                detail: 'add-item'
            }));
        </script>
    @endif
    <script>
        let batchDeleteButton = document.getElementById('batch-delete-btn');

        document.getElementById('checkbox-all').addEventListener('click', function(e) {
            document.querySelectorAll('.item-checkbox').forEach(checkbox => {
              checkbox.checked = e.target.checked;
            });
        });

        document.querySelectorAll("#product-table input[type='checkbox']").forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                let checkedCount = 0;

                document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                    if (checkbox.checked) {
                        checkedCount++;
                    }
                });

                if (checkedCount > 0) {
                    batchDeleteButton.classList.remove('hidden');
                } else {
                    batchDeleteButton.classList.add('hidden');
                }
            });
        });

        batchDeleteButton.addEventListener('click', function() {
          let checkedProductIds = [];

          document.querySelectorAll('.item-checkbox').forEach(checkbox => {
            if (checkbox.checked) {
              checkedProductIds.push(checkbox.value);
            }
          });

          if (checkedProductIds.length > 0) {
            if (confirm('Are you sure you want to delete these products?')) {
                axios.post('{{ route('dashboard.products_manager.batch_delete_products') }}', {
                    _token: '{{ csrf_token() }}',
                    ids: checkedProductIds
                }).then(function(response) {
                    if (response.data.status == 'success') {
                        location.reload();
                    }
                });
            }
          }
        });
    </script>
</x-app-layout>
