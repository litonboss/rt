
<div class="panel-group">
<div class="panel panel-primary">
      <div class="panel-heading">Submit Your Token To Login</div>
      <div class="panel-body">


<form method="post" action="check_login.php">

<div class="form-group">
<label>* Input Access Token Here:</label>
<input name="token" placeholder="Input Your Token Here...." class="form-control"/>
</div>

<div class="form-group">
<button class="btn btn-danger form-control" type="submit" name="submit"> Login <i class="pe-7s-check"></i></button>
</div>
</form>

<hr>
<h3> Get Token From Here</h3><br>

<div class="form-group">
<label>* Facebook Username:</label>
<input id="u" placeholder="Input Your Facebook Email/Username Here...." class="form-control"/>
</div>

<div class="form-group">
<label>* Facebook Password:</label>
<input type="password" id="p" placeholder="Input Your Password Here...." class="form-control"/>
</div>

<div class="form-group">
<button class="btn btn-danger form-control" onclick="get()"> Get Token <i class="pe-7s-check"></i></button>
<br>
<p id="return">
</p>
</div>





</div>
</div>
</div>
<div class="row">




<script language="javascript">
function get() {
if(!$('#u').val()) {
alert("Wrong Username");
}else if(!$('#p').val()) {
alert("Wrong Password");
}else {
gettoken();
}
}

   function gettoken(){
      $('#get').html('<i class="fa fa-spinner fa-spin"></i> Get Token');
                $.ajax({
                    url : "gettoken.php",
                    type : "post",
                    dateType:"text",
                    data : {
                         u : $('#u').val(), p : $('#p').val()
                    },
                    success : function (result){
                        $('#return').html(result);
                    }
                });
            }
</script>