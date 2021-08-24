<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\SwiftSetBodyToHtmlPlainMethodCallRector\Fixture;

use Swift_Message;

$message = new Swift_Message();
$message->setBody('...', 'text/html');
$message->setBody('...');

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\SwiftSetBodyToHtmlPlainMethodCallRector\Fixture;

use Swift_Message;

$message = new Swift_Message();
$message->html('...');
$message->plain('...');

?>
