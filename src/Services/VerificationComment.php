<?php

namespace App\Services;

use App\Entity\Comment;

class VerificationComment
{
    public function commentaireNonAutourise(Comment $comment){
            $nonAutorise= [
                "mauvais",
                "pourri"
            ];
            foreach ($nonAutorise as $word){
                if(strpos($comment->getContenu(), $word)){
                    return true;
                }
            }
            return false;
    }
    
}