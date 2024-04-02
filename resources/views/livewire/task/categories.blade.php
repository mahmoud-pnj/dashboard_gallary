
<div class="card card-custom">
	<div class="card-header flex-wrap py-5">
		<div class="card-title">
			<h3 class="card-label"><?php echo @$title_page; ?>

			<div class="text-muted pt-2 font-size-sm">
			</div></h3>
        </div>

		<div class="card-toolbar">
            <!--begin::Button-->
            <a href="javascript:void(0);" wire:click="edit_form" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md"> {!!$btn_kwrd !!}
              </a>
            {{-- <a href="javascript:void(0);" wire:click="deleted" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md"> deleted
              </a> --}}
			<!--end::Button-->
        </div>


    </div>

    <div class="card-body" style="overflow-x: auto;">
            <div class="col-md-6 offset-3" >
            </div>
@if ($showForm == true)
        <livewire:admin.categories.edit />
@elseif ($showDeleted == true)
        <livewire:admin.categories.deleted />
@else

<?php
$dis_cat='d-none';
$dis_det='';
$dis_img='';
$img_type='';
if($parent_id > 0)
{
    $dis_cat='';
}
if($type == 1)
{
    $dis_det='';
}
if(count($results)):
?>
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr>
                <th>#</th>
                <th class="{{ $dis_img}}">IMG/الصورة</th>
                <th>الاسم</th>
                <th>EN Name </th>
                <th>Action/الاجراء</th>
              </tr>
            </thead>
            <tbody>
<?php
$i=1;
foreach ($results as $result):

?>
                <tr>
                    <td><?php echo $result->ord; ?></td>
                    <td>
                        @if ($img_type=='icon')
                            {!! $result->img !!}
                        @else
                        <img src="{{ img_chk_exist($result->img) }}" style="width: 70px; height: 60px" />
                        @endif

                    </td>
                    <td class="text-primery" dir="rtl"><?php echo $result->name;  ?></td>
                    <td><?php echo $result->name_en;  ?></td>
                    <td style="padding: 0px;width: 30%;">
                        <!---------- active & Dis active Button --->
@if ($parent_id == 0 )
                         <a href="{{ url(config('app.url_admin').'category/'.$type.'/'.$result->id.'') }}"><button class="btn btn-default bg-info">{{ __('ms_lang.sub_categories') }}</button></a>
@endif
                        {!! add_btn_active('javascript:void(0);',' wire:click="active_ms('.$result->id.')"',$result->is_active) !!}
                        {!! add_btn_edit('javascript:void(0);',' wire:click="edit_form('.$result->id.')"') !!}
                        {!! add_btn_delete('javascript:void(0);',' wire:click="delete_ms('.$result->id.')"') !!}
                    </td>
                </tr>
<?php $i++; endforeach; ?>
            </tbody>
          </table>
<?php  else: ?>
            <h2 style="width: 17%;margin-right: 40%;margin-left: 40%;"><center class="alert-warning" style="border-radius: 15px">{{ __('ms_lang.no_results') }}</center></h2>
<?php endif; ?>
        <!--end: Datatable-->

        @endif
        </div>
</div>

