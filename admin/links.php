<a href="../admin" class="w3-bar-item w3-button <?php if(!$_GET){echo "active";}?>"> <i class='fa fa-home fa-fx'></i> Home</a>
<a href="?newProj=true" class="w3-bar-item w3-button <?php if(isset($_GET['newProj'])){echo "active";}?>"> <i class='fa fa-plus fa-fx'></i> Create New Project</a>
<a href="?projectAccount=true" class="w3-bar-item w3-button  <?php if(isset($_GET['projectAccount'])){echo "active";}?>"> <i class='fa fa-folder-o fa-fx'></i> Project Account</a>
<a href="?requests=true" class="w3-bar-item w3-button  <?php if(isset($_GET['requests'])){echo "active";}?>"> <i class='fa fa-list-ul fa-fx'></i> Request's</a>