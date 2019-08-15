<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table border="1">
		<!-- <tr><td>123</td></tr> -->
	</table>
	<button ><a href="<?php echo url("del/del") ?>">退出</a>
</button>
<script type="text/javascript" src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
	function show() {
		$.ajax({
			url:"<?php echo url('tab/show');?>",
			 dataType:'json',
			success:function (res){
				var cod= res.data
				tr=''
				for (var i = 0; i < cod.length; i++) {
					tr=tr+"<tr><td>"+cod[i]['id']+"</td><td>"+cod[i]['user_name']+"</td><td>"+cod[i]['password']+"</td></tr>"
				}
				$("table").html(tr)
			}
		})
	}
	show()
	
</script>
</body>
</html>