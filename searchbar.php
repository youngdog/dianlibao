		<div id="main-container"> <!-- this container is for sticky foot, min-height: 100 -->
			<div class="container" id="content-container">
				<div class="page-header">
					<h1>请输入查询型号</h1>
				</div>
				<div class="text-muted">
					<p>支持模糊查询,比如要查询10A的DZ47,只需要输入 DZ47空格C10,不区分大小写</p>
				</div>
				<form action="search.php" method="post">
					<select name="brand" class="form-control">
						<option value="%">默认不指定厂家</option>
						<option value="正泰" <?php if($_POST['brand'] == '正泰') echo 'selected'?>>正泰</option>
						<option value="德力西" <?php if($_POST['brand'] == '德力西') echo 'selected'?>>德力西</option>
						<option value="中国人民" <?php if($_POST['brand'] == '中国人民') echo 'selected'?>>中国人民</option>
						<option value="天正" <?php if($_POST['brand'] == '天正') echo 'selected'?>>天正</option>
					</select>
					<label for="name">产品型号</label>
					<input type="text" id="name" name="name" placeholder="超过三十万条数据" value="<?php echo $_POST['name']; ?>">
					<input type="submit" value="提交查询"	name="submit" class="btn btn-success">  
				</form>