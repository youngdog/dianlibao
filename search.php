
<?php
	$name = $_POST['name'];
	$brand = $_POST['brand'];

	require_once('header.php');
	require_once('searchbar.php');

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

 <?php
 	require_once('footer.php');
 ?>
