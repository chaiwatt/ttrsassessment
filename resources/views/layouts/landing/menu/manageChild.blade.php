<ul>
    @foreach($childs as $child)
       <li>
           {{ $child->name }}
       @if(count($child->childs))
                @include('layouts.landing.menu.managechild',['childs' => $child->childs])
            @endif
       </li>
    @endforeach
</ul>