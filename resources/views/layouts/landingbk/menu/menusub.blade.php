@foreach($childs as $child)
 <li class="nav-item">
   <a href="">{{ $child->name }}</a>
       @if($child->childs->count())
          <ul>
                <li class="nav-item">
                    @include('layouts.landing.menu.menusub',['childs' => $child->childs])
                </a>
                </li>
            </ul>
        @endif
   </li>
 @endforeach