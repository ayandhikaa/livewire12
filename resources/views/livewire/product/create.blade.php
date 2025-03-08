<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <form enctype="multipart/form-data">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="">
            {{-- field name, nama element diberi nama productName --}}
                <div class="mb-4">
                    <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Product Name:</label>
                    <input wire:model='productName' type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" wire:model="title">
                    @error('productName') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            {{-- field name --}}

            {{-- field description, nama element diberi nama productDescription --}}
                <div class="mb-4">
                    <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Product Description:</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" wire:model="body" placeholder="Enter Body"></textarea>
                    @error('productDescription') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            {{-- field description --}}  

            {{-- field price, nama element diberi nama productPrice --}}
                <div class="mb-4">
                    <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2">Product Price:</label>
                    <input wire:model='productPrice' type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Enter Price">
                    @error('productPrice') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            {{-- field price --}}

            {{-- field image, nama element diberi nama productImage --}}
                <div class="mb-4">
                    <label for="exampleFormControlInput4" class="block text-gray-700 text-sm font-bold mb-2">Product Image:</label>
                    <input wire:model='productImage' type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput4">
                    @error('productImage') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            {{-- field image --}}
          </div>
        </div>
    
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button wire:click.prevent="productStore()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Save
            </button>
          </span>
          <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
              
            <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Cancel
            </button>
          </span>
          </form>
        </div>
          
      </div>
    </div>
  </div>
  