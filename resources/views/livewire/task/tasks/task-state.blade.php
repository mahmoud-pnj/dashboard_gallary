<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

    <div>
        @if ($add_category==true)
        <a  wire:click='view_categorys' class="btn btn-secondary">View states</a>
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
                <label for="name">task state Name:</label>
                <input type="text" class="form-control" id="name" wire:model="name">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="progress_num_from">Progress from:</label>
                <input type="number" class="form-control" id="progress_num_from" wire:model.lazy="progress_num_from" min="0" max="100">
                @error('progress_num_from') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="progress_num_to">Progress to:</label>
                <input type="number" class="form-control" id="progress_num_to" wire:model.lazy="progress_num_to" min="0" max="100">
                @error('progress_num_to') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="color">Color:</label>
                <input type="color" id="color" wire:model.lazy="color">
            </div>

            <div>
                <label>Choose a color:</label>
                <div class="color-options">
                    <div class="color-option" style="background-color: red;" wire:click="setColor('red')"></div>
                    <div class="color-option" style="background-color: green;" wire:click="setColor('green')"></div>
                    <div class="color-option" style="background-color: blue;" wire:click="setColor('blue')"></div>
                    <!-- Add more color options as needed -->
                </div>
            </div>



            @if ($edit!=true)


            <button type="submit" class="btn btn-primary">Create task state</button>
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
    @if ($taskStates)
    <div>
        <table class="table table-striped" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <thead>
                <tr>
                    <th>task Name</th>
                    <th> from</th>
                    <th>  to</th>
                    <th> colour</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($taskStates as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->progress_num_from }}</td>
                    <td>{{ $category->progress_num_to }}</td>
                    <td>
                        <div style="width: 20px; height: 20px; background-color: {{ $category->color }};"></div>
                    </td>

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
