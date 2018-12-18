@extends("admin.public.common")
@section('main')
<!-- 内容 -->
<script type="text/javascript" charset="utf-8" src="/baidu/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/baidu/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/baidu/lang/zh-cn/zh-cn.js"></script>
<div class="col-md-10">

	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">商品管理</a></li>
		<li class="active">商品添加</li>

		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>

	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="index.html" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 商品页面</a>
			<a href="" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> 添加商品</a>
		</div>
		<div class="panel-body">
			<form action="/admin/goods" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
					<label for="">商品名</label>
					<input type="text" name="title" class="form-control" placeholder="请输入商品名">
				</div>

				<div class="form-group">
					<label for="">商品简介</label>
					<textarea name="info" id="" cols="30" rows="10" class="form-control" placeholder="请输入商品简介"></textarea>
				</div>

				<div class="form-group">
					<label for="">商品所属分类</label>
					<select name="cid" id="" class="form-control">
						<option value="">商品所属分类</option>
						@foreach($data as $v)
							@if($v->size == 2)
								<option value="{{$v->id}}">{{$v->html}}</option>
							@else
								<option disabled value="{{$v->id}}">{{$v->html}}</option>
							@endif
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="">商品价格</label>
					<input type="text" name="price" class="form-control" placeholder="请输入商品价格">
				</div>

				<div class="form-group">
					<label for="">商品库存</label>
					<input type="text" name="num" class="form-control" placeholder="请输入商品库存">
				</div>

				<div class="form-group">
					<label for="">商品封面图片</label>
					<input type="file" name="img">
				</div>

				<div class="form-group">
					<label for="">商品多图片</label>
					<input type="file" name="imgs">
				</div>

				<div class="form-group">
					<label >商品简介</label>
					<script name="text" id="editor" type="text/plain" style="width:100%;height:300px;" ></script>
				</div>

                <div class="form-group">
                    <label >商品配置</label>
                    <script name="config" id="editor1" type="text/plain" style="width:100%;height:300px;" ></script>
				</div>

				<div class="form-group">
					<input type="submit" value="提交" class="btn btn-success">
					<input type="reset" value="重置" class="btn btn-danger">
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(function () {
        var ue = UE.getEditor('editor');
        var ue = UE.getEditor('editor1');

    })
</script>
@endsection