@include('components.navbar')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Gloflow') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    @yield('navbar')
    <div class="modal fade" id="addUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <form id="add-user-form" action="{{ route('dashboard.users_manager.add_user') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title fw-bold">Add User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div>
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="User Name">
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="mb-3">
                  <label for="phone_number" class="form-label">Phone Number</label>
                  <input class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number">
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input class="form-control" id="address" name="address" placeholder="Address">
                </div>
                <div class="mb-3">
                  <label for="role_id" class="form-label">Phone Number</label>
                  <select id="role_id" name="role_id" class="form-select" aria-label="Role">
                    @foreach ($roles as $role)
                      <option value="{{ $role->id }}" 
                        @if ($role->id == 2)
                          selected
                        @endif
                      >{{ $role->display_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Add</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    <div class="container d-flex flex-row justify-content-between align-items-end mt-5 mb-3">
      <h2 class="display-6">Manage Users</h2>
      <div>
        <button class="btn btn-primary d-flex gap-2" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="bi bi-plus"></i><span>Add User</span></button>
      </div>
    </div>
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col" style="text-align: center">ID</th>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Address</th>
            <th scope="col" style="text-align: center">Status</th>
            <th scope="col" style="text-align: center">Role</th>
            <th scope="col" style="text-align: center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <td><div class="d-flex justify-content-center">{{ $user->id }}</div></td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->phone_number }}</td>
              <td>{{ implode(' ', array_slice(explode(' ', $user->address), 0, 5)).'...' }}</td>
              <td>
                <div class="d-flex justify-content-center">
                  @if ($user->status == 'active')
                    <span class="badge bg-success">Active</span>
                  @else
                    <span class="badge bg-secondary">Inactive</span>
                  @endif
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-center">
                  @if ($user->role_id == 1)
                    <span class="badge" style="background-color: #c83b3b">{{ $roles[0]->display_name }}</span>
                  @elseif ($user->role_id == 2)
                    <span class="badge" style="background-color: #545454">{{ $roles[1]->display_name }}</span>
                  @elseif ($user->role_id == 3)
                    <span class="badge" style="background-color: #daac21">{{ $roles[2]->display_name }}</span>
                  @elseif ($user->role_id == 4)
                    <span class="badge" style="background-color: #3a73c8">{{ $roles[3]->display_name }}</span>
                  @elseif ($user->role_id == 5)
                    <span class="badge" style="background-color: #06a34a">{{ $roles[4]->display_name }}</span>
                  @elseif ($user->role_id == 6)
                    <span class="badge" style="background-color: #8c4600">{{ $roles[5]->display_name }}</span>
                  @endif
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-center">
                  @if ($user->role_id != 1)
                    @if ($user->status == 'active')
                      <form action="{{ route('dashboard.users_manager.deactivate_user', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-light deactivate-button" style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .35rem; --bs-btn-font-size: .75rem;"><i class="bi bi-slash-circle-fill" style="color: #c83a3a"></i></button>
                      </form>
                    @else
                      <form action="{{ route('dashboard.users_manager.activate_user', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-light activate-button" style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .35rem; --bs-btn-font-size: .75rem;"><i class="bi bi-check-circle-fill" style="color: #3ac869"></i></button>
                      </form>
                    @endif
                    <form action="{{ route('dashboard.users_manager.delete_user', $user->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-light delete-button" style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .35rem; --bs-btn-font-size: .75rem;"><i class="bi bi-trash-fill" style="color: #c83a3a"></i></button>
                    </form>
                    <button class="btn btn-light add-button" style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .35rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#edituserModal-{{ $user->id }}"><i class="bi bi-pencil-square" style="color: #4370b4"></i></button>
                  @endif
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @foreach ($users as $user)
        <div class="modal fade" id="edituserModal-{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <form id="add-user-form" action="{{ route('dashboard.users_manager.update_user', $user->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div>
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="User Name" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email Address</label>
                      <input class="form-control" id="email" name="email" placeholder="email" value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                      <label for="phone_number" class="form-label">Phone Number</label>
                      <input class="form-control" id="phone_number" name="phone_number" placeholder="phone_number" value="{{ $user->phone_number }}">
                    </div>
                    <div class="mb-3">
                      <label for="address" class="form-label">Address</label>
                      <input class="form-control" id="address" name="address" placeholder="address" value="{{ $user->address }}">
                    </div>
                    <div class="mb-3">
                      <label for="role_id" class="form-label">Phone Number</label>
                      <select id="role_id" name="role_id" class="form-select" aria-label="Role">
                        @foreach ($roles as $role)
                          <option value="{{ $role->id }}" 
                            @if ($user->role_id == $role->id)
                              selected
                            @endif
                          >{{ $role->display_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Edit</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>
</body>

</html>
