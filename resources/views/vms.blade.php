@extends('layout.main') @section('content')
<section class="content-header">
	<h1>
		Vms <small><a href="#" class="" data-toggle="modal"
			data-target="#compose-modal"><i class="fa fa-plus"></i> Create Vm</a></small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Vms</li>
	</ol>
</section>
<table class="table table-hover">
	<tr>
		<th width="320px">ID</th>
		<th>IP</th>
		<th>CPU</th>
		<th>MEMORY</th>
		<th>OS</th>
		<th>STATUS</th>
		<th>CREATE TIME</th>
	</tr>
	@foreach ($vms as $v)
	<tr>
		<td>{{$v->id}}</td>
		<td>{{$v->ip}}</td>
		<td>{{$v->cpu}}</td>
		<td>{{$v->memory}}</td>
		<td>windows7</td>
		<td><span class="label label-success">Running</span></td>
		<td>{{$v->created_at}}</td>
	</tr>
	@endforeach
</table>
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">&times;</button>
				<h4 class="modal-title">Create Vm</h4>
			</div>
			<form action="#" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label>Name:</label> <input name="name" type="text"
							class="form-control" placeholder="Vm Name">
					</div>
					<div class="form-group">
						<label>Cpu:</label> <select class="form-control">
							<option> 1</option>
							<option> 2</option>
							<option> 3</option>
							<option> 4</option>
							<option> 5</option>
						</select>
					</div>
					<div class="form-group">
						<label>Memory:</label> <select class="form-control">
							<option>512MB</option>
							<option>1024MB</option>
							<option>2GB</option>
							<option>4GB</option>
							<option>8GB</option>
						</select>
					</div>
					<div class="form-group">
						<label>OS:</label> <select class="form-control">
							<option>windows 7</option>
						</select>
					</div>
					<div class="form-group">
						<label>Server:</label> <select class="form-control">
						@foreach ($servers as $v)
							<option>{{$v->ip}}</option>
						@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Port:</label> <input name="name" type="text"
							class="form-control" placeholder="Vm Desktop Port" value="5900">
					</div>
				</div>
				<div class="modal-footer clearfix">

					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<i class="fa fa-times"></i> Cancle
					</button>
					<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Create</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@stop
