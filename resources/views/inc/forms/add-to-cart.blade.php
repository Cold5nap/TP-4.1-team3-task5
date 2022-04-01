<form action="/shopping-cart" method="post">
    @csrf{{--защищенный ключ--}}
    <input type="hidden" name="goods_id" value="{{$item->id}}">
    <button type="submit">Значок корзины</button>
</form>
