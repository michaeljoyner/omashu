<?php

namespace spec\Omashu\Services;

use Intervention\Image\ImageManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileStorerSpec extends ObjectBehavior
{
    public function let(ImageManager $imageManager)
    {
        $this->beConstructedWith($imageManager);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('Omashu\Services\FileStorer');
    }

    public function it_stores_file()
    {

    }
}
