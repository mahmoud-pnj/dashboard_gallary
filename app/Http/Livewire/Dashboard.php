<?php

namespace App\Http\Livewire;
use App\Models\AlbumPic;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

use App\Models\Album;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithFileUploads;
    use WithPagination;


    public $albumes,$no_pic,$name,$add_album,$view_album,$edit,$editing_album_id,$delete,$show_select,$new_album_id;
    public $pictures ;

    public function mount()
    {
        $this->no_pic=false;
        $this->add_album=false;
        $this->view_album=true;
    }
    public function render()
    {
        $this->albumes=Album::get();
        $albums = Album::with('pictures')->paginate(10);

        return view('livewire.dashboard', compact('albums'));
    }
    public function saveAlbum()
    {
        if ($this->edit!=true) {

        $validatedData = $this->validate([
            'name' => 'required',
            'pictures' => 'required|array',
            'pictures.*' => 'image|max:2048',
        ]);

        $album = Album::create(['name' => $this->name]);
        $i=0;
        if ($this->pictures) {
                  // dd($this->pictures);
            foreach ($this->pictures as $image1) {
                $i++;
                $img = $image1;
                $file_name = date('Y_m_d_h_i_s_') . str::slug($this->name).'n'.$i . '.' . $img->getClientOriginalExtension();

                $destinationPath = public_path('/uploads');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                    $image = Image::make($img->getRealPath())->resize(240, 270)->save($destinationPath . '/' . $file_name);
                    $album_pic = AlbumPic::create([
                        'picture' =>  '/uploads/' . $file_name,
                        'album_id'=>$album->id ,
                        'name'=>$file_name

                ]);


             }



        }


        session()->flash('success', 'Album created successfully.');
        $this->add_album=false;
        $this->view_album=true;
        }
        else{
            $validatedData = $this->validate([
                'name' => 'required|string|max:255',
            ]);

            $album = Album::findOrFail($this->editing_album_id);
            $album->update(['name' => $validatedData['name']]);

            $this->name = '';
            $this->add_album=false;
            $this->view_album=true;
               session()->flash('success', 'Album updated successfully.');


        }
    }

    public function add_new_album(){
        $this->add_album=true;
        $this->view_album=false;
        $this->delete=false;

    }
    public function view_albums(){
        $this->add_album=false;
        $this->view_album=true;
        $this->delete=false;

    }
    public function edit_album($id){
        $albums = Album::find($id);
        $this->name=$albums->name;
        $this->edit=true;
        $this->editing_album_id=$id;
        $this->add_album=true;
        $this->view_album=false;
    }
    public function delete($id){
        $albums = Album::find($id);
        $albums_pict = AlbumPic::where('album_id',$id)->first();

        if ( $albums_pict ) {
            // dd( $this->no_pic);
            $this->no_pic=true;
        }
        else {
            $this->no_pic=false;
        }

        $this->editing_album_id=$id;
        $this->add_album=false;
        $this->view_album=false;
        $this->delete=true;
        session()->flash('danger', 'you will delete the album !!! select option');


    }
    public function delete_any_way(){
        $album = Album::findOrFail($this->editing_album_id);
        $album->delete();
        $this->add_album=false;
        $this->view_album=true;
        $this->delete=false;
        session()->flash('deleted', 'Album deleted successfully.');

    }
    public function move_to_another(){

        $this->show_select=true;
        session()->flash('choose', 'choose the album.');


    }
    public function move_to_selected(){
        $this->validate([
            'new_album_id' => 'required',
        ]);

        $pictures = AlbumPic::where('album_id',$this->editing_album_id)->get();
        foreach ($pictures as $picture) {
            $picture->album_id=$this->new_album_id;
            $picture->save();

        }
        $album = Album::findOrFail($this->editing_album_id);

        $album->delete();

        $this->add_album=false;
        $this->view_album=true;
        $this->delete=false;
        $this->show_select=false;
        session()->flash('success', 'the pictures is translated sucessfuly.');


    }

}
