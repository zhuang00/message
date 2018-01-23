
<body>
    <h1></h1>
 
    <?php $query=$this->Message_model->show(); ?>
    <?php $colors = ['alert alert-danger','alert alert-success','alert alert-info','alert alert-warning']; ?>

    <div class="container" style="padding-top:100px;">
    <?php echo $page_list;?>
    
    <?php foreach ($list as $row) { ?>

   
<div class="<?php echo $colors[array_rand($colors)] ?>" role="alert">
 <strong><?php echo $row['Id'].'.'; ?> <span>名字</span>  <?php echo $row['name'];?>
  
  <span>标题</span>   </strong><?php echo $row['title'];?></strong> 
  
  <?php echo $row['content'] ?>
  
  (<?php echo $row['date'] ?>)
 
 
  <div style="float:right">
      <h4>
      <a href="./delete/id/<?php echo $row['Id']; ?>" class="label label-danger">删除</a>
      <a href="./edit/id/<?php echo $row['Id']; ?>" class="label label-info">修改</a>
      </h2>
  </div>
</div>

<?php } ?>
