<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TestPodcastFeed extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lrvm:test-podcast-feed';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Validate the podcast feed as XML and email LA Reels if it fails.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {

		parent::__construct();

	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire() {

        $request = Request::create('/podcasts/feed', 'GET');
        $response = Route::dispatch($request);


        libxml_use_internal_errors(true);

        $version = '1.0';
        $encoding = 'utf-8';
        $doc = new DOMDocument($version, $encoding);
        $doc->loadXML($response->getContent());

        $errors = libxml_get_errors();
        libxml_clear_errors();

        if (empty($errors))
            $this->info('The feed is valid.');
        else {
            $this->error('The feed is invalid. Call Robin.');
            $data = ['errorMsg' => print_r($errors, true)];
            Mail::send('emails.feed-error', $data, function($m) {
                $m->from('webmaster@lareels.com');
                $m->to('robin.arenson@gmail.com');
                $m->subject('Podcast feed error.');
            });
        }

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
