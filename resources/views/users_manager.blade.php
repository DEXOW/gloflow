<x-app-layout>
    <div class="relative overflow-x-auto mx-10 my-8">
        <div class="flex flex-column sm:flex-row flex-wrap items-center justify-between pb-4">
            <div class="flex items-center gap-1">
                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-user')" class="flex gap-2 items-center focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2 dark:bg-green-600 dark:hover:bg-green-700"><i class="fa-solid fa-plus"></i>Add User</button>
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
                    <th scope="col" class="px-4 py-4">
                        User name
                    </th>
                    <th scope="col" class="px-4 py-4">
                        Email
                    </th>
                    <th scope="col" class="px-4 py-4">
                        Phone Number
                    </th>
                    <th scope="col" class="px-4 py-4">
                        Address
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Status
                    </th>
                    <th scope="col" class="px-4 py-4 text-center">
                        Role
                    </th>
                    <th scope="col" class="ps-4 pe-6 py-4 text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="ps-6 pe-4 py-3">
                            <div class="flex items-center">
                                @if ($user->id != 1)
                                    <input id="checkbox-item-{{ $user->id }}" value="{{ $user->id }}" type="checkbox" class="item-checkbox focus:ring-0 w-4 h-4 text-blue-600 bg-gray-200 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                                @endif 
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            {{ $user->id }}
                        </td>
                        <th scope="row" class="px-4 py-3">
                            {{ $user->name }}
                        </th>
                        <th scope="row" class="px-4 py-3">
                            {{ $user->email }}
                        </th>
                        <th scope="row" class="px-4 py-3">
                            {{ $user->phone_number ? $user->phone_number : '-' }}
                        </th>
                        <th scope="row" class="px-4 py-3">
                            {{ $user->address ? implode(' ', array_slice(explode(' ', $user->address), 0, 5)).'...' : '-' }}
                        </th>
                        <th scope="row" class="px-4 py-3">
                            <div class="flex justify-center">
                                @if ($user->status == 'active')
                                    <span class="bg-green-500 text-white whitespace-nowrap text-xs font-medium m-0.5 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $user->status }}</span>
                                @else
                                    <span class="bg-red-500 text-white whitespace-nowrap text-xs font-medium m-0.5 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $user->status }}</span>
                                @endif
                            </div>
                        </th>
                        <th scope="row" class="px-4 py-3">
                            <div class="flex justify-center">
                                <span class="bg-gray-500 text-white whitespace-nowrap text-xs font-medium m-0.5 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $roles[$user->role_id-1]->display_name }}</span>
                            </div>
                        </th>
                        <td class="ps-4 pe-6 py-3">
                            <div class="flex items-center justify-evenly">
                                @if ($roles[$user->role_id - 1]->name != 'admin')
                                    <form action="{{ route('dashboard.users_manager.toggle_user', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        @if ($user->status == 'active')
                                            <button type="submit" class="delete-btn font-medium text-blue-600 dark:text-blue-500 hover:underline"><i class="fa-solid fa-ban text-red-500"></i></button>
                                        @else
                                            <button type="submit" class="delete-btn font-medium text-blue-600 dark:text-blue-500 hover:underline"><i class="fa-regular fa-circle-check text-green-500"></i></button>
                                        @endif
                                    </form>
                                    <form action="{{ route('dashboard.users_manager.delete_user', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn font-medium text-blue-600 dark:text-blue-500 hover:underline"><i class="fa-solid fa-trash-can text-red-500"></i></button>
                                    </form>
                                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-item-{{ $user->id }}')" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><i class="fa-solid fa-edit text-blue-500"></i></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach ($users as $user)
            <x-modal name="edit-item-{{ $user->id }}">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Product
                    </h3>
                    <button type="button" id="add-modal-close" x-on:click="$dispatch('close'); document.getElementById('edit-form-{{ $user->id }}').reset()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="edit-form-{{ $user->id }}" action="{{ route('dashboard.users_manager.update_user', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-10 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type the user's name" value="{{ $errors->any() ? old('name') : $user->name }}"/>
                            @error('name')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="email" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Email Address</label>
                            <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type the user's email address" value="{{ $errors->any() ? old('email') : $user->email }}"/>
                            @error('email')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="password" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter a suitable password"/>
                            @error('password')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="phone_number" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Contact number" value="{{ $errors->any() ? old('phone_number') : $user->phone_number }}"/>
                            @error('phone_number')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="address" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Address</label>
                            <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Users address" value="{{ $errors->any() ? old('address') : $user->address }}"/>
                            @error('address')
                                <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                            <select name="role_id" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id == ($errors->any() ? old('role_id') : $user->role_id) ? 'selected' : ''}}>{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button class="text-white focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2 dark:bg-green-600 dark:hover:bg-green-700">Confirm</button>
                </form>
            </x-modal>
        @endforeach

        <x-modal name="add-user">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add User
                </h3>
                <button type="button" id="add-modal-close" x-on:click="$dispatch('close'); document.getElementById('add-form').reset()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" id="add-form" action="{{ route('dashboard.users_manager.add_user') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-10 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type the user's name" required="" value="{{ old('name') }}"/>
                        @error('name')
                            <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="email" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Email Address</label>
                        <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type the user's email address" required="" value="{{ old('email') }}"/>
                        @error('email')
                            <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="password" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter a suitable password" required="" value="{{ old('password') }}"/>
                        @error('password')
                            <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="phone_number" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Contact number" required="" value="{{ old('phone_number') }}"/>
                        @error('phone_number')
                            <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="address" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Address</label>
                        <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Users address" required="" value="{{ old('address') }}"/>
                        @error('address')
                            <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                        <select name="role_id" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == 2 ? 'selected' : ''}}>{{ $role->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button class="text-white focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2 dark:bg-green-600 dark:hover:bg-green-700">Confirm</button>
            </form>
        </x-modal>
    </div>

    @if ($errors->any())
        <script type="module">
            dispatchEvent(new CustomEvent('open-modal', {
                detail: 'add-user'
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
            if (confirm('Are you sure you want to delete these users?')) {
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
