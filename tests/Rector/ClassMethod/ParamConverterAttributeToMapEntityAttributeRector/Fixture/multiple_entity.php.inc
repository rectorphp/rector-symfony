<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\Routing\Annotation\Route;

class MultipleEntity {
    #[Route('/blog/{date}/{slug}/comments/{comment_slug}')]
    #[Entity('post', expr: "repository.findOneBy({'date': date, 'slug': slug})")]
    #[Entity('comment', expr: "repository.findOneBy({'comment_slug': slug})")]
    public function showComment(Post $post, Comment $comment)
    {
    }
}
?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\Routing\Annotation\Route;

class MultipleEntity {
    #[Route('/blog/{date}/{slug}/comments/{comment_slug}')]
    public function showComment(#[\Symfony\Bridge\Doctrine\Attribute\MapEntity(expr: "repository.findOneBy({'date': date, 'slug': slug})")]
    Post $post, #[\Symfony\Bridge\Doctrine\Attribute\MapEntity(expr: "repository.findOneBy({'comment_slug': slug})")]
    Comment $comment)
    {
    }
}
?>
