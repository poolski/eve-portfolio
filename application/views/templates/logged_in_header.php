<?php if(isset($characters)) {?>
<ul class="nav nav-pills">
 <li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">My characters<b class="caret"></b></a>
  <ul class="dropdown-menu">
  <?php foreach ($characters as $char): ?>
  <?php if(is_array($char) && array_key_exists('name', $char)) { ?>
    <li><a href="<?php echo base_url();?>character/assets/<?php echo($char['characterID']);?>"><?php echo($char['name']); ?></a></li>
   <?php } ?>
  <?php endforeach ?>
  </ul>
  </li>
</ul>
<!--End character list-->
<? } ?>
<ul class="nav pull-right">
  <div class="btn-group">
    <a class="btn dropdown-toggle btn-info btn-mini" data-toggle="dropdown" href="#">
      <i class="icon-user icon-white"></i>
      <?php echo($this->session->userdata('username'));?> - Manage
      <b class="icon-chevron-down icon-white"></b>
    </a>
    <ul class="dropdown-menu">
      <li><a href="<?php echo base_url();?>account">My Characters</a></li>
      <li><a href="<?php echo base_url();?>add">Add a character</a></li>
      <li><di</li>
      <li><a href="<?php echo base_url();?>account/logout">Log out</a></li>
    </ul>
  </div>
</ul>