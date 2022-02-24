<div class="row">

@foreach($goods as $item)
    <div class="border col w-25 p-3">
        <img class="img-fluid w-25 p-3  " src="{{asset('images/'.$item->image->name.$item->image->extension)}}" alt="{{$item->name}}">
        {{$item->price}}
        <a href="{{route('goods-one',$item->id)}}">Детальнее</a>
        <form action="{{route('add-to-shopping-cart')}}" method="post">
            @csrf{{--защищенный ключ--}}
            <input type="hidden" name="goods_id" value="{{$item->id}}">
            <input type="hidden" name="user_id" value="1">{{--user_id--}}
            <button type="submit">Значок корзины</button>
        </form>
    </div>
@endforeach
    <div class="d-flex justify-content-center">
        {{ $goods->links('pagination::bootstrap-5') }}
    </div>
</div>

