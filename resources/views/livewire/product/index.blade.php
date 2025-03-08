<div>
    {{-- header content --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    {{-- / header content --}}

    {{-- body content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- data content --}}

                {{-- tombol create product --}}
                <div class="flex p-4">
                    <button class="px-4 py-2 font-bold bg-blue-500 text-white rounded-md hover:bg-blue-600" wire:click="productCreate">
                        Create a New Product
                    </button>
                </div>                
                {{-- tombol create product --}}

                @if ($isOpenModal)
                    @include('livewire.product.create')
                @endif
            

                {{-- kontrol rows per page dan searching --}}
                <div class="flex items-center justify-between p-4">
                    {{-- kolom kiri --}}
                    <div class="flex items-center space-x-2">
                        <label for="rows-per-page" class="font-medium p-2">Rows per Page:</label>
                        <select wire:model.live="rowsPerPage" id="rows-per-page" class="w-20 px-4 py-1 border rounded-md">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    {{-- ./ kolom kiri --}}

                    {{-- kolom kanan --}}
                    <div class="flex items-center space-x-2">
                        <label for="search" class="font-medium p-2">Search:</label>
                        <input wire:model.live="search" id="search" type="text" class="px-2 py-1 border rounded-md" placeholder="Search...">
                    </div>
                    {{-- ./ kolom kanan --}}
                </div>
                {{-- kontrol rows per page dan searching --}}

                {{-- table record data table products --}}
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3 ">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $product->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $product->description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->price }}
                                </td>
                                <td>
                                    <div class="flex space-x-2 p-6">
                                        <button class="px-2 py-1 text-sm font-medium bg-blue-500 text-white rounded hover:bg-blue-600" wire:click="showProduct({{ $product->id }})">
                                            Show
                                        </button>
                                        <button class="px-2 py-1 text-sm font-medium bg-yellow-500 text-white rounded hover:bg-yellow-600" wire:click="editProduct({{ $product->id }})">
                                            Edit
                                        </button>
                                        <button class="px-2 py-1 text-sm font-medium bg-red-500 text-white rounded hover:bg-red-600" wire:click="deleteProduct({{ $product->id }})">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- table record data table products --}}

                {{-- tampilan page navigation --}}
                <div class="p-6">
                    {{ $products->links() }}
                </div>
                {{-- tampilan page navigation --}}
                {{-- ./ data content --}}
            </div>
        </div>
    </div>
    {{-- ./ body content --}}
</div>
