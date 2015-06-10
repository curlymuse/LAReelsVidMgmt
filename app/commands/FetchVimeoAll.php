<?php

use Illuminate\Console\Command;
use LRVM\Domain\Video\VideoRepository;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class FetchVimeoAll extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lrvm:vimeo-fetch';

    /**
     * Video Repository
     *
     * @var VideoRepository
     */
    protected $rVideo;

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Fetch videos remotely from Vimeo.';

    /**
     * Create a new command instance.
     *
     * @param VideoRepository $rVideo
     */
	public function __construct(VideoRepository $rVideo) {

		parent::__construct();

        $this->rVideo = $rVideo;

	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire() {

        $this->info('Starting...');

        //  Instantiate the library
        $lib = new \Vimeo\Vimeo($_ENV['VIMEO_ID'], $_ENV['VIMEO_SECRET']);

        //  Get token
        $token = $lib->clientCredentials(['public']);
        $lib->setToken($token['body']['access_token']);

        $url = '/users/lareels/videos';

        $maxPage = 30;
        for ($i = 1; $i <= $maxPage; $i++) {

            try {

                $this->info(sprintf('Retrieving page %d of %d...', $i, $maxPage));

                $options = [
                    'per_page'  => 20,
                    'page'      => $i,
                    'sort'      => 'date',
                    'direction' => 'asc'
                ];
                $response = $lib->request($url, $options, 'GET');

                foreach ($response['body']['data'] as $video) {

                    $vimeoId = str_replace('/videos/', '', $video['uri']);

                    //  Do not insert video if it already exists in database
                    if ($this->rVideo->vimeoIdExists($vimeoId))
                        continue;

                    $data = [
                        'vimeo_id' => $vimeoId,
                        'title' => $video['name'],
                        'thumbnail_url' => $video['pictures']['sizes'][3]['link']
                    ];
                    $this->rVideo->store($data);

                }

            } catch (Exception $e) {

                Log::error($e->getMessage());
                break;

            }

        }

        $this->info('Finishing.');

		//
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
