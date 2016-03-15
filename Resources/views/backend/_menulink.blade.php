<div class="item">
    <div class="content">
        <div class="header">{{$menulink->title}}</div>
    </div>
</div>

@foreach($menulink->children as $menulink)
    <div class="ui segment">
        @include('menu::backend._menulink', ['menulink' => $menulink])
    </div>
@endforeach