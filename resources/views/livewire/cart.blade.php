<div class="container-fluid mt-5">
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Cart') }}
      </h2>
  </x-slot>

  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <h2 class="font-weight-bold">Daftar Produk</h2>

          <div class="row">
            @foreach ($products as $product)
              <div class="col-md-3 mb-3">
                <div class="card">
                  <div class="card-body">
                    <img src="{{asset('storage/images/'.$product->image)}}" alt="Img Product" class="img-fluid">
                  </div>
                  <div class="card-footer">
                    <h6 class="text-center font-weight-bold">{{$product->name}}</h6>
                    <button type="button" wire:click="addItem({{$product->id}})" class="btn btn-info btn-sm btn-block" name="button">keranjang</button>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h2 class="font-weight-bold">Keranjang</h2>

          <table class="table table-sm table-hovered table-striped table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($cartData as $cart)
                <tr>
                  <td>{{$loop->index+1}}</td>
                  <td>{{$cart['name']}} || {{$cart['qty']}}</td>
                  <td>{{$cart['price']}}</td>
                </tr>
              @empty
                <td colspan="3"> <h6 class="text-center">Keranjang Kosong</h6> </td>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h4 class="font-weight-bold">Summary </h4>
          <h5 class="font-weight-bold">Sub Total {{$summary['sub_total']}} </h5>
          <h5 class="font-weight-bold">Pajak {{$summary['pajak']}} </h5>
          <h5 class="font-weight-bold">Total {{$summary['total']}} </h5>

          <div class="">
            <button wire:click="enableTax" type="button" class="btn btn-success btn-block" name="button">Tambah Pajak</button>
            <button wire:click="disableTax" type="button" class="btn btn-danger btn-block" name="button">Hapus Pajak</button>
          </div>

          <div class="mt-4">
            <button type="button" class="btn btn-info btn-block" name="button">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
