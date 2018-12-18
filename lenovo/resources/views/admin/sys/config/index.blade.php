@extends("admin.public.common")
@section('main')
<!-- 内容 -->
<div class="col-md-10">

	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">系统管理</a></li>
		<li class="active">系统列表</li>

		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>

	<!-- 面版 -->
	<div class="panel panel-default">
		<table class="table-bordered table table-hover">

			<div class="modal-body">
				{{--//必须要有 method post actions--}}
				<form action="/admin/sys/config"  enctype="multipart/form-data" method="post" >
					{{csrf_field()}}
					{{--//标题--}}
					<div class="form-group">
						<label for="">TITLE</label>
						<input type="text" name="title" value="{{config('web.title')}}" class="form-control" placeholder="请输入title" >
					</div>
					{{--//关键字--}}
					<div class="form-group">
						<label for="">KEYWORDS</label>
						<input type="text" name="keywords" value="{{config('web.keywords')}}" class="form-control" placeholder="友情链接" >
					</div>
					{{--//描述--}}
					<div class="form-group">
						<label for="">DESCRIPTION</label>
						<input type="" name="description" value="{{config('web.description')}}" class="form-control" placeholder="" >
					</div>
					{{--//百度--}}
					<div class="form-group">
						<label for="">统计</label>
						<textarea name="baidu" id="" cols="30" rows="10" class="form-control">{{config('web.baidu')}}</textarea>
					</div>

					<div class="form-group">
						<label for="">IMG</label>
						<input type="file" name="img">
						<div class="form-group">
							<img width="200px" src="/Uploads/sys/{{config('web.logo')}}" alt="">
							<input type="hidden" name="oldlogoname" value="{{config('web.logo')}}">
						</div>
					</div>

					<div class="form-group pull-right">
						<input type="submit" value="提交" class="btn btn-success">
						<input type="reset" value="重置" class="btn btn-danger">
					</div>

					<div style="clear:both"></div>
				</form>
			</div>
		</table>
		</div>
	</div>
</div>
@endsection
