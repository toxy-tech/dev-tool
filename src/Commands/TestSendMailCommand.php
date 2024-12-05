<?php

namespace ToxyTech\DevTool\Commands;

use ToxyTech\Base\Facades\EmailHandler;
use ToxyTech\DevTool\Helper;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('cms:mail:test', 'Test send mail')]
class TestSendMailCommand extends Command
{
    public function handle(): int
    {
        $content = file_get_contents(
            core_path(Helper::joinPaths(['setting', 'resources', 'email-templates', 'test.tpl']))
        );

        EmailHandler::send($content, 'Test mail!', null, [], true);

        $this->components->info('Done!');

        return self::SUCCESS;
    }
}
