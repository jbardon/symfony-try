<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Author
{
    /**
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @Assert\IsTrue(message = "The password cannot match your first name")
     */
    public function isPasswordLegal()
    {
        return $this->firstName !== $this->password;
    }
}
