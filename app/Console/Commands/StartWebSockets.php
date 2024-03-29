<?php namespace App\Console\Commands;

use App\Classes\Sockets;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Input\InputOption;

class StartWebSockets extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'sockets:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start web sockets.';

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
    public function fire()
    {
        $port = intval($this->option('port'));

        $this->info("Starting chat web socket server on port " . $port);

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Sockets()
                )
            ),
            $port,
            '0.0.0.0'
        );

        $server->run();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['port', 'p', InputOption::VALUE_OPTIONAL, 'Port where to launch the server.', 3030],
        ];
    }

}