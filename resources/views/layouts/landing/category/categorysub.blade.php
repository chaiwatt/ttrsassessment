@foreach($childs as $child)
 <li class="{{ $child->childs->count() ? 'dropdown-submenu' :'' }}"><a class="dropdown-item" href="{{$child->url}}">
    @if (Config::get('app.locale') == 'th')
        {{ $child->name }}
    @else
        {{ $child->engname }}
    @endif
</a>
       @if($child->childs->count())
          <ul class="dropdown-menu">
                <li>
                    @include('layouts.landing.category.categorysub',['childs' => $child->childs])
                </a>
                </li>
            </ul>
        @endif
   </li>
 @endforeach