<div class="container-fluid mt-5">
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Product') }}
      </h2>
  </x-slot>

  @if (session()->has('info'))
    <div class="alert alert-primary" role="alert">
      {{session('info')}}
    </div>
  @endif

  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <h3 class="font-weight-bold mb-3">Daftar Produk</h3>

          <table class="table table-bordered table-hovered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th width="20%">Image</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              @if (count($products))
                @foreach ($products as $product)
                  <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$product->name}}</td>
                    <td>
                      <img src="{{asset('storage/images/'.$product->image)}}" alt="Image Product" class="img-fluid">
                    </td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->qty}}</td>
                    <td>{{$product->price}}</td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="6" class="text-center">No Data</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h3 class="font-weight-bold mb-3">Tambah Product</h3>

          <form wire:submit.prevent="store">
            <div class="form-group">
              <label>Nama Produk</label>
              <input wire:model="name" type="text" class="form-control" placeholder="Nama Produk...">
              @error ('name')
                <small class="text-danger">{{$message}}</small>
              @enderror
            </div>

            <div class="form-group">
              <label>Gambar Produk</label>
              <div class="custom-file">
                <input wire:model="image" type="file" class="custom-file-input" id="customFile">
                <label for="customFile" class="custom-file-label">Upload Gambar</label>
                @error ('image')
                  <small class="text-danger">{{$message}}</small>
                @enderror
              </div>

              @if ($image)
                <label class="mt-2">Image Preview:</label>
                <img src="{{$image->temporaryUrl()}}" alt="Image Preview" class="img-fluid">
              @endif
            </div>

            <div class="form-group">
              <label>Deskripsi Produk</label>
              <input wire:model="description" type="text" class="form-control" placeholder="Deskripsi Produk...">
              @error ('description')
                <small class="text-danger">{{$message}}</small>
              @enderror
            </div>

            <div class="form-group">
              <label>Qty</label>
              <input wire:model="qty" type="number" class="form-control" placeholder="Qty...">
              @error ('qty')
                <small class="text-danger">{{$message}}</small>
              @enderror
            </div>

            <div class="form-group">
              <label>Price</label>
              <input wire:model="price" type="number" class="form-control" placeholder="Price...">
              @error ('price')
                <small class="text-danger">{{$message}}</small>
              @enderror
            </div>

            <div class="form-group">
              <button type="submit" name="button" class="btn btn-info btn-block">Tambah Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
