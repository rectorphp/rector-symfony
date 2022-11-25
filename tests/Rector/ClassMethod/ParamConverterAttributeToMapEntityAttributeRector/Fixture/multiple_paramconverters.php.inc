<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;

class MultiParamConverter {

    #[Route('/blog/{date}/{slug}/comments/{comment_slug}')]
    #[ParamConverter('post', options: ['mapping' => ['date' => 'date', 'slug' => 'slug']])]
    #[ParamConverter('comment', options: ['mapping' => ['comment_slug' => 'slug']])]
    public function showComment(Post $post, Comment $comment)
    {
    }
}
?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\Fixture;

use Symfony\Component\Routing\Annotation\Route;

class MultiParamConverter {

    #[Route('/blog/{date}/{slug}/comments/{comment_slug}')]
    public function showComment(#[\Symfony\Bridge\Doctrine\Attribute\MapEntity(mapping: ['date' => 'date', 'slug' => 'slug'])] Post $post, #[\Symfony\Bridge\Doctrine\Attribute\MapEntity(mapping: ['comment_slug' => 'slug'])] Comment $comment)
    {
    }
}
?>
