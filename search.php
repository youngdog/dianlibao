<!DOCTYPE html>
     
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>查询结果 | 电力宝</title>

		<link href="css/bootstrap.min.css" rel="stylesheet">

	</head>
	<body>
		<h2 class="text-center">请输入你要查询的产品型号</h2>
		<div>
			<p>本站支持模糊查询，模糊查询的通配符是 %
				<ul>
					<li>如果你要搜索一个品类，直接输入名称就可以，比如输入：DZ47</li>
					<li>如果你要更精确，再添加参数，比如输入： DZ47%1P</li>
					<li>如果你要搜索 dz47 1p c16，可以输入: dz47%1p%c16</li>
					<li>搜索不区分大小写，输入 dz47 和 DZ47 出来的结果都是一样的</li>
				</ul>
			</p>
			<p>支持按照厂家搜索，如果不选厂家，则默认搜索所有的厂家</p>
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

		<?php
			require 'counter.php';
			$name = $_POST['name'];
			$brand = $_POST['brand'];

			if(isset($_POST['submit'])){ //判断是否有点击提交

				printf("累计查询%d次", counter());

		        if(!empty($name)){   //如果有提交，如果输入型号不为空

		        	//连接数据库
		        	$dbc = mysqli_connect('localhost', 'youngdog', 'youngdog', 'dlb') or die('连接服务器出错.');
					mysqli_query($dbc,"set names 'utf8'");

					//查询数据库
					$query = "select * from product where spec like '%$name%' and brand like '$brand'";
					$result = mysqli_query($dbc, $query) or die(查询出错);

					//显示查询结果
					echo  '<br />';
					printf("查询成功 总共%d条结果", mysqli_num_rows($result));
					echo   '<br />'.'<br />';
					echo   '<table class="table table-striped">';
					echo   '<tr class="success">';
					echo   '<th>品牌</th>';
					echo   '<th>产品型号</th>';
					echo   '<th>类型</th>';
					echo   '<th>装箱数</th>';
					echo   '<th>面价</th>';
					while ($row = mysqli_fetch_array($result)) {
						echo '<tr>';
						echo '<td>'; echo $row['brand']; echo  '</td>';
						echo '<td>'; echo $row['spec']; echo '</td>';
						echo '<td>'; echo $row['class']; echo '</td>';
						echo '<td>'; echo $row['boxnum']; echo '</td>';
						echo '<td>'; echo $row['price']; echo'</td>';
						echo '</tr>';
					} 
					echo '</table>';	
			
					//关闭数据库
					mysqli_close($dbc);
				}

				else echo '请输入型号';    //如果有提交，但是没有输入型号
			}
			
		 ?>

		 
		 <!-- 下面这行是网站访问统计代码 -->
		 <!--script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1256323616'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1256323616%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script-->
		 </body>
</html>
