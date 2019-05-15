<?php
if (!defined('BASEPATH')) {
  exit('No direct script access allowed');
}

function assets_url($url)
{
  return base_url('assets/' . $url);
}
