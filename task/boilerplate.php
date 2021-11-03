<?php
/* 
Nama : Achmad Izhar
NIM : 0110219068
Kelas : TI01 - 2019
*/
# membuat class Animal
class Animal
{
  # property animals
  public $animal;

  # method constructor - mengisi data awal
  # parameter: data hewan (array)
  public function __construct($hewan)
  {
    $this->animal = $hewan;
  }

  # method index - menampilkan data animals
  public function index()
  {
    # gunakan foreach untuk menampilkan data animals (array)
    $no = 1;
    foreach ($this->animal as $hewan) {
      
      echo $no++.".$hewan <br>";
    }
  }

  # method store - menambahkan hewan baru
  # parameter: hewan baru
  public function store($nambah)
  {
    # gunakan method array_push untuk menambahkan data baru
    return array_push($this->animal, $nambah);
  }

  # method update - mengupdate hewan
  # parameter: index dan hewan baru
  public function update($index, $hewan_baru)
  {
    return $this->animal[$index]=$hewan_baru;
  }

  # method delete - menghapus hewan
  # parameter: index
  public function destroy($index)
  {
    # gunakan method unset atau array_splice untuk menghapus data array
    return array_splice($this->animal,$index, 1);
  }
}

# membuat object
# kirimkan data hewan (array) ke constructor
$animal = new Animal(['Naga','Ular']);

echo "Index - Menampilkan seluruh hewan <br>";
$animal->index();
echo "<br>";

echo "Store - Menambahkan hewan baru <br>";
$animal->store('Kecoa');
$animal->index();
echo "<br>";

echo "Update - Mengupdate hewan <br>";
$animal->update(0, 'Garuda');
$animal->index();
echo "<br>";

echo "Destroy - Menghapus hewan <br>";
$animal->destroy(0);
$animal->index();
echo "<br>";