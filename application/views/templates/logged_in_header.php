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
  <li class="divider-vertical"></li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      Your account
      <b class="icon-off icon-white"></b>
    </a>
    <ul class="dropdown-menu">
      <li><a href="<?php echo base_url();?>account">My Characters</a></li>
      <li><a href="<?php echo base_url();?>add">Add a character</a></li>
      <li><di</li>
      <li><a href="<?php echo base_url();?>account/logout">Log out</a></li>
    </ul>
  </ul>
</ul>