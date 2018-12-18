@extends("admin.public.common")
@section('main')
	{{--<!-- 引入CSS -->--}}
	{{--<link rel="stylesheet" href="/up/uploadify.css">--}}
	{{--<!-- 引入JQ -->--}}
	{{--<script src="/style/admin/public/bs/js/jquery.min.js"></script>--}}
	{{--<!-- 引入文件上传插件 -->--}}
	{{--<script src="/up/jquery.uploadify.min.js"></script>--}}
<!-- 内容 -->
<div class="col-md-10">

	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">系统管理</a></li>
		<li class="active">轮播图列表</li>

		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>

	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>批量删除</button>
			<a href="javascript:;" data-toggle="modal" data-target="#add" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> 添加轮播图</a>

			<p class="pull-right tots" >共有{{$tot}}条数据</p>


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
			<th>TITLE</th>
			<th>HREF</th>
			<th>ORDER</th>
			<th>IMG</th>
			<th>操作</th>
			@foreach($data as $value)
			<tr>
				<td><input type="checkbox" name="" ></td>
				<td>{{$value->id}}</td>
				<td>{{$value->title}}</td>
				<td>{{$value->href}}</td>
				<td>{{$value->order}}</td>
				<td ><img height="150px" width="300px" src="/Uploads/lun/{{$value->img}}" alt=""></td>
				<td><a href="/admin/user/1/edit" class="glyphicon glyphicon-pencil"></a>&nbsp;&nbsp;&nbsp;<a href="" class="glyphicon glyphicon-trash"></a></td>
			</tr>
			@endforeach
		</table>
		<!-- 分页效果 -->
		<div class="panel-footer">
			{{ $data->links() }}

		</div>
	</div>
</div>
<!-- 添加页面模态框 -->
<div class="modal fade" id="add">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">添加轮播图</h4>
			</div>
			<div class="modal-body">
				{{--//必须要有 method post actions--}}
				<form action="/admin/sys/slider"  enctype="multipart/form-data" method="post" id="formAdd">
					{{csrf_field()}}
					<div class="form-group">
						<label for="">title</label>
						<input type="text" name="title" class="form-control" placeholder="请输入title" >
					</div>

					<div class="form-group">
						<label for="">Href</label>
						<input type="text" name="href" class="form-control" placeholder="友情链接" >
					</div>

					<div class="form-group">
						<label for="">Order</label>
						<input type="number" name="order" class="form-control" placeholder="数值越大越靠前" >
					</div>

					<div class="form-group">
						<label for="">IMG</label>
						<input type="file" name="img">
					</div>

					<div class="form-group pull-right">
						<input type="submit" value="提交" class="btn btn-success">
						<input type="reset" value="重置" class="btn btn-danger">
					</div>

					<div style="clear:both"></div>
				</form>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
