<?php
Class IM_Camera
{
	public $ID;
	public $IMEI;
	public $Name;
	public $Date_in;
	public $Date_out;
	public $Note;
	
	public function get_Camera_by_ID()
	{
		global $wpdb;
		$get_camera = $wpdb->get_var("select * from camera_imei where ID='".$this->ID."'");
		return $get_camera;
	}
	public function get_Camera_by_IM()
	{
		global $wpdb;
		$get_camera = $wpdb->get_var("select * from camera_imei where IMEI='".$this->IMEI."'");
		return $get_camera;
	}
	public function insert()
	{
		foreach($this as $key => $value)
		{
			$data[$key]=$value;
		}
		global $wpdb;
		
		$wpdb->insert("camera_imei",$data);
		$info = $this -> get_Camera_by_IM();
		return $info;
	}
	public function update()
	{	
		foreach($this as $key => $value)
		{
			$data[$key]=$value;
		}
		global $wpdb;
		$wpdb->update("camera_imei",$data,array("ID"=>$this->ID));
		$info = get_Camera_by_IM($this->IMEI);
		return $info;
	}
	public function delete()
	{
		global $wpdb;
		$wpdb->delete('camera_imei', array("ID" => $this->ID));
	}
	
}

function check_imei($im)
{
	global $wpdb;
	$imei = $wpdb->get_var("select * from camera_imei where IMEI='".$im."'");
	if ($imei)
		return true;
	else
		return false;
}
function show_success($s)
{
	?>
		<div class="alert alert-success" role="alert">
		<?php 
		foreach($s as $value){
			echo "<p><strong><span class='glyphicon glyphicon-ok'></span></strong> ".$value."</p>";
		}
		?>
		</div>
	<?php 
}
function show_error($error)
{
	if ($error=="") return;
	?>
	<div class="alert alert-danger" role="alert">
		<?php
			
			foreach($error as $value){
			echo "<p><strong><span class='glyphicon glyphicon-remove'></span></strong> ".$value."</p>";
		}
		?>
	</div>
	<?php 
}
function get_Camera_by_IMEI($im)
{
	global $wpdb;
	$get_camera = $wpdb->get_results("select * from camera_imei where IMEI='".$im."'");
	return $get_camera;
}

function template_show_imei()
{
	global $wpdb;
	$imeis = $wpdb->get_results("select * from camera_imei");
	if ($imeis)
	{
		foreach ( $imeis as $im ) 
		{
		?>
		<tr>
			<td><?php echo $im->ID; ?></td>
			<td><?php echo $im->IMEI; ?></td>
			<td><?php echo $im->Name; ?></td>
			<td><?php echo $im->Date_in; ?></td>
			<td><?php echo $im->Date_out; ?></td>
			<td><?php echo $im->Note; ?></td>
			<td><a href="?IM_edit=<?php echo $im->IMEI ?>">Sửa</a> - <a href="?type=del&IM=<?php echo $im->IMEI ?>">Xóa</a></td>
			
		</tr>
		<?php 
		}
	}
}
function delete_imei($im)
	{
		global $wpdb;
		$r = $wpdb->delete('camera_imei', array("IMEI" => $im));
		return $r;
	}
function edit_imei($info_imei,$o_IM)
{
	foreach($info_imei as $key => $value)
		{
			$data[$key]=$value;
		}
	global $wpdb;
	$wpdb->update("camera_imei",$data,array("IMEI"=>$o_IM));
	$info = get_Camera_by_IMEI($data['IMEI']);
	return $info;
	
}
function tp_form_search_imei()
{
?>
	<div class="pull-right">
	<form id="search_imei" class="form-horizontal">
		<div class="input-group input-group-sm">
			<input id="s" class="form-control form-search" type="text" placeholder="Nhập IMEI hoặc tên sản phẩm" name="imei">
			<span class="input-group-btn">
				<button class="btn btn-danger" type="submit">
					<i class="glyphicon glyphicon-search"></i>
				</button>
			</span>
		</div>
	</form>
	</div>
		
<?php
}
function template_from_add_imei()
{
?>
	<form class="form-horizontal" method="get">
	<div class="col-sm-6">
		<div class="form-group">
			<label for="inputIMEI" class="col-sm-4 control-label">IMEI *</label>
			<div class="col-sm-8">
			  <input type="text" class="form-control" id="inputIMEI" name="IM" placeholder="IMEI" required value="<?php if(isset($_GET['IM'])) echo $_GET['IM']  ?>" >
			</div>
		 </div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="inputDate" class="col-sm-3 control-label">Bảo hành *</label>
			<div class="col-sm-9">
			  <input type="date" class="form-control" id="inputDate" name="Date_out" placeholder="Ngày hết hạn bảo hành" value = "<?php if(isset($_GET['Date_out'])) echo $_GET['Date_out']  ?>" required>
			</div>
		 </div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<label for="inputDate" class="col-sm-2 control-label">Tên sản phẩm</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="inputDate" name="Name" placeholder="Tên sản phẩm" value = "<?php if(isset($_GET['Name'])) echo $_GET['Name']  ?>">
			</div>
		 </div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<label for="inputDate" class="col-sm-2 control-label">Ghi chú</label>
			<div class="col-sm-10">
			  <textarea class="form-control" name="Note" rows="3"><?php if(isset($_GET['Note'])) echo $_GET['Note']  ?></textarea>
			</div>
		 </div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-default" name="type" value="add" >Thêm</button>
		</div>
	  </div>
	</div>
	</form>
<?php
}
function template_from_edit_imei($im)
{
	$cam = get_Camera_by_IMEI($im);
	if ($cam)
	{ 
	foreach ( $cam as $item )
		{
?>
	<h2>Sửa IMEI: <?php echo $item->IMEI;  ?></h2>
	<form class="form-horizontal" method="get">
	<input type="hidden" name="o_IMEI" value="<?php echo $item->IMEI; ?>" />
	<div class="col-sm-6">
		<div class="form-group">
			<label for="inputIMEI" class="col-sm-4 control-label">IMEI *</label>
			<div class="col-sm-8">
			  <input type="text" class="form-control" id="inputIMEI" name="IM" placeholder="IMEI" value = "<?php echo $item->IMEI; ?>" required >
			</div>
		 </div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="inputDate" class="col-sm-3 control-label">Bảo hành *</label>
			<div class="col-sm-9">
			  <input type="date" class="form-control" id="inputDate" name="Date" placeholder="Ngày hết hạn bảo hành" value = "<?php echo $item->Date_out; ?>" required>
			</div>
		 </div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<label for="inputDate" class="col-sm-2 control-label">Tên sản phẩm</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="inputDate" name="Name" value = "<?php echo $item->Name; ?>" placeholder="Tên sản phẩm">
			</div>
		 </div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<label for="inputDate" class="col-sm-2 control-label">Ghi chú</label>
			<div class="col-sm-10">
			  <textarea class="form-control" name="Note" rows="3"><?php echo $item->Note; ?></textarea>
			</div>
		 </div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-default" name="type" value="edit" >Sửa</button>
		  <a href="?type=del&IM=<?php echo $item->IMEI ?>"><button type="button" class="btn btn-danger">Xóa</button></a>
		</div>
	  </div>
	</div>
	</form>
<?php
		}
	}
}