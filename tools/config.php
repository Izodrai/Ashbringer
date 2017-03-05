<<?php

function load_config() {
  return json_decode(file_get_contents("config/general_config.json"));
}

 ?>
