<?php

namespace App\Http\Livewire\Revisoes;

use App\Models\Car;
use App\Models\Photo;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Symfony\Component\Uid\Uuid;

class Cadastro extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $car_id;
    public $carro;
    public $isModalOpen = 0;
    public $isModalPhotosOpen = 0;
    public $review;
    public $review_id;
    public $photos = [];
    public $fotos;

    private $paginate = 10;


    public function mount($car_id)
    {
        $this->car_id = $car_id;
        $this->carro = Car::find($car_id);
    }

    public function render()
    {
        return view('livewire.revisoes.cadastro', [
            'revisoes' => $this->Revisoes
        ]);
    }

    public function getRevisoesProperty()
    {
        $car_id = $this->car_id;
        return Review::where("car_id", $car_id)
            ->orderByDesc('data')
            ->paginate($this->paginate);
    }

    protected $rules = [
        'review.data' => 'date_format:Y-m-d',
        'review.km' => 'nullable',
        'review.oleo' => 'nullable',
        'review.obs' => 'nullable',
        'photos' => 'max:10',
        'photos.*' => 'image|max:1024', // 1MB Max
    ];

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    private function resetCreateForm()
    {
        $this->review = new Review();
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    public function createPhotos($review_id)
    {
        $this->resetCreatePhotosForm();
        $this->fotos = Photo::where("review_id", $review_id)->get();
        $this->review_id = $review_id;
        $this->openModalPhotosPopover();
    }

    public function openModalPhotosPopover()
    {
        $this->isModalPhotosOpen = true;
    }

    private function resetCreatePhotosForm()
    {
        $this->photos = [];
    }

    public function closeModalPhotosPopover()
    {
        $this->isModalPhotosOpen = false;
    }

    public function store()
    {
        $this->validate();
        $this->review->car_id = $this->car_id;
        $this->review->save();

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $this->review = Review::findOrFail($id);
        $this->openModalPopover();
    }

    public function delete($id)
    {
        $fotos = Photo::where("review_id", $id)->get();
        foreach ($fotos as $foto) {
            Storage::delete($foto->pasta . "/" . $foto->nome);
        }
        Review::with('photo')->findOrFail($id)->delete();
        session()->flash('message', 'Revisão excluída!');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photos' => 'max:10',
            'photos.*' => 'image|max:1024', // 1MB Max
        ]);
    }

    public function save()
    {
        if (isset($this->fotos)) {
            foreach ($this->fotos as $foto) {
                Storage::delete($foto->pasta . "/" . $foto->nome);
                Photo::findOrFail($foto->id)->delete();
            }
        }
        foreach ($this->photos as $photo) {
            $foto = new Photo();
            $foto->nome = Uuid::v4();
            $foto->pasta = 'photos';
            $foto->review_id = $this->review_id;
            $foto->save();
            $photo->storeAs("public/".$foto->pasta, $foto->nome);
        }
        $this->closeModalPhotosPopover();
    }

    public function temFoto($review_id)
    {
        if (Photo::where("review_id", $review_id)->get()->isEmpty()) {
            return "Não";
        }
        return "Sim";
    }

}
