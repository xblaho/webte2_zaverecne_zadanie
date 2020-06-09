<?php

	echo '<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-info p-2">
  <a class="navbar-brand" href="index.php">Webte2 final</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">'.$lang["navbar_index_button_text"].'<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="apidescription.php">'.$lang["navbar_api_description_button_text"].'</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="octavecommands.php">'.$lang["navbar_octave_commands_button_text"].'</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          '.$lang["navbar_individual_tasks_button_text"].'
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="szaboovaklaudia.php">'.$lang["navbar_individual_tasks_submenu_1_button_text"].'</a>
          <a class="dropdown-item" href="edigurmani.php">'.$lang["navbar_individual_tasks_submenu_2_button_text"].'</a>
          <a class="dropdown-item" href="datnguyenthe.php">'.$lang["navbar_individual_tasks_submenu_3_button_text"].'</a>
          <a class="dropdown-item" href="blahoandras.php">'.$lang["navbar_individual_tasks_submenu_4_button_text"].'</a>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="statistics.php">'.$lang["navbar_statistics_button_text"].'</a>
      </li>
    </ul>
    <a href="index.php?lang=sk" class="mr-1"><img src="https://cdn.jsdelivr.net/gh/hjnilsson/country-flags@master/svg/sk.svg" width="30" alt="flag_sk"></a>
    <a href="index.php?lang=en" class="mr-4"><img src="https://cdn.jsdelivr.net/gh/hjnilsson/country-flags@master/svg/gb-nir.svg" width="35" alt="flag_gb_en"></a>
    <h4 class="text-white m-0 mr-4">'.strftime("%d.%m.%Y").'</h4>
  </div>
</nav>';

?>