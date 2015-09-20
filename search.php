<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
     
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>查询结果 | 电力宝</title>
	</head>
	<body>
		<h1>请输入你要查询的产品型号</h1>
		<p>本站支持模糊查询，模糊查询的通配符是 %
			<ul>
				<li>如果你要搜索一个品类，直接输入名称就可以，比如输入：DZ47</li>
				<li>如果你要更精确，再添加参数，比如输入： DZ47%1P</li>
				<li>如果你要搜索 dz47 1p c16，可以输入: dz47%1p%c16</li>
				<li>搜索不区分大小写，输入 dz47 和 DZ47 出来的结果都是一样的</li>
			</ul>
		</p>
		<p>支持按照厂家搜索，如果不选厂家，则默认搜索所有的厂家</p>
		<form action="search.php" method="post">
			<select name="brand">
				<option value="%">默认不指定厂家</option>
				<option value="正泰">正泰</option>
				<option value="德力西">德力西</option>
				<option value="中国人民">中国人民</option>
				<option value="天正">天正</option>
			</select>
			<label for="name">产品型号</label>
			<input type="text" id="name" name="name" placeholder="超过30万条记录">
			<input type="submit" value="提交查询"	name="submit">  
		</form>

		<?php
			$name = $_POST['name'];
			$brand = $_POST['brand'];

			if(isset($_POST['submit'])){ //判断是否有点击提交
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
					echo   '<table border="1">';
					echo   '<tr>';
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
		 <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1256323616'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1256323616%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
		 </body>
</html>
