
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>CRUD - Items Management</title>
		<meta
		content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
		name='viewport'>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/mystyle.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="container">
			<div class="row title">
				<h1>Item Management</h1>
			</div>
			<div class="row" id="alert"></div>
			<form name="form1" action="" id="form1" method="POST">
				<div class="row">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Search & Filter
								<span class="glyphicon glyphicon-refresh pull-right" class="pointer" aria-hidden="true"></span>
							</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-4">
								<button type="button" class="btn btn-success btn-filter" >All(12)</button>
								<button type="button" class="btn btn-default btn-filter" >Active(6)</button>
								<button type="button" class="btn btn-default btn-filter" >InActive(6)</button>
							</div>
							<div class="col-md-4 pull-right">
								<div class="input-group">
									<input type="text" class="form-control" id="search" name="search" placeholder="Search for" aria-label="search" value="">
									<div class="input-group-btn">
										<button type="button" name="clear" id="clear" class="btn btn-default">Clear</button>
										<button type="button" name="search" id="search" class="btn btn-success">Search</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">List Items</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-3">
								<div class="input-group">
									<div class="form-group">
										<select class="form-control form-inline"" name="action">
											<option value="default">Bulk Action</option>
											<option value="active">Active</option>
											<option value="inactive">InActive</option>
											<option value="ordering">Change Ordering</option>
											<option value="delete">Delete</option>
										</select>
									</div>
									<div class="input-group-btn">
										<button type="submit" name="apply" id="apply" class="btn btn-info">Appy</button>
									</div>
								</div>
							</div>
							<div class="col-md-1 pull-right btn-add">
								<button class="btn btn-info btn-warning" type="button">Add new</button>
							</div>
							<div class="col-md-12 table-content">
								<table class="table table-bordered">
									<thead class="text-center">
										<tr>
											<th>
												<input type="checkbox" class="pointer" id="checkAll" name="checkAll">
											</th>
											<th style="width: 5%" class="text-center pointer" id="id">ID
												<i class="fa fa-fw fa-sort-asc"></i>
											</th>									
											<th style="width: 25%" class="text-center pointer" id="name" >Name
												<i class="fa fa-fw fa-sort"></i>
											</th>									
											<th style="width: 20%" class="text-center pointer" id="status" >Status
												<i class="fa fa-fw fa-sort"></i>
											</th>									
											<th style="width: 25%" class="text-center pointer" id="ordering" >Ordering
												<i class="fa fa-fw fa-sort"></i>
											</th>									
											<th style="width: 30%" class="text-center">Action</th>
										</tr>
									</thead>
									<tbody class="text-center">
										<tr>
											<td  class="td-content"><input type="checkbox" name="cid[]" value="1"></td>
											<td  class="td-content">1</td>
											<td  class="text-left td-content">Tý</td>
											<td  class="td-content">
												<button  type="button"class="btn btn-warning btn-sm btn-status" id="status-1">Inactive</button>
											</td>
											<td  class="td-content">
												<div class="col-md-6 col-md-offset-3">
													<input class="form-control text-center" type="text" name="ordering[1]" value="1">
												</div>
											</td>
											<td  class="td-content"">
												<button type="button" class="btn btn-warning btn-sm" >Edit</button>
												<button type="button" class="btn btn-danger btn-sm" >Delete</button>
											</td>
										</tr>
										<tr>
											<td  class="td-content"><input type="checkbox" name="cid[]" value="2"></td>
											<td  class="td-content">2</td>
											<td  class="text-left td-content">Sửu</td>
											<td  class="td-content"><button type="button" class="btn btn-success btn-sm btn-status" id="status-2">Active</button></td>
											<td  class="td-content">
												<div class="col-md-6 col-md-offset-3">
													<input class="form-control text-center" type="text" name="ordering[2]" value="2">
												</div>
											</td>
											<td  class="td-content"">
												<button type="button" class="btn btn-warning btn-sm" >Edit</button>
												<button type="button" class="btn btn-danger btn-sm" >Delete</button>
											</td>
										</tr>
										<tr>
											<td  class="td-content">
												<input type="checkbox" name="cid[]" value="3">
											</td>
											<td  class="td-content">3</td>
											<td  class="text-left td-content">Dần</td>
											<td  class="td-content">
												<button  type="button"class="btn btn-warning btn-sm btn-status" id="status-3">Inactive</button>
											</td>
											<td  class="td-content">
												<div class="col-md-6 col-md-offset-3">
													<input class="form-control text-center" type="text" name="ordering[3]" value="3">
												</div>
											</td>
											<td  class="td-content"">
												<button type="button" class="btn btn-warning btn-sm" >Edit</button>
												<button type="button" class="btn btn-danger btn-sm" >Delete</button>
											</td>
										</tr>							
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Pagination
								<div class="pull-right btn-add">
									<span class="label label-danger">Total entries: 12</span>
									<span class="label label-warning">Total page: 4</span>
								</div>
							</h3>
						</div>
						<div class="panel-body info-pagination">
							<div class="col-md-6">
								<p class="text-left">Number of element on the page: 
									<b class="text-hightlight">3</b>
								</p>
								<p class="text-left">Showing 
									<b class="text-hightlight"> 1 </b> 
									to 
									<b class="text-hightlight"> 3 </b> 
									of
									<b class="text-hightlight"> 12 </b> 
									entries
								</p>
							</div>
							<div class="col-md-6 content-pagination">
								<ul class="pagination pull-right">
									<li class="disabled"><a href="#">«</a></li>
									<li class="disabled"><a href="#">‹</a></li>
									<li class="active"><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#" >3</a></li>
									<li><a href="#">›</a></li>
									<li><a href="#">»</a></li>
								</ul>					
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<script src="assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="assets/js/myscript.js" type="text/javascript"></script>
	</body>
</html>