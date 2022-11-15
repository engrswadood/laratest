<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\EmailPost;
use Mail;

class EmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		//This is just the logic and the code is not tested at all.
	
		＄posts = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')// joining the contacts table , where user_id and contact_user_id are same
            ->select('posts.*', 'users.email')
            ->get();
		foreach($posts as $post) {
			//This is just the logic and the code is not tested at all.
			$data = ['emailId' => $post->email, 'title' => $post->title, 'body' => $post->body];    
			Mail::send(
				'mail.post',
				$data,
				function ($message) use ($data) {
					$message->from('xyz.com', 'abc');
					$message->to($data['emailId'])->subject('Your Subject');
				}
			});       
    }
}