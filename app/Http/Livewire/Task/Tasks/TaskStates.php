<?php

namespace App\Http\Livewire\Task\Tasks;

use Livewire\Component;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Task as ModelsTask;
use App\Models\TaskState;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
class TaskStates extends Component
{



    use WithFileUploads;
    use WithPagination;


    public $categories,$no_pic,$name,$add_category,$view_category,$edit,$editing_category_id,$delete,$show_select,$start_date,$due_date,$progres_percent,$task_state_id,$category_id,$categoriees,$taskStates,$description,$progress_num_from,$progress_num_to,$color;
    public $pictures ;

    public function mount()
    {
        $this->categoriees=Category::get();
        $this->taskStates=TaskState::get();


        $this->no_pic=false;
        $this->add_category=false;
        $this->view_category=true;
    }
    public function render()
    {
        $categories = TaskState::paginate(10);

        return view('livewire.task.tasks.task-state', compact('categories'));
    }
    public function savecategory()
    {
        if ($this->edit!=true) {

        $validatedData = $this->validate([
            'name' => 'required',
            'progress_num_from' => 'required',
            'progress_num_to' => 'required',
            'color' => 'required',


        ]);

        $category = TaskState::create(['name' => $this->name,'progress_num_from' => $this->progress_num_from ,'progress_num_to' => $this->progress_num_to,'color' => $this->color]);



        session()->flash('success', 'task state created successfully.');
        $this->add_category=false;
        $this->view_category=true;
        }
        else{
            $validatedData = $this->validate([
                'name' => 'required',
                'progress_num_from' => 'required',
                'progress_num_to' => 'required',
                'color' => 'required',

                ]);

            $album = TaskState::findOrFail($this->editing_category_id);
            $album->update(['name' => $this->name,'progress_num_from' => $this->progress_num_from, 'progress_num_to' => $this->progress_num_to,'color' => $this->color]);

            $this->name = '';
            $this->progress_num_from = '';
            $this->progress_num_to = '';
            $this->color = '';

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
        $category = TaskState::find($id);
        $this->name=$category->name;
        $this->progress_num_from=$category->progress_num_from;
        $this->progress_num_to=$category->progress_num_to;
        $this->color=$category->color;

        $this->edit=true;
        $this->editing_category_id=$id;
        $this->add_category=true;
        $this->view_category=false;
    }
    public function delete($id){
        $category = TaskState::find($id);


        $this->editing_category_id=$id;
        $this->add_category=false;
        $this->view_category=false;
        $this->delete=true;
        session()->flash('danger', 'you will delete the task state!');


    }
    public function delete_any_way(){
        $album = TaskState::findOrFail($this->editing_category_id);
        $album->delete();
        $this->add_category=false;
        $this->view_category=true;
        $this->delete=false;
        session()->flash('deleted', 'task state deleted successfully.');

    }



}
