

@if(!empty($menus))
<ul>
	@foreach ($menus as $key=> $row) 
		@if (isset($row->children)) 
			<li class="sidebar-dropdown"><a href="{{ url($row->href) }}" class="submenu">{{ __($row->text) }}</a>
				@if (isset($row->children[0]->children))
					<div class="mega_menu_ul sidebar-submenu">
				@else
					<div class="mega_menu_ul sidebar-submenu  without_subchild">
				@endif
				@foreach($row->children as $childrens)
						<div class="left_mega_">
						    @include('components.menu.child', ['childrens' => $childrens,'data_parent' => 'parent'.$key])
						</div>
				@endforeach
					</div>
			</li>
		@else
	      <li><a href="{{ url($row->href) }}">{{ __($row->text) }}</a></li>
	    @endif
	@endforeach
  </ul>
@endif