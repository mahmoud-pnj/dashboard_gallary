<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

    <div>
        @if ($add_category==true)
        <a  wire:click='view_categorys' class="btn btn-secondary">View tasks</a>
        @endif
        @if ($view_category==true)
        <a wire:click='add_new_category' class="btn btn-success">Add New task</a>
        @endif
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session()->has('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }}
        </div>
        @endif

    </div>
    @if ($add_category==true)

    <div>


        <form wire:submit.prevent="savecategory" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">task Name:</label>
                <input type="text" class="form-control" id="name" wire:model="name">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" class="form-control" id="start_date" wire:model.lazy="start_date">
                @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="date" class="form-control" id="due_date" wire:model.lazy="due_date">
                @error('due_date') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="progress_percent">Progress Percent:</label>
                <input type="number" class="form-control" id="progress_percent" wire:model.lazy="progres_percent" min="0" max="100">
                @error('progres_percent') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="task_state_id">Task State:</label>
                <select class="form-control" id="task_state_id" wire:model.lazy="task_state_id">
                    <option value="">Select Task State</option>
                    @foreach ($taskStates as $taskState)
                        <option value="{{ $taskState->id }}">{{ $taskState->name }}</option>
                    @endforeach
                </select>
                @error('task_state_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category">
                    <option value="">Select Category</option>
                    @foreach ($categoriees as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>

                    @if ($item->sub_category)

                    @foreach ($item->sub_category as $item2)
                    @if($loop->first)
                    <optgroup label="{{  $item->name}}">
                    @endif
                        <option value="{{ $item2->id }}">-> {{ $item2->name }}</option>
                       @forelse ($item2->sub_category  as $item3)
                       <option value="{{ $item3->id }}">'-->' {{ $item3->name }}</option>
                       {{--  <livewire.task.tasks.option :sub_cat="$item" />  --}}
                       <option value="{{ $item3->id }}">-> {{ $item3->name }}</option>
                       @forelse ($item3->sub_category  as $item3)
                       <option value="{{ $item3->id }}">'-->' {{ $item3->name }}</option>
                       {{--  <livewire.task.tasks.option :sub_cat="$item" />  --}}
                       @forelse ($item3->sub_category  as $item3)
                       <option value="{{ $item3->id }}">'-->' {{ $item3->name }}</option>
                       {{--  <livewire.task.tasks.option :sub_cat="$item" />  --}}
                       @empty

                       @endforelse
                       @empty

                       @endforelse
                       @empty

                       @endforelse

                    @endforeach


                    @endif

                    @endforeach


                </select>
                @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" wire:model.lazy="description" rows="4"></textarea>
            </div>

            @if ($edit!=true)


            <button type="submit" class="btn btn-primary">Create task</button>
            @else
            <button type="submit" class="btn btn-primary">Edit</button>

            @endif




            <!-- Add View categories button -->
        </form>
    </div>
    @endif
    @if ($delete==true)

    <div>

        @if (session()->has('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
        @endif
        <div>
            @if ($show_select!=true)
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button wire:click='delete_any_way' type="button" class="btn btn-danger">Delete any way </button>
                @if ($no_pic==true)
                <button  wire:click='move_to_another'type="button" class="btn btn-warning">delete and move the photos to another task</button>
                @endif

                <button wire:click='view_categories' type="button" class="btn btn-success">back</button>
              </div>
            @else
            <div class="form-group">
                <label for="category">task:</label>
                <select class="form-control" id="category" wire:model="new_category_id">
                    <option value="">Select task</option>
                        @foreach ($categoryes as $categorye)
                        <option value="{{ $categorye->id }}"> {{ $categorye->name }}</option>

                        @endforeach

                </select>
                @error('new_category_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button  wire:click='move_to_selected'type="button" class="btn btn-warning">move the photos to selected task</button>
            @endif

        </div>

    </div>
    @endif
    @if ($view_category==true)
    @if ($categories)
    <div>
        <table class="table table-striped" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <thead>
                <tr>
                    <th>task Name</th>
                    <th style="width: 25px;">description</th>
                    <th> start date</th>
                    <th> Due date</th>
                    <th> progress percent</th>
                    <th>  category</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td style="width: 25px;">{{ $category->description }}</td>
                    <td>{{ $category->start_date }}</td>
                    <td>{{ $category->due_date }}</td>
                    <td>{{ $category->progres_percent }}</td>
                    <td>{{ $category->progres_percent }}</td>

                    <td>
                        <button wire:click="edit_category({{ $category->id }})" type="button" class="btn btn-info  btn-sm">Edit</button>
                        <button  wire:click="delete({{ $category->id }})" type="button" class="btn btn-danger  btn-sm">Delete</button>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{--  {{ $categories->links() }}  --}}
    </div>
    @endif
    @endif


</main>

<!--   Core JS Files   -->
<script src="/assets/js/plugins/chartjs.min.js"></script>
<script src="/assets/js/plugins/Chart.extension.js"></script>
