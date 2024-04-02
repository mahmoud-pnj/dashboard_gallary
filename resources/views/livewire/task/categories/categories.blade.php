<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

    <div>
        @if ($add_category==true)
        <a  wire:click='view_categorys' class="btn btn-secondary">View categories</a>
        <a  href="{{ route('categories') }}" class="btn btn-secondary">View main categories</a>
        @endif
        @if ($view_category==true)
        <a wire:click='add_new_category' class="btn btn-success">Add New category</a>
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
                <label for="name">category Name:</label>
                <input type="text" class="form-control" id="name" wire:model="name">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            @if ($edit!=true)

            <div class="form-group">
                <label for="pictures">Pictures:</label>
                <input type="file" class="form-control" id="pictures" wire:model="pictures" multiple>
                @error('pictures') <span class="text-danger">{{ $message }}</span> @enderror
                @error('pictures.*') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create category</button>
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
                <button  wire:click='move_to_another'type="button" class="btn btn-warning">delete and move the photos to another category</button>
                @endif

                <button wire:click='view_categories' type="button" class="btn btn-success">back</button>
              </div>
            @else
            <div class="form-group">
                <label for="category">category:</label>
                <select class="form-control" id="category" wire:model="new_category_id">
                    <option value="">Select category</option>
                        @foreach ($categoryes as $categorye)
                        <option value="{{ $categorye->id }}"> {{ $categorye->name }}</option>

                        @endforeach

                </select>
                @error('new_category_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button  wire:click='move_to_selected'type="button" class="btn btn-warning">move the photos to selected category</button>
            @endif

        </div>

    </div>
    @endif
    @if ($view_category==true)
    @if ($categoriees)
    <div>
        <table class="table table-striped" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <thead>
                <tr>
                    <th>category Name</th>
                    <th>Pictures</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categoriees as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <img src="{{ asset($category->img) }}" width="60" alt="{{$category->name }}">
                    </td>
                    <td>
                        <button wire:click="edit_category({{ $category->id }})" type="button" class="btn btn-info  btn-sm">Edit</button>
                        <button  wire:click="delete({{ $category->id }})" type="button" class="btn btn-danger  btn-sm">Delete</button>
                        <button type="button" class="btn btn-sm btn-custom" >
                            <a href="{{ route('subcategories', ['id' => $category->id]) }}" title="{{ __('Subcategories') }}">Subcategories</a>
                        </button>


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
<style>
    .btn-custom {
        background-color: violet;
        border-color: violet;
        color: white;
    }

</style>

<!--   Core JS Files   -->
<script src="/assets/js/plugins/chartjs.min.js"></script>
<script src="/assets/js/plugins/Chart.extension.js"></script>
