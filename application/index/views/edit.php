
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
          <a class="navbar-brand" href="#">留言板</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->

    <?php $colors = ['alert alert-danger','alert alert-success','alert alert-info','alert alert-warning']; ?>
    <style>
    .menu{
        color: black; 
      
        width:40px; 
        text-align:left; 
        line-height:22px;
        display: inline-block;
    }

</style>
    <div class="container" style="padding-top:100px;">
    <?php $query=$this->Message_model->show_where($this->uri->segment(4)); ?>
    <?php $row = $query->row();?>
    
      <form class="form-inline" action="<?php echo site_url('/message/update/id/'); echo $row->Id; ?>" method="post">
		  <div class="form-group">
            <label class="sr-only" for="exampleInputEmail3">用户名</label>
            <span class='menu'>name</span>
            <input type="text" class="form-control" id="exampleInputEmail3" value="<?php echo $row->name ?>" name="name" placeholder="用户名"><br>
            <span class='menu'>url</span>
            <input type="text" class="form-control" id="exampleInputEmail3" value="<?php echo $row->url ?>" name="url" placeholder="url"><br>
            <span class='menu'>title</span>
            <input type="text" class="form-control" id="exampleInputEmail3" value="<?php echo $row->title ?>" name="title" placeholder="title"><br>
		  </div>
		 
        
		  <div class="" style="margin-top:20px;">
              <span class='menu'>content</span>
             
		  	<textarea style="width:100%" class="form-control" rows="5" name="content"><?php echo$row->content ?></textarea>
          </div>
          <hr>
          <button type="submit" class="btn btn-success">更新</button>
		</form>
      <hr>

 