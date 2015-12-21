@extends('layout.main') @section('content')
<section class="content-header">
	<h1>
		Servers <small>all</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Servers</li>
	</ol>
</section>
<table class="table table-hover">
	<tr>
		<th>ID</th>
		<th>Ip</th>
		<th>Status</th>
		<th>Addtime</th>
	</tr>
	@foreach ($servers as $v)
	<tr>
		<td>{{$v->id}}</td>
		<td>{{$v->ip}}</td>
		<td><span class="label label-success">Approved</span></td>
		<td>11-7-2014</td>
	</tr>
	@endforeach
</table>
@stop
