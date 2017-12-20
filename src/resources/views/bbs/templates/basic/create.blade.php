@extends ('bbs.layouts.default')

@section ('content')
<div class='basic-table create'>
	@if (isset($article))
		{!! Form::open([
			'route' => ['bbs.update', $tbl_name, $article->id],
			'class' => 'form-horizontal',
			'method' => 'put',
			'enctype' => 'multipart/form-data',
		]) !!}
	@else
		{!! Form::open([
			'route' => ['bbs.store', $tbl_name],
			'class' => 'form-horizontal',
			'enctype' => 'multipart/form-data',
		]) !!}
	@endif
	
	<h1 class='title'>
		{{ $bbs_config->name }}
	</h1>
	
	<table>
	<colgroup>
		<col width='120' />
		<col width='' />
	</colgroup>
	<thead>
		<tr>
			<th>제목</th>
			<td>
				{!! Form::text('title', isset($article) ? $article->title : old('title'), [
					'class' => 'form-control input-sm',
					'id' => 'title'
				]) !!}
			</td>
		</tr>
		<tr>
			<th>내용</th>
			<td style='padding: 5px 10px;'>
				@include ('bbs.plugins.smart_editor.editor', ['name' => 'content', 'value' => isset($article) ? $article->content : old('content')])
			</td>
		</tr>
		<tr class='file-control'>
			<th>파일</th>
			<td>
				<ul class='list-inline'>
					@for ($i = 0; $i < 5; $i ++)
					<li>
						{!! Form::file('uploads['.$i.']', [
							'id' => 'uploads['.$i.']',
							'class' => 'file-controls',
						]) !!}
						<button type='button' class='btn btn-default btn-sm pull-left file-control-btn'>
							<span class='glyphicon glyphicon-paperclip'></span>
							&nbsp;파일 추가
						</button>
					</li>
					@endfor
				</ul>
			</td>
		</tr>
	</thead>
	</table>
	
	<div class='form-group'>
		<div class='col-sm-12 text-right'>
			{!! Form::submit('작성완료', [
				'class' => 'btn btn-primary btn-sm',
			]) !!}
			{!! Html::link(route('bbs.index', [$tbl_name]), '목록', [
				'class' => 'btn btn-default btn-sm',
			]) !!}
		</div>
	</div>
</div>
{!! Form::close() !!}
@stop

@section ('css')
<style>
	@include ('bbs.templates.basic.css.style')
</style>
@stop

@section ('script')
<script>
$('.file-control-btn').click(function() {
	$(this).closest('li').find('input[type=file]').trigger('click');
});

$('.file-controls').change(function() {
	var $btnControl = $(this).closest('li').find('.file-control-btn');
	
	if ($(this).val() != '') {
		$btnControl.removeClass('btn-default');
		$btnControl.addClass('btn-primary');
	} else {
		$btnControl.removeClass('btn-primary');
		$btnControl.addClass('btn-default');
	}
});
</script>
@stop