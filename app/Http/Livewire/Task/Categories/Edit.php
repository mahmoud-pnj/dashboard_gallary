<?php

namespace App\Http\Livewire\Task\Categories;

use App\Models\Category;
use App\Models\SeoPage;
use App\Models\SpecialSetting;
use Livewire\Component;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;
    public $ord,$type,$parent_id,$name,$name_en,$img,$img_icon,$img_type,$details,$details_en;
    public $keywords,$keywords_en,$details_seo,$details_en_seo,$choose_viewd='slider',$img_nave;
    public $edit_object;
    public $edit_id;
    protected $listeners=[
        'getObject' => 'get_object'
    ];

    public function mount()
    {
        $this->choose_viewd='slider';
        $this->edit_object= Category::where('deleted_at',null)->find($this->edit_id);
    }
    public function render()
    {
        return view('livewire.task.categories.edit',[
            'edit_object'=>$this->edit_object,
        ]);
    }

    public function get_object($edit_object)
    {
        $this->edit_object=$edit_object;
        $this->edit_id=$this->edit_object['id'];
        $this->ord=$this->edit_object['ord'];
        $this->type=$this->edit_object['type'];
        $this->parent_id=$this->edit_object['parent_id'];
        $this->name=$this->edit_object['name'];
        $this->name_en=$this->edit_object['name_en'];
        $this->choose_viewd=$this->edit_object['choose_viewd'];
        $this->img=$this->edit_object['img'];
        $this->img_nave=$this->edit_object['img_nave'];
        $this->img_icon=$this->edit_object['img'];
        $this->img_type= $this->type < 2 ? '':'icon';
        $this->details=$this->edit_object['details'];
        $this->details_en=$this->edit_object['details_en'];


    }

    public function store_update()
    {
        // dd($this->choose_viewd);
        $this->validate([
            'name'      =>  'required|max:200',
            // 'name_en'   =>  'required|max:200',
        ]);
        if($this->edit_id > 0)
        {
            $data= Category::find($this->edit_id);

        }
        else
        {
            $data=new Category();
        }

        if($this->img_type == 'icon')
        {
            $data->img=$this->img_icon;
        }
        elseif(is_file($this->img))
        {
            $img=$this->img;
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'.'.$img->getClientOriginalExtension();
            // $file_sml_name_img = 'thumbnail_'.$file_name;
            $destinationPath = public_path('/uploads');
            // $destinationPath_smll = public_path('/uploads/thumbnail');
            // to finally create image instances
            //$image = $manager->make($destinationPath."/".$file_name);
            $image_data = Image::make($img->getRealPath());
            // now you are able to resize the instance
            $image_data->resize(768,1024);
            // and insert a watermark for example
            // $waterMarkUrl = public_path('uploads/logo.png');
            // $image_data->insert($waterMarkUrl, 'bottom-right', 10, 10);
            // finally we save the image as a new file
            $img_name = $image_data->save($destinationPath."/".$file_name);
            ///small img
            $image_small_data = Image::make($img->getRealPath());
            // now you are able to resize the instance
            $image_small_data->resize(190,250);
            // and insert a watermark for example
            // $waterMarkUrl = public_path('uploads/logo.png');
            // $image_small_data->insert($waterMarkUrl, 'bottom-right', 5, 5);
            // finally we save the image as a new file
            // $img_sml_name = $image_small_data->save($destinationPath_smll."/".$file_sml_name_img);
            // exit create img
            if(is_null($data->img)==0)
            {
                @unlink("./uploads/".$data->img);
            }
            // if(is_null($data->img_thumbnail)==0)
            // {
            //     @unlink("./uploads/thumbnail/".$data->img_thumbnail);
            // }
            $data->img = $file_name;
        }
        if($data->img_nave != $this->img_nave)
        {

            $img=$this->img_nave;
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'.'.$img->getClientOriginalExtension();
            // $file_sml_name_img = 'thumbnail_'.$file_name;
            $destinationPath = public_path('/uploads');
            // $destinationPath_smll = public_path('/uploads/thumbnail');
            // to finally create image instances
            //$image = $manager->make($destinationPath."/".$file_name);
            $image_data = Image::make($img->getRealPath());
            // now you are able to resize the instance
            $image_data->resize(1920,562);
            // and insert a watermark for example
            // $waterMarkUrl = public_path('uploads/logo.png');
            // $image_data->insert($waterMarkUrl, 'bottom-right', 10, 10);
            // finally we save the image as a new file
            $img_name = $image_data->save($destinationPath."/".$file_name);
            ///small img
            $image_small_data = Image::make($img->getRealPath());
            // now you are able to resize the instance
            $image_small_data->resize(480,140);
            // and insert a watermark for example
            // $waterMarkUrl = public_path('uploads/logo.png');
            // $image_small_data->insert($waterMarkUrl, 'bottom-right', 5, 5);
            // finally we save the image as a new file
            // $img_sml_name = $image_small_data->save($destinationPath_smll."/".$file_sml_name_img);
            // exit create img
            if(is_null($data->img_nave)==0)
            {
                @unlink("./uploads/".$data->img_nave);
            }
            // if(is_null($data->img_thumbnail)==0)
            // {
            //     @unlink("./uploads/thumbnail/".$data->img_thumbnail);
            // }
            $data->img_nave = $file_name;
        }
        $data->ord=(int)$this->ord;
        $data->type=(int)$this->type;
        $data->parent_id=(int)$this->parent_id;
        $data->name=$this->name;
        $data->name_en=$this->name_en;
        $data->choose_viewd=$this->choose_viewd;
        $data->details=$this->details;
        $data->details_en=$this->details_en;
        $object_added=$data->save();

        $this->emit('objectEdit',$object_added);
    }

    // to reset inputs after insert
    public function reset_inputs()
    {
        $this->type= null;
        $this->edit_id= null;
        $this->ord= null;
        $this->name= null;
        $this->name_en= null;
        $this->img_nave= null;
        $this->choose_viewd= null;
        $this->img_icon= null;
        $this->img_icon= null;
        $this->img_type= null;
        $this->details= null;
        $this->details_en= null;

    }

}

