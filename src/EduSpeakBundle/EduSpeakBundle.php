<?php

namespace EduSpeakBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EduSpeakBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
