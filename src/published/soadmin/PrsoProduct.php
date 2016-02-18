<?php

Admin::model('Angrydeer\Productso\Models\PrsoProduct')->title('Товары')->display(function ()
{
	$display = AdminDisplay::datatables();
	$display->with();
	$display->filters([

	]);
	$display->columns([
		Column::string('name')->label('Товар'),
		Column::string('id')->label('Id'),
		Column::string('show')->label('Включен'),
		Column::string('views')->label('Просмотры'),
		Column::datetime('created_at')->label('Создан')->format('d.m.Y'),
	]);
	return $display;
})->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
//		FormItem::text('category_id', 'Category'),
		FormItem::text('name', 'Товар')->required(),
		FormItem::text('cost', 'Цена'),
		FormItem::text('slug', 'Ярлык (если не заполнять генерируется автоматически)'),
		FormItem::text('status', 'Статус'),
		FormItem::text('artikul', 'Артикул'),
		FormItem::multiselect('categories', 'Категории')->model('Angrydeer\Productso\Models\PrsoCategory')->display('name'),
		FormItem::text('views', 'Просмотры')->readonly(),
		FormItem::checkbox('show', 'Включен')->defaultValue(true),
//		FormItem::checkbox('complected', 'Complected'),
//		FormItem::text('complect_id', 'Complect'),
		FormItem::ckeditor('note', 'Аннотация'),
		FormItem::ckeditor('description', 'Описание'),
		FormItem::multiimages('photos', 'Изображения'),
	]);
	return $form;
});