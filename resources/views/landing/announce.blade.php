@extends('layouts.announce.main')
@section('pageCss')
@stop
@section('content')
  <section>
    <div class="container">
      <div class="section-title">
        <h2 class="content sarabun">ข่าวประกาศ</h2>
      </div>
     <div class="search-announce mb-5">
       <form action="">
        <label for="floatingInput">ค้นหาประกาศ: </label>
         <input type="text" name="" id="search" placeholder="กรอกคำค้นหา ..." class="search-announce-box" >

         <label for="floatingInput" class="mt-1">ประเภทประกาศ: </label>
         <select id="announcecategory" class="search-announce-box form-select form-select-sm" aria-label=".form-select-sm example">
          <option selected>-- เลือกหมวดประกาศ --</option>
           @foreach ($announcecategories as $announcecategory)
            <option value="{{$announcecategory->id}}">{{$announcecategory->name}}</option>
           @endforeach
        </select>
      </form>
     </div>
      </div>
    </div>
    <div class="container" id="announce_wrapper">
      @foreach ($announces as $announce)
        <p class="announce-p"><i class="icofont-ui-folder"></i> {{$announce->day}} {{$announce->month}} {{$announce->year}} ({{$announce->announcecategory->name}}) <a class="ml-3" href="{{route('landing.announcenews',['slug' => $announce->slug])}}"> {{$announce->title}}</a></p>
        <hr class="announce-hr">
      @endforeach
      {{$announces->links()}}
    </div>
  </section>

@endsection
@section('pageScript')
<script>
  var route = {
      url: "{{ url('/') }}",
      token: $('meta[name="csrf-token"]').attr('content'),
  };
</script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/announcehelper.js')}}"></script>
@stop
