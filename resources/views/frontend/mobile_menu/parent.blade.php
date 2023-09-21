@if(!empty($menus))
<ul class="mobile-menu">
	@foreach ($menus as $key=> $row) 
		@if (isset($row->children)) 
		<li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">{{ __($row->text) }}</a>

				
				@foreach($row->children as $childrens)
						    @include('frontend.mobile_menu.child', ['childrens' => $childrens,'data_parent' => 'parent'.$key])
					
				@endforeach
				
			</li>
		@else
		<li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ url($row->href) }}">{{ __($row->text) }}</a>
	    
	    @endif
	@endforeach
  </ul>
@endif