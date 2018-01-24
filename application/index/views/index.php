
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">CI留言板</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

          <form class="navbar-form navbar-right" id="loginform" method="post">

                  <div class="form-group">
                          <input type="text" name='email' placeholder="Email" class="form-control">
                  </div>
                  <div class="form-group">
                          <input type="password" name='password' placeholder="Password" class="form-control">
                  </div>
                  <button type="button" class="btn btn-success" id="login">登陆</button>
                  <a href="reg.php"  class="btn btn-success">注册</a>


          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

  
    <?php $query=$this->Message_model->show(); ?>
    <?php $colors = ['alert alert-danger','alert alert-success','alert alert-info','alert alert-warning']; ?>

    <div class="container" style="padding-top:100px;">
      <nav aria-label="Page navigation">
        <ul class="pagination">
           

          <li>
            <a href="./index.php?p=" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>

         <li class="active"><a href="./index.php?p=">1</a></li>
            <li class=""><a href="./index.php?p">2</a></li>
          <li class="disabled">
            <a aria-label="Previous">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
      
      <?php foreach ($query->result() as $row) {
    ?>

   
	      <div class="<?php echo $colors[array_rand($colors)] ?>" role="alert">
           <strong><?php echo $row->Id.'.'; ?> <span>名字</span>  <?php echo $row->name; ?>
            
            <span>标题</span>   </strong><?php echo $row->title; ?></strong> 
            
            <?php echo $row->content ?>
            
            (<?php echo $row->date ?>)
           
           
            <div style="float:right">
	        	<h4>
	        	<a href="<?php echo site_url('message/delete/id/').$row->Id; ?>" class="label label-danger">删除</a>
				<a href="<?php echo  site_url('message/edit/id/').$row->Id; ?>" class="label label-info">修改</a>
				</h2>
	        </div>
	      </div>

          <?php
} ?>
          <!-- <div class="alert alert-success" role="alert">faewfawfawefawef</div> -->
      <form class="form-inline" action="" method="post">
		  <div class="form-group">
		    <label class="sr-only" for="exampleInputEmail3">用户名</label>
		    <input type="text" class="form-control" id="exampleInputEmail3" name="name" placeholder="用户名">
		  </div>
		  <button type="submit" class="btn btn-success" id='btn'>留言</button>

		  <div class="" style="margin-top:10px;">
              <div style="margin-bottom:10px;width=100%;"> <input type="text" class="form-control"  name="title" placeholder="标题"></div>
            
		  	<textarea style="width:100%" class="form-control" rows="5" name="content"></textarea>
		  </div>

		</form>

      <hr>
      <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script>
          $(function () {  
              $('#btn').click(function(){
                  var data = $('.form-inline').serializeArray()
                  $.ajax({
                      type: "post",
                      url: "./add",
                      data: data,
                      dataType: "json",
                      success: function (res) {
                          if(res.error==0){
                            alert(res.info)
                            location.reload()
                          }else{
                              alert(res.info)

                          }
                      },
                      error: function(e) { 
                        console.log(e);
                        } 
       
                      
                  });
                  return false;
              })
              
          })
    </script>


<script>
$(function () { 
	
});
</script>