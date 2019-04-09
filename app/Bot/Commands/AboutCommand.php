<?php
/**
 * Created by PhpStorm.
 * User: Rohollah
 * Date: 03/31/2019
 * Time: 03:52 AM
 */

namespace app\Bot\Commands;

    use Telegram\Bot\Actions;
    use Telegram\Bot\Commands\Command;

class AboutCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "about";

    /**
     * @var string Command Description
     */
    protected $description = "Command that explains";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        // This will send a message using `sendMessage` method behind the scenes to
        // the user/chat id who triggered this command.
        // `replyWith<Message|Photo|Audio|Video|Voice|Document|Sticker|Location|ChatAction>()` all the available methods are dynamically
        // handled when you replace `send<Method>` with `replyWith` and use the same parameters - except chat_id does NOT need to be included in the array.
        $this->replyWithMessage(['text' => 'Hello! Welcome to our bot, Here are our available commands:']);

    }
}