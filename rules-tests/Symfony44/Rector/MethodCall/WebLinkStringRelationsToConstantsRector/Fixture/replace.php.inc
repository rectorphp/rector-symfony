<?php

namespace Rector\Symfony\Tests\Symfony63\Rector\MethodCall\WebLinkStringRelationsToConstantsRector\Fixture;

use Symfony\Component\WebLink\Link;

class SomeClass
{
    public function run(string $dynamicRelation)
    {
        // 1. Constructor replacement (4.4 constants)
        $link1 = new Link('preload', 'https://example.com');

        // 2. Constructor replacement (6.3 constants)
        $link2 = new Link('about', 'https://example.com');

        // 3. Method calls
        $link3 = (new Link('alternate', 'https://example.com'))->withRel('next');
        $link4 = $link3->withoutRel('dns-prefetch');

        // 4. Weird mappings that don't follow the standard uppercase pattern
        $link5 = (new Link('p3pv1', 'https://example.com'))->withRel('openid2.local_id');

        // --- SKIPPED CASES (These should NOT be replaced) ---

        // Skip: Unknown/invalid relations that don't exist as constants in Link class
        $link6 = clone $link5;
        $link6 = $link6->withRel('made-up-relation-string');
        $link7 = clone $link6;
        $link7 = clone $link7->withoutRel('another-fake-one');
        $link8 = clone $link7;
        $link8 = new Link('fake-constructor-rel', 'https://example.com');

        // Skip: Non-string arguments (variables, function calls)
        $link9  = new Link($dynamicRelation, 'https://example.com');
        $link10 = clone $link9;
        $link10 = clone $link10->withRel($dynamicRelation);

        // Skip: Method calls on different classes
        $otherClass = new \stdClass();
        $otherClass->withRel('preload');
    }
}

-----
<?php

namespace Rector\Symfony\Tests\Symfony63\Rector\MethodCall\WebLinkStringRelationsToConstantsRector\Fixture;

use Symfony\Component\WebLink\Link;

class SomeClass
{
    public function run(string $dynamicRelation)
    {
        // 1. Constructor replacement (4.4 constants)
        $link1 = new Link(\Symfony\Component\WebLink\Link::REL_PRELOAD, 'https://example.com');

        // 2. Constructor replacement (6.3 constants)
        $link2 = new Link(\Symfony\Component\WebLink\Link::REL_ABOUT, 'https://example.com');

        // 3. Method calls
        $link3 = (new Link(\Symfony\Component\WebLink\Link::REL_ALTERNATE, 'https://example.com'))->withRel(\Symfony\Component\WebLink\Link::REL_NEXT);
        $link4 = $link3->withoutRel(\Symfony\Component\WebLink\Link::REL_DNS_PREFETCH);

        // 4. Weird mappings that don't follow the standard uppercase pattern
        $link5 = (new Link(\Symfony\Component\WebLink\Link::REL_P_3_PV_1, 'https://example.com'))->withRel(\Symfony\Component\WebLink\Link::REL_OPENID_2_LOCAL_ID);

        // --- SKIPPED CASES (These should NOT be replaced) ---

        // Skip: Unknown/invalid relations that don't exist as constants in Link class
        $link6 = clone $link5;
        $link6 = $link6->withRel('made-up-relation-string');
        $link7 = clone $link6;
        $link7 = clone $link7->withoutRel('another-fake-one');
        $link8 = clone $link7;
        $link8 = new Link('fake-constructor-rel', 'https://example.com');

        // Skip: Non-string arguments (variables, function calls)
        $link9  = new Link($dynamicRelation, 'https://example.com');
        $link10 = clone $link9;
        $link10 = clone $link10->withRel($dynamicRelation);

        // Skip: Method calls on different classes
        $otherClass = new \stdClass();
        $otherClass->withRel('preload');
    }
}
