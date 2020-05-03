@foreach($childs as $child)
 <li class="{{ $child->childs->count() ? 'dropdown-submenu' :'' }}"><a class="dropdown-item" href="{{$child->url}}">{{$child->name}}</a>
       @if($child->childs->count())
          <ul class="dropdown-menu">
                <li>
                    @include('layouts.landing.menu.menusub',['childs' => $child->childs])
                </a>
                </li>
            </ul>
        @endif
   </li>
 @endforeach