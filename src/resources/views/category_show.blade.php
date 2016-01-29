<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy Pivovarov aka AngryDeer http://studioweb.pro
 * Date: 29.01.16
 * Time: 0:10
 *
 * Если запрос прошел как /category/ в представление приходит
 * $many == true и коллекция категорий верхнего уровня в $nodes
 *
 * Если запрос прошел как /category/{slug} в представление приходит
 * $many == false и категория $node  с запрошенным ярлыком
  *
 */
?>

.
    @if($many)
        <h1>Пример меню</h1>
        <ul class="menu-ul">
            @foreach($nodes as $node)
                <li>
                    <span>{{$node->name}}</span>
                    @if($node->getDescendantCount()>0)
                        <ul class="sub-menu-ul">
                            @foreach($node->getDescendants() as $descend)
                                <li><a href="{{URL::to('/category/'.$descend->slug)}}">{{$descend->name}}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <h1>Пример вывода подкатегорий текущей вызванной</h1>
        Текущая категория: <span>{{$node->name}}</span>
        <h3>Подкатегории:</h3>
        @if($node->getDescendantCount()>0)
            <ul class="sub-menu-ul">
                @foreach($node->getDescendants() as $descend)
                    <li><a href="{{URL::to('/category/'.$descend->slug)}}">{{$descend->name}}</a></li>
                @endforeach
            </ul>
        @endif


        <h1>Пример breadcrumbs</h1>
        <style>.ibl {display:inline-block;}</style>
        <li class="ibl"><a href="{{URL::to('/')}}">Главная</a></li>
        @foreach($node->getAncestors() as $descend)
            <li class="ibl">-><a href="{{URL::to('/category/'.$descend->slug)}}">{{$descend->name}}</a></li>
        @endforeach
        <li class="ibl">->{{$node->name}}</li>
    @endif



