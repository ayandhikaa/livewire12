<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    // property untuk mencatat data rows per page, nilai default 10
    public $rowsPerPage = 10;

    // property untuk menampung data searching dari form client
    public $search;

    // property untuk indikator menjalankan halaman popup modal atau tidak
    public $isOpenModal = false;

    // property untuk sinkronisasi data dengan form untuk kirim data
    public $productName, $productDescription, $productPrice, $productImage, $productId;
    
    // property untuk menandai user sedang new entry atau edit
    public $isEditMode = false;

    //property untuk menandai user saat mode edit upload image baru
    public $isUploadImage = false;
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

    public function closeModal()
    {
        // setting property isOpenModal false
        $this->isOpenModal = false;

        //setting mode false
        $this->isEditMode = false;

        // setting $isUploadImage false
        $this->isUploadImage = false;
    }

    public function productEdit($id)
    {
        // mencari data berdasarkan id, hasil disimpan pada variabel array lokal dengan nama $productCari
        $productCari = Product::find($id);

        // menyanlin record data di variabel $productCari ke property yang akan dikirim untuk ditampilkan di form edit
        $this->productId = $productCari->id;
        $this->productName = $productCari->name;
        $this->productDescription = $productCari->description;
        $this->productPrice = $productCari->price;
        $this->productImage = $productCari->image;

        // aktifkan mode edit
        $this->isEditMode = true;

        // menjalankan method openModal
        $this->openModal();
    }

    //method cek user upload ulang image saat edit mode
    public function updated($propertyName){
        if ($propertyName == 'productImage') {
            //user upload iulang image
            $this->isUploadImage = true;
        }
    }

    public function productDelete($id){
        // mencari data berdasarkan id, hasil disimpan pada variabel array lokal dengan nama $productCari
        Product::find($id)->delete();
    }
    
    public function productStore()
    {
        // menjalankan rule validasi, memanggil method bawaan laravel validate(), disertakan data rule dari property rules
        // $this->validate($this->rules);

        // menyalin $rules lama ke variabel array
        $newValRules = $this->rules;

        // mengubah rule postImage saat entry (isEditMode=false)
        if (!$this->isEditMode) {
            $newValRules['productImage'] = 'required|image|max:5120';
        }
        // edit mode on dan user upload image baru
        elseif ($this->isEditMode && $this->productImage)
         {
            $newValRules['productImage'] = 'required|image|max:5120';
        }
        // edit mode user tidak upload image baru
        elseif ($this->isEditMode && !$this->isUploadImage)
        {
            $newValRules['productImage'] = '';
        }

        // upload file gambar di storage/product_images
        // $this->productImage->storeAs('product_images', $this->productImage->hashName(), 'public');

        // upload image modifikasi
        //variabel untuk menyimpan nama file yang diupload
        $imageName = '';
        if (($this->isEditMode && $this->productImage) || (!$this->isEditMode && $this->productImage)) {
            $this->productImage->storeAs('product_images',$this->productImage->hashName(), 'public');
            $imageName = $this->productImage->hashName();
        }else{
            $imageName = $this->productImage;
        }

        // menyimpan data ke table products, menggunakan method updateOrCreate() yang tersedia di class modal
        Product::updateOrCreate(['id' => $this->productId], [
            'name' => $this->productName,
            'description' => $this->productDescription,
            'price' => $this->productPrice,
            // 'image' => $this->productImage->hashName(),
            'image' => $imageName,
        ]);

        $this->closeModal();
    }
}
