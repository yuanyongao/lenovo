@extends("admin.public.common")
@section('main')
<!-- 内容 -->
<div class="col-md-10">

	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">商品管理</a></li>
		<li class="active">商品列表</li>

		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>

	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 批量删除</button>
			<a href="/admin/goods/create" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> 添加商品</a>

			<p class="pull-right tots" >共有 5 条数据</p>
			<form action="" class="form-inline pull-right">
				<div class="form-group">
					<input type="text" name="" class="form-control" placeholder="请输入你要搜索的内容" >
				</div>

				<input type="submit" value="搜索" class="btn btn-success">
			</form>


		</div>
		<table class="table-bordered table table-hover">
			<th><input type="checkbox" name="" ></th>
			<th>ID</th>
			<th>NAME</th>
			<th>Title</th>
			<th>KeyWords</th>
			<th>Description</th>
			<th>添加子类</th>
			<th>楼层</th>
			<th>操作</th>
			<th>操作</th>
			<th>操作</th>
			@foreach($data as $value)
			<tr>
			<td><input type="checkbox" name="" ></td>
			<td>{{$value->id}}</td>
			<td>{{$value->cid}}</td>
			<td>{{$value->title}}</td>
			<td>{{$value->info}}</td>
			<td>{{$value->img}}</td>
			<td>{{$value->price}}</td>
			<td>{{$value->num}}</td>
			<td>{{$value->text}}</td>
			<td>{{$value->config}}</td>
			<td><a href="/admin/types/1/edit" class="glyphicon glyphicon-pencil"></a>&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="del({{$value->id}})" class="glyphicon glyphicon-trash"></a></td>
			</tr>
			@endforeach
		</table>
		<!-- 分页效果 -->
		<div class="panel-footer">
			<nav style="text-align:center;">
				<ul class="pagination">
					<li><a href="#">&laquo;</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">&raquo;</a></li>
				</ul>
			</nav>

		</div>
	</div>
</div>
{{--<script>--}}

	{{--//删除数据--}}
	{{--function del(id) {--}}
	    {{--confirm("您确认删除吗?");--}}

	    {{--$.post("/admin/types/"+id,{'_token':"{{csrf_token()}}",'_method':'delete'},function (data){--}}
	        {{--if (data==1){--}}
	            {{--window.location.reload();--}}
			{{--}--}}

		{{--})--}}


    {{--}--}}
{{--</script>--}}
@endsection
