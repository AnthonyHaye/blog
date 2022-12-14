<?php

namespace App\Tests;

use App\Entity\Comment;
use App\Services\VerificationComment;
use PHPUnit\Framework\TestCase;

class VerificationCommentTest extends TestCase
{

    protected $comment;

    protected function setUp(): void
    {
        $this->comment = new Comment();
    }


    public function testContientMotInterdit(){

       $service = new VerificationComment();

       $this->comment->setContenu("Ceci est un commentaire mauvais ");


       $result = $service ->commentaireNonAutourise($this->comment);


       $this->assertTrue($result);
   }

    public function testNeContientPasMotInterdit()
    {

        $service = new VerificationComment();

        $this->comment->setContenu("Ceci est un commentaire  ");


        $result = $service->commentaireNonAutourise($this->comment);


        $this->assertFalse($result);
    }






}
