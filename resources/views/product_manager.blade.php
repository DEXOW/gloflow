@include('components.navbar')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Products | Gloflow</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body>
      @yield('navbar')
      <div class="modal fade" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <form id="add-product-form" action="{{ route('dashboard.products_manager.add_product') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title fw-bold">Add Product</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Product Name">
                  </div>
                  <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <input class="form-control" id="tags" name="tags" placeholder="Tags">
                  </div>
                  <div class="input-group mb-3">
                    <input type="file" accept="image/*" class="form-control" id="image" name="image">
                    <label class="input-group-text" for="image">Upload</label>
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
      <div class="container mt-5 mb-3 mx-auto">
        <h2 class="display-6">Manage Products</h2>
      </div>
      <div class="container d-flex mb-3 gap-1">
        <button class="d-flex btn btn-success gap-2" data-bs-toggle="modal" data-bs-target="#addProductModal"><i class="bi bi-plus"></i><span>Add New</span></button>
        <button id="batch-delete" class="d-none btn btn-danger gap-2"><i class="bi bi-trash"></i></button>
      </div>
      <div class="container products-list">
        <ul class="list-group">
          <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex gap-3">
                <input id="checkAllCheckbox" type="checkbox">
                <div>ID</div>
                <div>Name</div>
              </div>
              <div class="d-flex align-items-center gap-2">
                <div class="d-flex gap-3">
                  Tags
                  <div>
                    Actions
                  </div>
                </div>
              </div>
            </div>
          </li>
          @foreach ($products as $product)
            <li class="list-group-item">
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-3">
                  <input class="product-checkbox" type="checkbox" value="{{ $product->id }}">
                  <div>{{ $product->id }}</div>
                  <div>{{ $product->name }}</div>
                </div>
                <div class="d-flex align-items-center gap-2">
                  <div class="d-flex gap-1 justify-content-end flex-wrap">
                    @foreach (explode(',', $product->tags) as $tag)
                      <div class="badge bg-secondary">{{ $tag }}</div>
                    @endforeach
                  </div>
                  <div class="d-flex">
                    <form action="{{ route('dashboard.products_manager.delete_product', $product->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-light delete-button" style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .35rem; --bs-btn-font-size: .75rem;"><i class="bi bi-trash-fill" style="color: #c83a3a"></i></button>
                    </form>
                    <button class="btn btn-light add-button" style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .35rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#editProductModal-{{ $product->id }}"><i class="bi bi-pencil-square" style="color: #4370b4"></i></button>
                  </div>
                </div>
              </div>
            </li>
            <div class="modal fade" id="editProductModal-{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <form id="add-product-form" action="{{ route('dashboard.products_manager.update_product', $product->id) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div>
                        <div class="mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" value="{{ $product->name }}">
                        </div>
                        <div class="mb-3">
                          <label for="description" class="form-label">Description</label>
                          <textarea class="form-control" id="description" name="description" placeholder="Description">{{ $product->description }}</textarea>
                        </div>
                        <div class="mb-3">
                          <label for="tags" class="form-label">Tags</label>
                          <input class="form-control" id="tags" name="tags" placeholder="Tags" value="{{ $product->tags }}">
                        </div>
                        <div class="input-group mb-3">
                          <input type="file" accept="image/*" class="form-control" id="image" name="image">
                          <label class="input-group-text" for="image">Upload</label>
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
        </ul>
      </div>
      <script type="module">
        let checkAllCheckbox = document.getElementById('checkAllCheckbox');
        let productCheckboxes = document.getElementsByClassName('product-checkbox');
        let batchDeleteButton = document.getElementById('batch-delete');
        let addProductForm = document.getElementById('add-product-form');

        // Batch delete button
        checkAllCheckbox.addEventListener('change', function() {
          if (this.checked) {
            for (let i = 0; i < productCheckboxes.length; i++) {
              productCheckboxes[i].checked = true;
            }
          } else {
            for (let i = 0; i < productCheckboxes.length; i++) {
              productCheckboxes[i].checked = false;
            }
          }
        });

        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
          checkbox.addEventListener('change', function() {
            let checkedCount = 0;
            for (let i = 0; i < productCheckboxes.length; i++) {
              if (productCheckboxes[i].checked) {
                checkedCount++;
              }
            }
            if (checkedCount > 0) {
              batchDeleteButton.classList.remove('d-none');
            } else {
              batchDeleteButton.classList.add('d-none');
            }
          });
        });

        document.getElementById('batch-delete').addEventListener('click', function() {
          let checkedProductIds = [];
          for (let i = 0; i < productCheckboxes.length; i++) {
            if (productCheckboxes[i].checked) {
              checkedProductIds.push(productCheckboxes[i].value);
            }
          }
          if (checkedProductIds.length > 0) {
            if (confirm('Are you sure you want to delete these products?')) {
              $.ajax({
                url: '{{ route('dashboard.products_manager.batch_delete_products') }}',
                type: 'POST',
                data: {
                  _token: '{{ csrf_token() }}',
                  ids: checkedProductIds
                },
                success: function(response) {
                  console.log(response.status);
                  if (response.status == 'success') {
                    location.reload();
                  }
                }
              });
            }
          }
        });
      </script>
    </body>
</html>