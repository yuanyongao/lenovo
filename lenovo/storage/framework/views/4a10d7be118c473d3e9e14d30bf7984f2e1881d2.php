<?php $__env->startSection('main'); ?>
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
			<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<tr>
			<td><input type="checkbox" name="" ></td>
			<td><?php echo e($value->id); ?></td>
			<td><?php echo e($value->cid); ?></td>
			<td><?php echo e($value->title); ?></td>
			<td><?php echo e($value->info); ?></td>
			<td><?php echo e($value->img); ?></td>
			<td><?php echo e($value->price); ?></td>
			<td><?php echo e($value->num); ?></td>
			<td><?php echo e($value->text); ?></td>
			<td><?php echo e($value->config); ?></td>
			<td><a href="/admin/types/1/edit" class="glyphicon glyphicon-pencil"></a>&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="del(<?php echo e($value->id); ?>)" class="glyphicon glyphicon-trash"></a></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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


	
	
	    

	    
	        
	            
			

		


    

<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.public.common", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>