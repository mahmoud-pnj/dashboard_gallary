<?php

namespace App\Http\Livewire\Task\Tasks;

use Livewire\Component;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Task as ModelsTask;
use App\Models\TaskState;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
class Task extends Component
{


    use WithFileUploads;
    use WithPagination;


    public $categories,$no_pic,$name,$add_category,$view_category,$edit,$editing_category_id,$delete,$show_select,$start_date,$due_date,$progres_percent,$task_state_id,$category_id,$categoriees,$taskStates,$description,$sub_categories;
    public $pictures ;

    public function mount()
    {
        $this->categoriees=Category::where('parent_id',0)->with('sub_category')->get();
        // dd($this->categoriees);
        $this->taskStates=TaskState::get();

        $this->task_state_id = 0;
        $this->category_id = 0;
        $this->progres_percent = 0;
        $this->no_pic=false;
        $this->add_category=false;
        $this->view_category=true;
    }


    public function render()
    {
        $this->categories=ModelsTask::get();
        $categories = ModelsTask::paginate(10);

        return view('livewire.task.tasks.task', compact('categories'));
    }
    public function get_sub($id){
        $this->sub_categories=Category::where('parent_id',$id)->get();

    }
    public function savecategory()
    {
        if ($this->edit!=true) {

        $validatedData = $this->validate([
            'name' => 'required',
            'due_date' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'progres_percent' => 'required',
            'task_state_id' => 'required',
            'category_id' => 'required',

        ]);

        $category = ModelsTask::create(['name' => $this->name,'due_date' => $this->due_date,'start_date' => $this->start_date,'progres_percent' => 0 ,'task_state_id' => $this->task_state_id,'category_id' => $this->category_id,'description' => $this->description ]);



        session()->flash('success', 'task created successfully.');
        $this->add_category=false;
        $this->view_category=true;
        }
        else{
            $validatedData = $this->validate([
                'name' => 'required|string|max:255',
                'due_date' => 'required',
                'start_date' => 'required',
                'description' => 'required',
                'progres_percent' => 'required',
                'task_state_id' => 'required',
                'category_id' => 'required',

                ]);

            $album = ModelsTask::findOrFail($this->editing_category_id);
            $album->update(['name' => $validatedData['name'],'start_date' => $validatedData['start_date'],'due_date' => $validatedData['due_date'],'progres_percent' => $validatedData['progres_percent'],'task_state_id' => $this->task_state_id,'category_id' => $this->category_id ,'description' => $this->description]);

            $this->name = '';
            $this->start_date = '';
            $this->due_date = '';
            $this->progres_percent = '';
            $this->task_state_id = 0;
            $this->progres_percent = 0;
            $this->category_id = '';
            $this->description = '';
            $this->add_category=false;
            $this->view_category=true;
               session()->flash('success', 'task updated successfully.');


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
        $category = ModelsTask::find($id);
        $this->name=$category->name;
        $this->start_date=$category->start_date;
        $this->due_date=$category->due_date;
        $this->progres_percent=$category->progres_percent;
        $this->category_id=$category->category_id;
        $this->description=$category->description;
        $this->task_state_id=$category->task_state_id;

        $this->edit=true;
        $this->editing_category_id=$id;
        $this->add_category=true;
        $this->view_category=false;
    }
    public function delete($id){
        $category = ModelsTask::find($id);


        $this->editing_category_id=$id;
        $this->add_category=false;
        $this->view_category=false;
        $this->delete=true;
        session()->flash('danger', 'you will delete the task!');


    }
    public function delete_any_way(){
        $album = ModelsTask::findOrFail($this->editing_category_id);
        $album->delete();
        $this->add_category=false;
        $this->view_category=true;
        $this->delete=false;
        session()->flash('deleted', 'task deleted successfully.');

    }



}

