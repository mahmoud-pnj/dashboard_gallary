<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

    <div>
        @if ($add_album==true)
        <a  wire:click='view_albums' class="btn btn-secondary">View Albums</a>
        @endif
        @if ($view_album==true)
        <a wire:click='add_new_album' class="btn btn-success">Add New Album</a>
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
    @if ($add_album==true)

    <div>


        <form wire:submit.prevent="saveAlbum" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Album Name:</label>
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
            <button type="submit" class="btn btn-primary">Create Album</button>
            @else
            <button type="submit" class="btn btn-primary">Edit</button>

            @endif


            <!-- Add View Albums button -->
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
                <button  wire:click='move_to_another'type="button" class="btn btn-warning">delete and move the photos to another album</button>
                @endif

                <button wire:click='view_albums' type="button" class="btn btn-success">back</button>
              </div>
            @else
            <div class="form-group">
                <label for="album">Album:</label>
                <select class="form-control" id="album" wire:model="new_album_id">
                    <option value="">Select Album</option>
                        @foreach ($albumes as $albume)
                        <option value="{{ $albume->id }}"> {{ $albume->name }}</option>

                        @endforeach

                </select>
                @error('new_album_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button  wire:click='move_to_selected'type="button" class="btn btn-warning">move the photos to selected album</button>
            @endif

        </div>

    </div>
    @endif
    @if ($view_album==true)
    @if ($albums)
    <div>
        <table class="table table-striped" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <thead>
                <tr>
                    <th>Album Name</th>
                    <th>Pictures</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($albums as $album)
                <tr>
                    <td>{{ $album->name }}</td>
                    <td>
                        @foreach ($album->pictures as $picture)
                        <img src="{{ asset($picture->picture) }}" width="60" alt="{{$picture->name }}">
                        @endforeach
                    </td>
                    <td>
                        <button wire:click="edit_album({{ $album->id }})" type="button" class="btn btn-info  btn-sm">Edit</button>
                        <button  wire:click="delete({{ $album->id }})" type="button" class="btn btn-danger  btn-sm">Delete</button>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{ $albums->links() }}
    </div>
    @endif
    @endif


</main>

<!--   Core JS Files   -->
<script src="/assets/js/plugins/chartjs.min.js"></script>
<script src="/assets/js/plugins/Chart.extension.js"></script>
