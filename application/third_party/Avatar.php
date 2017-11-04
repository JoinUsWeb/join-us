<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017-11-03
 * Time: 22:14
 */


class Avatar{
    public function __construct($seed = null)
    {
        // 实例化
        $identicon = new Identicon();

        // 返回 base64图片字符串
        // $identicon->getImageDataUri('霍霍', 128);

        // 返回图片
//        $identicon->displayImage('anderson', 128);

        // 返回图片数据
        file_put_contents(FCPATH . '/img/avatar/' . md5($seed) . '.png', $identicon->getImage($seed, 128,null,'FFFFFF'));
    }
}

/**
 * @author Benjamin Laugueux <benjamin@yzalis.com>
 */
class Identicon
{
    /**
     * @var \GeneratorInterface
     */
    private $generator;

    /**
     * Identicon constructor.
     *
     * @param \GeneratorInterface|null $generator
     */
    public function __construct($generator = null)
    {
        if (null === $generator) {
            $this->generator = new GdGenerator();
        } else {
            $this->generator = $generator;
        }
    }

    /**
     * Set the image generator.
     *
     * @param \GeneratorInterface $generator
     *
     * @return $this
     */
    public function setGenerator(GeneratorInterface $generator)
    {
        $this->generator = $generator;

        return $this;
    }

    /**
     * Display an Identicon image.
     *
     * @param string $string
     * @param int $size
     * @param string $color
     * @param string $backgroundColor
     */
    public function displayImage($string, $size = 64, $color = null, $backgroundColor = null)
    {
        header('Content-Type: ' . $this->generator->getMimeType());
        echo $this->getImageData($string, $size, $color, $backgroundColor);
    }


    public function getImage($string, $size = 64, $color = null, $backgroundColor = null)
    {
        header('Content-Type: ' . $this->generator->getMimeType());
        $a = $this->getImageData($string, $size, $color, $backgroundColor);
        return $a;
    }

    /**
     * Get an Identicon PNG image data.
     *
     * @param string $string
     * @param int $size
     * @param string $color
     * @param string $backgroundColor
     *
     * @return string
     */
    public function getImageData($string, $size = 64, $color = null, $backgroundColor = null)
    {
        return $this->generator->getImageBinaryData($string, $size, $color, $backgroundColor);
    }

    /**
     * Get an Identicon PNG image resource.
     *
     * @param string $string
     * @param int $size
     * @param string $color
     * @param string $backgroundColor
     *
     * @return string
     */
    public function getImageResource($string, $size = 64, $color = null, $backgroundColor = null)
    {
        return $this->generator->getImageResource($string, $size, $color, $backgroundColor);
    }

    /**
     * Get an Identicon PNG image data as base 64 encoded.
     *
     * @param string $string
     * @param int $size
     * @param string $color
     * @param string $backgroundColor
     *
     * @return string
     */
    public function getImageDataUri($string, $size = 64, $color = null, $backgroundColor = null)
    {
        return sprintf('data:%s;base64,%s', $this->generator->getMimeType(), base64_encode($this->getImageData($string, $size, $color, $backgroundColor)));
    }

    /**
     * Get the color of the Identicon
     *
     * Returns an array with RGB values of the Identicon's color. Colors may be NULL if no image has been generated
     * so far (e.g., when calling the method on a new Identicon()).
     *
     * @return array
     */
    public function getColor()
    {
        $colors = $this->generator->getColor();

        return [
            "r" => $colors[0],
            "g" => $colors[1],
            "b" => $colors[2]
        ];
    }
}

class BaseGenerator
{
    /**
     * @var mixed
     */
    protected $generatedImage;

    /**
     * @var array
     */
    protected $color;

    /**
     * @var array
     */
    protected $backgroundColor;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var int
     */
    protected $pixelRatio;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var array
     */
    private $arrayOfSquare = [];

    /**
     * Set the image color.
     *
     * @param string|array $color The color in hexa (3 or 6 chars) or rgb array
     *
     * @return $this
     */
    public function setColor($color)
    {
        if (null === $color) {
            return $this;
        }

        $this->color = $this->convertColor($color);

        return $this;
    }

    /**
     * Set the image background color.
     *
     * @param string|array $backgroundColor The color in hexa (3 or 6 chars) or rgb array
     *
     * @return $this
     */
    public function setBackgroundColor($backgroundColor)
    {
        if (null === $backgroundColor) {
            return $this;
        }

        $this->backgroundColor = $this->convertColor($backgroundColor);

        return $this;
    }

    /**
     * @param array|string $color
     *
     * @return array
     */
    private function convertColor($color)
    {
        if (is_array($color)) {
            return $color;
        }

        if (preg_match('/^#?([a-z\d])([a-z\d])([a-z\d])$/i', $color, $matches)) {
            $color = $matches[1].$matches[1];
            $color .= $matches[2].$matches[2];
            $color .= $matches[3].$matches[3];
        }

        preg_match('/#?([a-z\d]{2})([a-z\d]{2})([a-z\d]{2})$/i', $color, $matches);

        return array_map(function ($value) {
            return hexdec($value);
        }, array_slice($matches, 1, 3));
    }

