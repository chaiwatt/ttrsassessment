<ul>
    @foreach($childs as $child)
       <li>
           {{ $child->title }}
       @if(count($child->childs))
                @include('layouts.landing.menu.managechild',['childs' => $child->childs])
            @endif
       </li>
    @endforeach
</ul>