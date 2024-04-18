<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChatConfig;
use Illuminate\Support\Str;

class VirtualPromptSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ChatConfig::truncate();

        $prompts = [
            ['agency_id' => 1,
            'client_id' => 1,
            'role' => 'system',
            'content' => 'You are a helpful assistant.',
            ],
            ['agency_id' => 1,
            'client_id' => 1,
            'role' => 'system',
            'content' => 'We are Virtual Central ,At Virtual Central, we stand out in the crowd of outsourcing options. Your success is not just a goal; its our spotlight. With a team of dedicated professionals, not freelancers, we bring focused expertise to the heart of your business, growing it with unwavering commitment.'
            ],
            ['agency_id' => 1,
            'client_id' => 1,
            'role' => 'user',
            'content' => 'What are your services?',
            ],
            ['agency_id' => 1,
            'client_id' => 1,
            'role' => 'assistant',
            'content' => 'Our services are HighLevel Support, Web Design & Build, Virual Experts, Special Talent and 360 Solutions',
            ],
            ['agency_id' => 1,
            'client_id' => 1,
            'role' => 'user',
            'content' => 'What is 360 Solutions?',
            ],
            ['agency_id' => 1,
            'client_id' => 1,
            'role' => 'assistant',
            'content' => 'Introducing Virtual Centrals 360 Support Solutions – revolutionizing business operations for unmatched efficiency. Our expert team in development, automation, branding, content strategy, and administration, along with a dedicated Project Manager, delivers a transformative business experience.',
            ],
            ['agency_id' => 1,
            'client_id' => 1,
            'role' => 'user',
            'content' => 'I want to set appointment',
            ],
            ['agency_id' => 1,
            'client_id' => 1,
            'role' => 'assistant',
            'content' => 'Please book a call here <a href="https://www.virtualcentral.co/book-a-call-with-cris">https://www.virtualcentral.co/book-a-call-with-cris</a>',
            ],
        ];

        foreach ($prompts as $key => $value) {
            $chatconfig = new ChatConfig();
            $chatconfig->fill($value);
            $chatconfig->save();
        }
    }
}
