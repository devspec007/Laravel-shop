@if ($childrens)
	@if(isset($childrens->children))
	   
    @endif
  	<ul class="mega-menu menu-grid">
  		@if(isset($childrens->children))
		  @if(isset($self))
	         <h4 class="{{$childrens->text}}-menu" @if($childrens->type == 'hidden')style="display: none;" @endif id="{{strtolower(str_replace(' ', '_',$childrens->text))}}">{{ __(trim($childrens->text)) }}</h4> 
	      @else
			<h3 class="{{$childrens->text}}-menu" @if($childrens->type == 'hidden')style="display: none;"@endif  id="{{strtolower(str_replace(' ', '_',$childrens->text))}}">{{ __(trim($childrens->text)) }}</h3>
		  @endif
  		@else
		    <li><a href="{{ url($childrens->href) }}" class="{{$childrens->text}}-menu" id="{{strtolower(str_replace(' ', '_',$childrens->text))}}">{{ trim($childrens->text) }}</a> </li>	
  		@endif
		@if (isset($childrens->children)) 
		
			@foreach($childrens->children as $parent=> $row)
			   @if(isset($row->children))
			        @include('frontend.menu.child', ['childrens' => $row,'child_data_parent'=>'child_parent'.$parent,'self'=>true])
		       @else
			     <li><a href="{{ url($row->href) }}" class="{{$childrens->text}}-menu" id="{{strtolower(str_replace(' ', '_',$row->text))}}"> {{ucwords(strtolower($row->text))}} </a></li>
		       @endif
			@endforeach
		
		@endif
	</ul>
@endif

