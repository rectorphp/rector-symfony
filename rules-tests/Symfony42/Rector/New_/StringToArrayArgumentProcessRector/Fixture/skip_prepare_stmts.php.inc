<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\New_\StringToArrayArgumentProcessRector\Fixture;

final class SkipPrepareStmts
{
    public function run()
    {
        $stmt = $this->connection->getNativeConnection()->prepare("SELECT photo FROM card_exchange WHERE application_id = ?");
    }
}
