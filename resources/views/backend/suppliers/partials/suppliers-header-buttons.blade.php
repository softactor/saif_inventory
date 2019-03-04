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
    <li><a href="{{route('admin.suppliers.index')}}"><i class="fa fa-list-ul"></i> All Suppliers</a></li>
    @permission('create-projects')
    <li><a href="{{route('admin.suppliers.create')}}"><i class="fa fa-plus"></i> Create Suppliers</a></li>
    @endauth
  </ul>
</div>