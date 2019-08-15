<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title></title>
</head>
<body>
用户名：<input type="" id="name" name="">
密码：<input type="" id="pass" name="">
<button onclick="show()">登录</button>
<script type="text/javascript" src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
	function show() {
		var name=$('#name').val()
		var pass=$('#pass').val()
		// console.log(name)
		// console.log(pass)
		$.ajax({
			url:"<?php echo url('user/index');?>",
			data:{
				'_token': $('meta[name=csrf-token]').attr("content"), '_method': 'DELETE',
				name:name,
				pass:pass
			},
			type:'post',
			 dataType:'json',
			success:function (res){
				cod=res.data
				cob=res.status
				if (cob=='0') {
					alert(cod)
				}else{
					location.href='<?php echo url("login/show") ?>'
				}
			}

		})
	}
</script>
</body>
</html>