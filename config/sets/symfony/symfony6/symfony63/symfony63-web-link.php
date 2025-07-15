<?php

declare(strict_types=1);

use Rector\Arguments\Rector\ClassMethod\ReplaceArgumentDefaultValueRector;
use Rector\Arguments\ValueObject\ReplaceArgumentDefaultValue;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(ReplaceArgumentDefaultValueRector::class, [
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'about',
            'Symfony\Component\WebLink\Link::REL_ABOUT'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'acl',
            'Symfony\Component\WebLink\Link::REL_ACL'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'amphtml',
            'Symfony\Component\WebLink\Link::REL_AMPHTML'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'appendix',
            'Symfony\Component\WebLink\Link::REL_APPENDIX'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'apple-touch-icon',
            'Symfony\Component\WebLink\Link::REL_APPLE_TOUCH_ICON'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'apple-touch-startup-image',
            'Symfony\Component\WebLink\Link::REL_APPLE_TOUCH_STARTUP_IMAGE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'archives',
            'Symfony\Component\WebLink\Link::REL_ARCHIVES'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'blocked-by',
            'Symfony\Component\WebLink\Link::REL_BLOCKED_BY'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'bookmark',
            'Symfony\Component\WebLink\Link::REL_BOOKMARK'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'canonical',
            'Symfony\Component\WebLink\Link::REL_CANONICAL'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'chapter',
            'Symfony\Component\WebLink\Link::REL_CHAPTER'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'cite-as',
            'Symfony\Component\WebLink\Link::REL_CITE_AS'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'collection',
            'Symfony\Component\WebLink\Link::REL_COLLECTION'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'contents',
            'Symfony\Component\WebLink\Link::REL_CONTENTS'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'convertedfrom',
            'Symfony\Component\WebLink\Link::REL_CONVERTEDFROM'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'copyright',
            'Symfony\Component\WebLink\Link::REL_COPYRIGHT'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'create-form',
            'Symfony\Component\WebLink\Link::REL_CREATE_FORM'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'current',
            'Symfony\Component\WebLink\Link::REL_CURRENT'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'describedby',
            'Symfony\Component\WebLink\Link::REL_DESCRIBEDBY'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'describes',
            'Symfony\Component\WebLink\Link::REL_DESCRIBES'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'disclosure',
            'Symfony\Component\WebLink\Link::REL_DISCLOSURE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'duplicate',
            'Symfony\Component\WebLink\Link::REL_DUPLICATE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'edit',
            'Symfony\Component\WebLink\Link::REL_EDIT'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'edit-form',
            'Symfony\Component\WebLink\Link::REL_EDIT_FORM'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'edit-media',
            'Symfony\Component\WebLink\Link::REL_EDIT_MEDIA'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'enclosure',
            'Symfony\Component\WebLink\Link::REL_ENCLOSURE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'external',
            'Symfony\Component\WebLink\Link::REL_EXTERNAL'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'first',
            'Symfony\Component\WebLink\Link::REL_FIRST'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'glossary',
            'Symfony\Component\WebLink\Link::REL_GLOSSARY'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'hosts',
            'Symfony\Component\WebLink\Link::REL_HOSTS'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'hub',
            'Symfony\Component\WebLink\Link::REL_HUB'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'index',
            'Symfony\Component\WebLink\Link::REL_INDEX'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervalafter',
            'Symfony\Component\WebLink\Link::REL_INTERVALAFTER'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervalbefore',
            'Symfony\Component\WebLink\Link::REL_INTERVALBEFORE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervalcontains',
            'Symfony\Component\WebLink\Link::REL_INTERVALCONTAINS'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervaldisjoint',
            'Symfony\Component\WebLink\Link::REL_INTERVALDISJOINT'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervalduring',
            'Symfony\Component\WebLink\Link::REL_INTERVALDURING'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervalequals',
            'Symfony\Component\WebLink\Link::REL_INTERVALEQUALS'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervalfinishedby',
            'Symfony\Component\WebLink\Link::REL_INTERVALFINISHEDBY'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervalfinishes',
            'Symfony\Component\WebLink\Link::REL_INTERVALFINISHES'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervalin',
            'Symfony\Component\WebLink\Link::REL_INTERVALIN'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervalmeets',
            'Symfony\Component\WebLink\Link::REL_INTERVALMEETS'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervalmetby',
            'Symfony\Component\WebLink\Link::REL_INTERVALMETBY'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervaloverlappedby',
            'Symfony\Component\WebLink\Link::REL_INTERVALOVERLAPPEDBY'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervaloverlaps',
            'Symfony\Component\WebLink\Link::REL_INTERVALOVERLAPS'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervalstartedby',
            'Symfony\Component\WebLink\Link::REL_INTERVALSTARTEDBY'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'intervalstarts',
            'Symfony\Component\WebLink\Link::REL_INTERVALSTARTS'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'item',
            'Symfony\Component\WebLink\Link::REL_ITEM'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'last',
            'Symfony\Component\WebLink\Link::REL_LAST'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'latest-version',
            'Symfony\Component\WebLink\Link::REL_LATEST_VERSION'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'linkset',
            'Symfony\Component\WebLink\Link::REL_LINKSET'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'lrdd',
            'Symfony\Component\WebLink\Link::REL_LRDD'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'manifest',
            'Symfony\Component\WebLink\Link::REL_MANIFEST'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'mask-icon',
            'Symfony\Component\WebLink\Link::REL_MASK_ICON'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'media-feed',
            'Symfony\Component\WebLink\Link::REL_MEDIA_FEED'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'memento',
            'Symfony\Component\WebLink\Link::REL_MEMENTO'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'micropub',
            'Symfony\Component\WebLink\Link::REL_MICROPUB'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'modulepreload',
            'Symfony\Component\WebLink\Link::REL_MODULEPRELOAD'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'monitor',
            'Symfony\Component\WebLink\Link::REL_MONITOR'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'monitor-group',
            'Symfony\Component\WebLink\Link::REL_MONITOR_GROUP'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'next-archive',
            'Symfony\Component\WebLink\Link::REL_NEXT_ARCHIVE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'nofollow',
            'Symfony\Component\WebLink\Link::REL_NOFOLLOW'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'noopener',
            'Symfony\Component\WebLink\Link::REL_NOOPENER'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'noreferrer',
            'Symfony\Component\WebLink\Link::REL_NOREFERRER'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'opener',
            'Symfony\Component\WebLink\Link::REL_OPENER'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'openid2.local_id',
            'Symfony\Component\WebLink\Link::REL_OPENID_2_LOCAL_ID'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'openid2.provider',
            'Symfony\Component\WebLink\Link::REL_OPENID_2_PROVIDER'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'original',
            'Symfony\Component\WebLink\Link::REL_ORIGINAL'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'p3pv1',
            'Symfony\Component\WebLink\Link::REL_P_3_PV_1'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'payment',
            'Symfony\Component\WebLink\Link::REL_PAYMENT'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'pingback',
            'Symfony\Component\WebLink\Link::REL_PINGBACK'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'predecessor-version',
            'Symfony\Component\WebLink\Link::REL_PREDECESSOR_VERSION'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'preview',
            'Symfony\Component\WebLink\Link::REL_PREVIEW'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'previous',
            'Symfony\Component\WebLink\Link::REL_PREVIOUS'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'prev-archive',
            'Symfony\Component\WebLink\Link::REL_PREV_ARCHIVE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'privacy-policy',
            'Symfony\Component\WebLink\Link::REL_PRIVACY_POLICY'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'profile',
            'Symfony\Component\WebLink\Link::REL_PROFILE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'publication',
            'Symfony\Component\WebLink\Link::REL_PUBLICATION'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'related',
            'Symfony\Component\WebLink\Link::REL_RELATED'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'restconf',
            'Symfony\Component\WebLink\Link::REL_RESTCONF'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'replies',
            'Symfony\Component\WebLink\Link::REL_REPLIES'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'ruleinput',
            'Symfony\Component\WebLink\Link::REL_RULEINPUT'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'section',
            'Symfony\Component\WebLink\Link::REL_SECTION'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'self',
            'Symfony\Component\WebLink\Link::REL_SELF'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'service',
            'Symfony\Component\WebLink\Link::REL_SERVICE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'service-desc',
            'Symfony\Component\WebLink\Link::REL_SERVICE_DESC'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'service-doc',
            'Symfony\Component\WebLink\Link::REL_SERVICE_DOC'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'service-meta',
            'Symfony\Component\WebLink\Link::REL_SERVICE_META'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'siptrunkingcapability',
            'Symfony\Component\WebLink\Link::REL_SIPTRUNKINGCAPABILITY'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'sponsored',
            'Symfony\Component\WebLink\Link::REL_SPONSORED'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'start',
            'Symfony\Component\WebLink\Link::REL_START'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'status',
            'Symfony\Component\WebLink\Link::REL_STATUS'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'subsection',
            'Symfony\Component\WebLink\Link::REL_SUBSECTION'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'successor-version',
            'Symfony\Component\WebLink\Link::REL_SUCCESSOR_VERSION'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'sunset',
            'Symfony\Component\WebLink\Link::REL_SUNSET'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'tag',
            'Symfony\Component\WebLink\Link::REL_TAG'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'terms-of-service',
            'Symfony\Component\WebLink\Link::REL_TERMS_OF_SERVICE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'timegate',
            'Symfony\Component\WebLink\Link::REL_TIMEGATE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'timemap',
            'Symfony\Component\WebLink\Link::REL_TIMEMAP'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'type',
            'Symfony\Component\WebLink\Link::REL_TYPE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'ugc',
            'Symfony\Component\WebLink\Link::REL_UGC'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'up',
            'Symfony\Component\WebLink\Link::REL_UP'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'version-history',
            'Symfony\Component\WebLink\Link::REL_VERSION_HISTORY'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'via',
            'Symfony\Component\WebLink\Link::REL_VIA'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'webmention',
            'Symfony\Component\WebLink\Link::REL_WEBMENTION'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'working-copy',
            'Symfony\Component\WebLink\Link::REL_WORKING_COPY'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'working-copy-of',
            'Symfony\Component\WebLink\Link::REL_WORKING_COPY_OF'
        ),
    ]);
};