    /**
     * Get the color.
     *
     * @return array
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Get the background color.
     *
     * @return array
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Convert the hash into an multidimensional array of boolean.
     *
     * @return $this
     */
    private function convertHashToArrayOfBoolean()
    {
        preg_match_all('/(\w)(\w)/', $this->hash, $chars);

        foreach ($chars[1] as $i => $char) {
            $index = (int) ($i / 3);
            $data = $this->convertHexaToBoolean($char);

            $items = [
                0 => [0, 4],
                1 => [1, 3],
                2 => [2],
            ];

            foreach ($items[$i % 3] as $item) {
                $this->arrayOfSquare[$index][$item] = $data;
            }

            ksort($this->arrayOfSquare[$index]);
        }

        $this->color = array_map(function ($data) {
            return hexdec($data) * 16;
        }, array_reverse($chars[1]));

        return $this;
    }

    /**
     * Convert an hexadecimal number into a boolean.
     *
     * @param string $hexa
     *
     * @return bool
     */
    private function convertHexaToBoolean($hexa)
    {
        return (bool) round(hexdec($hexa) / 10);
    }

    /**
     * @return array
     */
    public function getArrayOfSquare()
    {
        return $this->arrayOfSquare;
    }

    /**
     * Get the identicon string hash.
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Generate a hash from the original string.
     *
     * @param string $string
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function setString($string)
    {
        if (null === $string) {
            throw new Exception('The string cannot be null.');
        }

        $this->hash = md5($string);

        $this->convertHashToArrayOfBoolean();

        return $this;
    }

    /**
     * Set the image size.
     *
     * @param int $size
     *
     * @return $this
     */
    public function setSize($size)
    {
        if (null === $size) {
            return $this;
        }

        $this->size = $size;
        $this->pixelRatio = (int) round($size / 5);

        return $this;
    }

    /**
     * Get the image size.
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get the pixel ratio.
     *
     * @return int
     */
    public function getPixelRatio()
    {
        return $this->pixelRatio;
    }
}


class GdGenerator extends BaseGenerator implements GeneratorInterface
{
    /**
     * GdGenerator constructor.
     */
    public function __construct()
    {
        if (!extension_loaded('gd') && !extension_loaded('ext-gd')) {
            throw new Exception('GD does not appear to be available in your PHP installation. Please try another generator');
        }
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return 'image/png';
    }

