<?php $this->getContent();
?>
<div class="container">
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Phalcon Login</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="#">M1</a></li>
	      <li><a href="#">E1</a></li>
	      <li><a href="#">G2</a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	    <?php
	    	if ($this->session->has("kAdi")) {
		    $kAdi = $this->session->get("kAdi");
		    echo '<li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	        <span class="glyphicon glyphicon-user"></span> '.$kAdi.'</a>
	        <ul class="dropdown-menu">
	          <li><a href="kullanici/Cikis"><span class="glyphicon glyphicon-log-out"></span> Çikiş Yap</a></li>
	        </ul>
	      </li>';
			}
			else{
				echo '<li><a href="kullanici/kaydol"><span class="glyphicon glyphicon-user"></span> Kayit Ol</a></li>
				<li><a href="kullanici"><span class="glyphicon glyphicon-log-in"></span> Giriş Yap</a></li>';
			}	
	     ?>
	     </ul>
	  </div>
	</nav>
</div>