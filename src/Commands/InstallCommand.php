<?php

namespace Arkcode\Addchat\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\ImageServiceProviderLaravel5;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Arkcode\Addchat\AddchatServiceProvider;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'addchat:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Chat Laravel package';

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production', null],
        ];
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" '.getcwd().'/composer.phar';
        }

        return 'composer';
    }

    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }

    /**
     * Execute the console command.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     *
     * @return void
     */
    public function handle(Filesystem $filesystem)
    {
        $this->info('Initiate the installation process...');

        // verify installation
        // get domain name
        if($this->confirm('Do you wish to continue?'))
        {
            $this->info('Process, installing...');
            $this->install($filesystem);
        }
        else
        {
            $this->info('Installation abort.');
        }
    }

    
    private function install(Filesystem $filesystem)
    {
        $this->info('Initiate the installation process...');

        // 1. Publish the core assets defined in the AddchatServiceProvider
        $this->info('1. Publishing Addchat core assets: config & languages');
        $this->call('vendor:publish', ['--provider' => AddchatServiceProvider::class]);

        // 2. Run Addchat migrations
        $this->info('2. Migrating the Addchat database tables into your application');
        $this->call('migrate', ['--force' => $this->option('force')]);
        
        // ---- Check if everything good so far ----
        $this->info('---- Dumping the autoloaded files and reloading all new files ----');
        $composer = $this->findComposer();
        $process = new Process([$composer.' dump-autoload']);
        // Setting timeout to null to prevent installation from stopping at a certain point in time
        $process->setTimeout(null); 
        $process->setWorkingDirectory(base_path())->run();

        // 3. Add Addchat Route
        $this->info('3. Adding Addchat routes to your application routes/web.php');
        $routes_contents = $filesystem->get(base_path('routes/web.php'));
        if (false === strpos($routes_contents, 'Addchat::routes()')) {
            $filesystem->append(
                base_path('routes/web.php'),
                "\n\nAddchat::routes();\n"
            );
        }

        // 4. Add storage symlink
        $this->info('4. Adding the storage symlink to your public folder');
        $this->call('storage:link');
        
        // Finish
        $this->info('Congrats! Chat Laravel installed successfully. Good Luck :)');
    }    
}
