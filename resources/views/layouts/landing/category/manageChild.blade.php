<ul>
    @foreach($childs as $child)
       <li class="nav-item">
           
           <a class="nav-link" href="#">{{ $child->name }}</a>
       @if(count($child->childs))
                @include('layouts.landing.category.managechild',['childs' => $child->childs])
            @endif
       </li>
    @endforeach
</ul>