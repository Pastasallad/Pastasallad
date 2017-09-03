<nav class="navbar navbar-toggleable-sm navbar-light bg-faded">

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="container">
    <a class="navbar-brand" href="https://pastasallad.nu/"><i class="fa fa-cutlery fa-lg" style="color:#ccc;"></i> Pastasallad.nu</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li clasåås="nav-item<?php echo $hem;?>">
          <a class="nav-link" href="https://pastasallad.nu/">Hem</a>
        </li>
        <li class="nav-item<?php echo $overtid;?>">
          <a class="nav-link" href="#">Page 1</a>
        </li>
        <li class="nav-item dropdown<?php echo $sida2;?>">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" href="#">Sida 2</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Page 2.1</a>
              <a class="dropdown-item" href="#">Page 2.2</a>
              <a class="dropdown-item" href="#">Page 2.3</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Page 2.2.1</a>
            </div>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa fa-contao fa-lg" style="color:#fc0;"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
