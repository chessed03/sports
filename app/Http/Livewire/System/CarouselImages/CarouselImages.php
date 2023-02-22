<?php

namespace App\Http\Livewire\System\CarouselImages;

use App\Models\System\CarouselImage;
use Livewire\Component;
use Livewire\WithPagination;

class CarouselImages extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners       = ['destroy'];

    public $paginateNumber     = 5;

    public $orderBy            = 3;

    public $keyWord;

    public function render()
    {

        $keyWord        = '%'.$this->keyWord .'%';

        $paginateNumber = $this->paginateNumber;

        $orderBy        = intval($this->orderBy);

        $rows           = CarouselImage::getAliveImagesForView( $keyWord, $paginateNumber, $orderBy );

        return view('livewire.system.carousel-images.view', [
            'rows' => $rows
        ]);
    }

    public function messageAlert( $text, $icon )
    {

        $this->emit('message', $text, $icon);

    }

    public function destroy( $id )
    {
        if ($id) {

            $record         = CarouselImage::where('id', $id)->first();
            $record->status = 0;
            $record->update();

            $this->messageAlert( 'Imagen eliminada.','success');

        }
    }
}
