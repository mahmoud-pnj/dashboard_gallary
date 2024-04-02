<div>
@dd('')
@forelse ($item2->sub_category  as $item)
<div>
<option value="{{ $item->id }}"> -->{{ $item2->name }}</option>
<livewire.task.tasks.option :variable="$variable" />
</div>
@empty

@endforelse
</div>
