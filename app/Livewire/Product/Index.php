<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // property untuk mencatat data rows per page, nilai default 10
    public $rowsPerPage = 10;

    // property untuk menampung data searching dari form client
    public $search;

    // property untuk indikator menjalankan halaman popup modal atau tidak
    public $isOpenModal = false;

    // property untuk sinkronisasi data dengan form untuk kirim data
    public $productName, $productDescription, $productPrice, $productImage, $productId;
    public function render()
    {
        return view('livewire.product.index', [
            'products' =>$this->search === null ?
            Product::latest()->paginate($this->rowsPerPage) :
            Product::latest()->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orWhere('price', 'like', '%' . $this->search . '%')
            ->paginate($this->rowsPerPage),
        ]);
    }

    protected $rules = [
            'productName' => 'required',
            'productDescription' => 'required',
            'productPrice' => 'required|numeric|min:100000|max:10000000',
            'productImage' => 'required|image|max:5120',
    ];

    public function productCreate()
    {
        // menjalankan method resetFields
        $this->resetFields();

        // menjalankan method untuk setting property inOpenModal true
        $this->openModal();
    }

    public function resetFields()
    {
        // reset semua field form
        $this->productName = '';
        $this->productDescription = '';
        $this->productPrice = '';
        $this->productImage = '';
        $this->productId = '';
    }

    public function openModal()
    {
        // setting property isOpenModal true
        $this->isOpenModal = true;
    }
}
