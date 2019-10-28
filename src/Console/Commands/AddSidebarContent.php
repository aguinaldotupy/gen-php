<?php

namespace Tupy\CRUD\app\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class AddSidebarContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator:add-sidebar-content
                                {code : HTML/PHP code that shows the sidebar item. Use either single quotes or double quotes. Never both. }';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add HTML/PHP code to sidebar_content file';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = config('generator.path');
        $disk_name = 'root';
        $disk = Storage::disk($disk_name);
        $code = $this->argument('code');
        if ($disk->exists($path)) {
            $contents = Storage::disk($disk_name)->get($path);

            if ($disk->put($path, $contents.PHP_EOL.$code)) {
                $this->info('Successfully added code to '.$path.' file.');
            } else {
                $this->error('Could not write to '.$path.' file.');
            }

        } else {
            $this->error("The '.$path.' file does not exist");
        }
    }
}