    /**
     * @return $this
     */
    private function generateImage()
    {
        // prepare image
        $this->generatedImage = imagecreatetruecolor($this->getPixelRatio() * 5, $this->getPixelRatio() * 5);

        $rgbBackgroundColor = $this->getBackgroundColor();
        if (null === $rgbBackgroundColor) {
            $background = imagecolorallocate($this->generatedImage, 0, 0, 0);
            imagecolortransparent($this->generatedImage, $background);
        } else {
            $background = imagecolorallocate($this->generatedImage, $rgbBackgroundColor[0], $rgbBackgroundColor[1], $rgbBackgroundColor[2]);
            imagefill($this->generatedImage, 0, 0, $background);
        }

        // prepare color
        $rgbColor = $this->getColor();
        $gdColor = imagecolorallocate($this->generatedImage, $rgbColor[0], $rgbColor[1], $rgbColor[2]);

        // draw content
        foreach ($this->getArrayOfSquare() as $lineKey => $lineValue) {
            foreach ($lineValue as $colKey => $colValue) {
                if (true === $colValue) {
                    imagefilledrectangle($this->generatedImage, $colKey * $this->getPixelRatio(), $lineKey * $this->getPixelRatio(), ($colKey + 1) * $this->getPixelRatio(), ($lineKey + 1) * $this->getPixelRatio(), $gdColor);
                }
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getImageBinaryData($string, $size = null, $color = null, $backgroundColor = null)
    {
        ob_start();
        imagepng($this->getImageResource($string, $size, $color, $backgroundColor));
        $imageData = ob_get_contents();
        ob_end_clean();

        return $imageData;
    }

    /**
     * {@inheritdoc}
     */
    public function getImageResource($string, $size = null, $color = null, $backgroundColor = null)
    {
        $this
            ->setString($string)
            ->setSize($size)
            ->setColor($color)
            ->setBackgroundColor($backgroundColor)
            ->generateImage();

        return $this->generatedImage;
    }
}


interface GeneratorInterface
{
    /**
     * @param string       $string
     * @param int          $size
     * @param array|string $color
     * @param array|string $backgroundColor
     *
     * @return mixed
     */
    public function getImageBinaryData($string, $size = null, $color = null, $backgroundColor = null);

    /**
     * @param string       $string
     * @param int          $size
     * @param array|string $color
     * @param array|string $backgroundColor
     *
     * @return string
     */
    public function getImageResource($string, $size = null, $color = null, $backgroundColor = null);

    /**
     * Return the mime-type of this identicon.
     *
     * @return string
     */
    public function getMimeType();

    /**
     * Return the color of the created identicon.
     *
     * @return array
     */
    public function getColor();
}


class ImageMagickGenerator extends BaseGenerator implements GeneratorInterface
{
    /**
     * ImageMagickGenerator constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        if (!extension_loaded('imagick')) {
            throw new Exception('ImageMagick does not appear to be avaliable in your PHP installation. Please try another generator');
        }
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return 'image/png';
    }

    /**
     * @return $this
     */
    private function generateImage()
    {
        $this->generatedImage = new \Imagick();
        $rgbBackgroundColor = $this->getBackgroundColor();

        if (null === $rgbBackgroundColor) {
            $background = 'none';
        } else {
            $background = new ImagickPixel("rgb($rgbBackgroundColor[0],$rgbBackgroundColor[1],$rgbBackgroundColor[2])");
        }

        $this->generatedImage->newImage($this->pixelRatio * 5, $this->pixelRatio * 5, $background, 'png');

        // prepare color
        $rgbColor = $this->getColor();
        $color = new ImagickPixel("rgb($rgbColor[0],$rgbColor[1],$rgbColor[2])");

        $draw = new ImagickDraw();
        $draw->setFillColor($color);

        // draw the content
        foreach ($this->getArrayOfSquare() as $lineKey => $lineValue) {
            foreach ($lineValue as $colKey => $colValue) {
                if (true === $colValue) {
                    $draw->rectangle($colKey * $this->pixelRatio, $lineKey * $this->pixelRatio, ($colKey + 1) * $this->pixelRatio, ($lineKey + 1) * $this->pixelRatio);
                }
            }
        }

        $this->generatedImage->drawImage($draw);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getImageBinaryData($string, $size = null, $color = null, $backgroundColor = null)
    {
        ob_start();
        echo $this->getImageResource($string, $size, $color, $backgroundColor);
        $imageData = ob_get_contents();
        ob_end_clean();

        return $imageData;
    }

    /**
     * {@inheritdoc}
     */
    public function getImageResource($string, $size = null, $color = null, $backgroundColor = null)
    {
        $this
            ->setString($string)
            ->setSize($size)
            ->setColor($color)
            ->setBackgroundColor($backgroundColor)
            ->generateImage();

        return $this->generatedImage;
    }
}


class SvgGenerator extends BaseGenerator implements GeneratorInterface
{
    /**
     * {@inheritdoc}
     */
    public function getMimeType()
    {
        return 'image/svg+xml';
    }

    /**
     * {@inheritdoc}
     */
    public function getImageBinaryData($string, $size = null, $color = null, $backgroundColor = null)
    {
        return $this->getImageResource($string, $size, $color, $backgroundColor);
    }

    /**
     * {@inheritdoc}
     */
    public function getImageResource($string, $size = null, $color = null, $backgroundColor = null)
    {
        $this
            ->setString($string)
            ->setSize($size)
            ->setColor($color)
            ->setBackgroundColor($backgroundColor)
            ->_generateImage();

        return $this->generatedImage;
    }

    /**
     * @return $this
     */
    protected function _generateImage()
    {
        // prepare image
        $w = $this->getPixelRatio() * 5;
        $h = $this->getPixelRatio() * 5;
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="'.$w.'" height="'.$h.'">';

        $backgroundColor = '#FFFFFF';
        $rgbBackgroundColor = $this->getBackgroundColor();
        if (!is_null($rgbBackgroundColor)) {
            $backgroundColor = $this->_toUnderstandableColor($rgbBackgroundColor);
        }
        $svg .= '<rect width="'.$w.'" height="'.$h.'" style="fill:'.$backgroundColor.';stroke-width:1;stroke:'.$backgroundColor.'"/>';

        $rgbColor = $this->_toUnderstandableColor($this->getColor());
        // draw content
        foreach ($this->getArrayOfSquare() as $lineKey => $lineValue) {
            foreach ($lineValue as $colKey => $colValue) {
                if (true === $colValue) {
                    $svg .= '<rect x="'.$colKey * $this->getPixelRatio().'" y="'.$lineKey * $this->getPixelRatio().'" width="'.($this->getPixelRatio()).'" height="'.$this->getPixelRatio().'" style="fill:'.$rgbColor.';stroke-width:0;"/>';
                }
            }
        }

        $svg .= '</svg>';

        $this->generatedImage = $svg;

        return $this;
    }

    /**
     * @param array|string $color
     *
     * @return string
     */
    protected function _toUnderstandableColor($color)
    {
        if (is_array($color)) {
            return 'rgb('.implode(', ', $color).')';
        }

        return $color;
    }
}


