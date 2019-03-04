<!--Action Button-->
  @if(Active::checkUriPattern('admin/blogCategories'))
      <export-component></export-component>
  @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Action
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{{route('admin.plantEquipment.index')}}"><i class="fa fa-list-ul"></i> {{trans('menus.backend.plantequipments.all')}}</a></li>
    @permission('create-plant-equipment')
    <li><a href="{{route('admin.plantEquipment.create')}}"><i class="fa fa-plus"></i> {{trans('menus.backend.plantequipments.create')}}</a></li>
    @endauth
  </ul>
</div>