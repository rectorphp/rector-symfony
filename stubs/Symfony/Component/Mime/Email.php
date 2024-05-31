<?php

declare(strict_types=1);

namespace Symfony\Component\Mime;

if (class_exists('Symfony\Component\Mime\Email')) {
    return;
}

class Email extends Message
{
    /**
     * @return $this
     */
    public function to(...$addresses)
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function cc(...$addresses)
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function addCC(...$addresses)
    {
        return $this;
    }

}
