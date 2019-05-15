<?php
if (!defined('BASEPATH')) {
  exit('No direct script access allowed');
}

class ImageService
{
  private static $instance;

  function __construct()
  {
  }

  public static function getInstance()
  {
    if (!self::$instance) {
      // If no instance then make one
      self::$instance = new ImageTools();
    }

    return self::$instance;
  }
}

class ImageTools
{
  private const LINK_ARTICLES_SIZE = [245, 154];
  private const SLIDER_SIZE = [245, 154];

  function __construct()
  {
    $this->app = get_instance();
  }

  private function getJPGImage($fileName)
  {
    return $fileName;

    if (!$fileName) {
      return null;
    }

    $im = null;

    try {
      $im = @imagecreatefromjpeg($fileName);
    } catch (Exception $ex) {
      $im = false;
    }

    return $im;
  }

  public function getScaledLinkImage($fileName)
  {
    return $fileName;

    $source = $this->getJPGImage($fileName);
    if (!$source) {
      return null;
    }

    return $this->convertImage(
      $source,
      'base64',
      ImageTools::LINK_ARTICLES_SIZE
    );
  }

  public function getScaledSliderImage($fileName)
  {
    return $fileName;

    $source = $this->getJPGImage($fileName);
    if (!$source) {
      return null;
    }

    return $this->convertImage($source, 'base64', ImageTools::SLIDER_SIZE);
  }

  public function convertImage($source, $format = 'base64', $sizes = [640, 480])
  {
    if (!$source) {
      throw new Exception('Wrong image data');
    }

    $width = $sizes[0];
    $height = $sizes[1];

    $output = imagescale($source, $width, $height);

    switch ($format) {
      case 'base64':
        return $this->toBase64($output);
      default:
        return $output;
    }
  }

  public function toBase64($image)
  {
    ob_start();
    imagejpeg($image);
    $contents = ob_get_contents();
    ob_end_clean();
    return "data:image/jpeg;base64," . base64_encode($contents);
  }
}
