<?php
/**
 * Created by PhpStorm.
 * User: Rohollah
 * Date: 02/05/2019
 * Time: 07:57 PM
 */

namespace App\Bot\Commands;



use Storage;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class AboutCommand extends Command
{
    protected $name = 'about';

    protected $description = 'What is this bot?';

    public function handle($argument)
    {
        $this->replyWithMessage(['text' => 'I am trying to help people and myself to improve fasting.
        
        there are a lot of articles about intermittent fasting
        some of the benefits are :
        
        
        1️⃣"fitness" 
        
        2️⃣increase life time 
        
        3️⃣ improve mass muscle 
        
        4️⃣improve brain focus and ...
        
        
        I might add couple of articles about fasting to help you know better about it.']);
        $this->replyWithChatAction(['action' => Actions::UPLOAD_PHOTO]);
        sleep(1);


        $this->replyWithPhoto([
            'photo' => 'https://perfectketo.com/wp-content/uploads/2017/12/BenefitsOfFastingOnKeto-3-440x900.png',
            'caption' => 'Benefits'
        ]);


        $this->replyWithChatAction(['action' => Actions::TYPING]);
        sleep(1);


        $this->replyWithMessage(['text' => 'How this bot helps?
        Setting notification📲 for :
        
        
        1️⃣⏰ Start and End Fasting 
        
        
        2️⃣🧭💪 Tell You Best Time to Exercise Based on Your Start and End
         
        
        3️⃣🎵💪 Send Exercise Videos and Musics in Time
         
        
        4️⃣📈 Give You Graphs to Compare Yourself And Improve
         
        
        This is a Free OpenSource Project Hopefully  Someday This Project Will Own its free App and Website To Help Normal People Have Better and Longer Life.
        
        
        
        Contact me here
        @contactMeHereBot
        ']);
    }
}