<?php

use Illuminate\Console\Command;
use LRVM\Domain\Video\VideoRepository;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class VimeoUpdate extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lrvm:vimeo-update';

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
	protected $description = 'Command description.';

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

        //  Instantiate the library
        $lib = new \Vimeo\Vimeo($_ENV['VIMEO_ID'], $_ENV['VIMEO_SECRET']);

        //  Get token
        $token = $lib->clientCredentials(['public']);
        $lib->setToken($token['body']['access_token']);

        $url = '/users/lareels/videos';

        $maxPage = 30;
        for ($i = 1; $i <= $maxPage; $i++) {

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

                    //  If this video is not already in the database, skip it
                    if (!$this->rVideo->vimeoIdExists($vimeoId))
                        continue;

                    $oVideo = $this->rVideo->findByVimeoId($vimeoId);

                    //  We're going to check the updatable fields one-by-one
                    $update = [];

                    //  Check title
                    if ($oVideo->title != $video['name'])
                        $update['title'] = $video['name'];

                    //  Check thumbnail
                    $thumbnail = $video['pictures']['sizes'][0]['link'];
                    if ($oVideo->thumbnail_url != $thumbnail)
                        $update['thumbnail_url'] = $thumbnail;

                    //  Check main photo
                    $main = $video['pictures']['sizes'][count($video['pictures']['sizes']) - 1]['link'];
                    if ($oVideo->main_image_url != $main)
                        $update['main_image_url'] = $main;

                    //  Check upload date
                    $date = date('Y-m-d H:i:s', strtotime($video['created_time']));
                    if ($oVideo->uploaded_at != $date)
                        $update['uploaded_at'] = $date;

                    if (count($update) > 0)
                        $this->rVideo->update($oVideo->id, $update);

                }

        }

        $this->info('Finishing.');



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
