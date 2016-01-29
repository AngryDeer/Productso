<?php

Admin::model(Angrydeer\Productso\Models\PrsoCategory::class)->title('Категории товаров')->display(function ()
{
	$display = AdminDisplay::tree();
	$display->value('name');
	return $display;

})->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::text('name', 'Название'),
//		FormItem::text('_lft', 'Lft'),
//		FormItem::text('_rgt', 'Rgt'),
//		FormItem::text('parent_id', 'Parent'),
		FormItem::text('slug', 'Ярлык'),
		FormItem::checkbox('showtop', 'Главное меню')->defaultValue(true),
		FormItem::checkbox('showside', 'Боковое меню')->defaultValue(true),
		FormItem::checkbox('showbottom', 'Меню подвала')->defaultValue(true),
		FormItem::checkbox('showcontent', 'В спсике категорий')->defaultValue(true),
		FormItem::ckeditor('note', 'Аннотация'),
		FormItem::ckeditor('desc', 'Описание'),
	]);
	return $form;
});
