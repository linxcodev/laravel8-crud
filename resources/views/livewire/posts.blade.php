<div>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Posts') }}
      </h2>
  </x-slot>

  <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">
    @if ($isOpen)
      @include('livewire.create')
    @endif

    @if (session()->has('info'))
      <div class="bg-green-500 border-1 border-green-600 rounded-b mt-2 py-3 px-3">
        <div class="">
          <h1 class="text-white font-bold">{{session('info')}}</h1>
        </div>
      </div>
    @endif

    @if (session()->has('delete'))
      <div class="bg-red-500 border-1 border-red-600 rounded-b mt-2 py-3 px-3">
        <div class="">
          <h1 class="text-white font-bold">{{session('delete')}}</h1>
        </div>
      </div>
    @endif

    <div class="mt-2 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg px-4 py-4">
      <div class="flex mb-4">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <button wire:click="showModal()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded mt-2">
            Tambah Post
          </button>
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <input type="text" wire:model="search" placeholder="Cari...." class="shadow appearance-none border rounded w-full py-2 px-3 text-blue-900" value="">
        </div>
      </div>

      <table class="table-fixed w-full ">
        <thead class="bg-blue-500">
          <tr>
            <th class="px-1 py-2 text-white w-20">No</th>
            <th class="px-4 py-2 text-white">Title</th>
            <th class="px-4 py-2 text-white">Description</th>
            <th class="px-4 py-2 text-white">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <td  class="px-2 py-3 text-center">{{ $loop->index+1 }}</td>
              <td class="text-center">{{$post->title}}</td>
              <td class="text-center">{{$post->description}}</td>
              <td class="text-center">
                <button wire:click="edit({{$post->id}})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                  Edit
                </button>
                <button wire:click="delete({{$post->id}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded">
                  Delete
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mx-4 mt-5">
        {{ $posts->links() }}
      </div>
    </div>

    <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
        <div class="text-center text-sm text-gray-500 sm:text-left">
            <div class="flex items-center">
                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                    <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>

                <a href="https://laravel.bigcartel.com" class="ml-1 underline">
                    Shop
                </a>

                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>

                <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                    Sponsor
                </a>
            </div>
        </div>

        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
    </div>
  </div>
</div>
