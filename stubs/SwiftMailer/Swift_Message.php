<?php

if (class_exists('Swift_Message')) {
    return;
}

class Swift_Message
{
    /**
     * @return $this
     */
    public function setSubject($subject)
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function setPriority($priority)
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function addBcc($address, $name = null)
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function addCc($address, $name = null)
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function addFrom($address, $name = null)
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function addReplyTo($address, $name = null)
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function addTo($address, $name = null)
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function setBcc($addresses, $name = null)
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function setCc($addresses, $name = null)
    {
        return $this;
    }


    /**
     * @return $this
     */
    public function setFrom($addresses, $name = null)
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function setReplyTo($addresses, $name = null)
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function setTo($addresses, $name = null)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
    }

    /**
     * @return $this
     */
    public function setBody($body, $contentType = null, $charset = null)
    {
        return $this;
    }
}
