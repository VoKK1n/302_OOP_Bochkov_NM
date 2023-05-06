<?php

namespace App\Tests;

use App\Truncater;
use PHPUnit\Framework\TestCase;

class TruncaterTest extends TestCase
{
    public function testTruncate()
    {
        $defaultTruncater = new Truncater();
        $this->assertSame("Бочков Никита Михайлович", $defaultTruncater->truncate("Бочков Никита Михайлович"));
        $this->assertSame("Бочков Ник...", $defaultTruncater->truncate(
            "Бочков Никита Михайлович",
            ['length' => 10]
        ));
        $this->assertSame("Бочков Никита ...", $defaultTruncater->truncate(
            "Бочков Никита Михайлович",
            ['length' => -10]
        ));
        $this->assertSame("Бочков Ник*", $defaultTruncater->truncate(
            "Бочков Никита Михайлович",
            ['length' => 10, 'separator' => '*']
        ));
        $this->assertSame("Бочков Никита Михайлович", $defaultTruncater->truncate("Бочков Никита Михайлович"));

        $overriddenTruncater1 = new Truncater(['length' => 14]);
        $this->assertSame("Бочков Никита ...", $overriddenTruncater1->truncate("Бочков Никита Михайлович"));
        $this->assertSame("Бочков Никита \\", $overriddenTruncater1->truncate(
            "Бочков Никита Михайлович",
            ['separator' => '\\']
        ));

        $overriddenTruncater2 = new Truncater(['length' => 14, 'separator' => '***']);
        $this->assertSame("Бочков Никита ***", $overriddenTruncater2->truncate("Бочков Никита Михайлович"));
    }
}
