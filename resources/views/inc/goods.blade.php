<div class="row">

@foreach($goods as $item)
    <div class="border col w-25 p-3">
        <img class="img-fluid w-25 p-3  " src="{{asset('storage/'.$item->image->name)}}" alt="{{$item->name}}">
        {{$item->price}}
        <a href="goods/{{$item->id}}">Детальнее</a>
        @include('inc.forms.add-to-cart')
    </div>
@endforeach
    <div class="d-flex justify-content-center">
        {{ $goods->links('pagination::bootstrap-5') }}
    </div>
</div>

