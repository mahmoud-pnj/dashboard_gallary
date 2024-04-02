<?php

namespace App\Http\Livewire\Task\Categories;

use Livewire\Component;
use Illuminate\Support\Str;

use App\Models\Category;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class Categories extends Component
{
    use WithFileUploads;
    use WithPagination;


    public $categories,$no_pic,$name,$add_category,$view_category,$edit,$editing_category_id,$delete,$show_select,$parent_id;
    public $pictures ;

    public function mount(Request $request)
    {
        if ($request->id) {
            $this->parent_id=$request->id;

           }
           else {
            $this->parent_id=0;
        }

        $this->no_pic=false;
        $this->add_category=false;
        $this->view_category=true;
    }
    public function render(Request $request)
    {
        if ( $this->parent_id!=0) {
            $categoriees = Category::where('parent_id', $this->parent_id)->paginate(10);

           }
           else {
            $categoriees = Category::where('parent_id',0)->paginate(10);
        }
        $this->categories=Category::get();

        return view('livewire.task.categories.categories', compact('categoriees'));
    }
    public function savecategory()
    {
        if ($this->edit!=true) {

        $validatedData = $this->validate([
            'name' => 'required',
            // 'pictures' => 'required|array',

        ]);

        $category = Category::create(['name' => $this->name ,'parent_id'=>$this->parent_id]);



        session()->flash('success', 'category created successfully.');
        $this->add_category=false;
        $this->view_category=true;
        }
        else{
            $validatedData = $this->validate([
                'name' => 'required|string|max:255',
            ]);

            $album = category::findOrFail($this->editing_category_id);
            $album->update(['name' => $validatedData['name'],'parent_id'=>$this->parent_id]);

            $this->name = '';
            $this->add_category=false;
            $this->view_category=true;
               session()->flash('success', 'category updated successfully.');


        }
    }

    public function add_new_category(){
        $this->add_category=true;
        $this->view_category=false;
        $this->delete=false;

    }
    public function view_categorys(){
        $this->add_category=false;
        $this->view_category=true;
        $this->delete=false;

    }
    public function edit_category($id){
        $category = category::find($id);
        $this->name=$category->name;
        $this->edit=true;
        $this->editing_category_id=$id;
        $this->add_category=true;
        $this->view_category=false;
    }
    public function delete($id){
        $category = category::find($id);


        $this->editing_category_id=$id;
        $this->add_category=false;
        $this->view_category=false;
        $this->delete=true;
        session()->flash('danger', 'you will delete the categry!');


    }
    public function delete_any_way(){
        $album = category::findOrFail($this->editing_category_id);
        $album->delete();
        $this->add_category=false;
        $this->view_category=true;
        $this->delete=false;
        session()->flash('deleted', 'category deleted successfully.');

    }



}
