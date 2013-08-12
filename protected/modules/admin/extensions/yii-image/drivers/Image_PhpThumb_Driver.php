<?php
/*
 * Для будущей реализации
 */
abstract class Image_PhpThumb_Driver extends Image_Driver
{
    /**
     * Return the current width and height of the temporary image. This is mainly
     * needed for sanitizing the geometry.
     *
     * @return  array  width, height
     */
    abstract protected function properties();

    /**
     * Process an image with a set of actions.
     *
     * @param   $image string   image filename
     * @param   $actions array    actions to execute
     * @param   $dir string   destination directory path
     * @param   $file string   destination filename
     * @return  boolean
     */
    abstract public function process($image, $actions, $dir, $file);

    /**
     * Flip an image. Valid directions are horizontal and vertical.
     *
     * @param   $direction int direction to flip
     * @return  boolean
     */
    abstract function flip($direction);

    /**
     * Crop an image. Valid properties are: width, height, top, left.
     *
     * @param   $properties array     new properties
     * @return  boolean
     */
    abstract function crop($properties);

    /**
     * Resize an image. Valid properties are: width, height, and master.
     *
     * @param   $properties array     new properties
     * @return  boolean
     */
    abstract public function resize($properties);

    /**
     * Rotate an image. Valid amounts are -180 to 180.
     *
     * @param   $amount integer   amount to rotate
     * @return  boolean
     */
    abstract public function rotate($amount);

    /**
     * Sharpen and image. Valid amounts are 1 to 100.
     *
     * @param   $amount integer  amount to sharpen
     * @return  boolean
     */
    abstract public function sharpen($amount);

    /**
     * Grayscale an image.
     *
     * @param $unused
     * @return boolean
     */
    abstract public function grayscale($unused);

    /**
     * Emboss an image.
     *
     * @author parcouss
     * @param $radius int only used with imagemagick
     * @return boolean
     */
    abstract public function emboss($radius);

    /**
     * Negate an image.
     *
     * @author parcouss
     * @param $unused
     * @return boolean
     */
    abstract public function negate($unused);

    abstract public function watermark($params);
} // End Image Driver