@if(!empty($menus))
<ul>
	@foreach ($menus as $key=> $row) 
		@if (isset($row->children)) 
			<li class="position-static">
				<a href="{{ url($row->href) }}" id="{{strtolower(str_replace(' ', '_',$row->text))}}">{{ __($row->text) }} <i class="fi-rs-angle-down"></i></a>
				
				 {{-- <ul class="mega-menu"> --}}
				@foreach($row->children as $childrens)
						{{-- <div class="left_mega_  @if(isset($childrens->children) && isset($childrens->children[0]->children) ) add_menu_width @endif"> --}}
						    @include('frontend.menu.child', ['childrens' => $childrens,'data_parent' => 'parent'.$key])
						{{-- </div> --}}
				@endforeach
					{{-- </ul> --}}
			</li>
		@else
	      <li><a href="{{ url($row->href) }}" class="{{$row->text}}-menu" id="{{strtolower(str_replace(' ', '_',$row->text))}}">
			{{-- <img src="{{asset($row->image)}}" width="" alt=""> --}}
			{{ __($row->text) }}
		</a></li>
	    @endif
	@endforeach
  </ul>
@endif