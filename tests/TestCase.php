<?php

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testNewsPostCanBeCreated() {
        
        $user = factory(App\Models\User::class)->create();
        
        $newsContent = [
            'title' => "First news post",
            'image' => "user_upload/news_image.jpg",
            'text'  => "detailed about the news"
        ];

        $user->news()->create($newsContent);

        $news = App\Models\News::where('user_id', $user->id);

        $this->assertEquals($news->count(), 1);
        $this->assertEquals($news->first()->title, $newsContent['title']);

        $this->seeInDatabase('news', array_merge($newsContent, ['user_id' => $user->id]));

        $user->delete();
    }

    public function testNewsPostCanBeDeleted()
    {
        $user = factory(App\Models\User::class)->create();
        
        $newsContent = [
            'title' => "First news post",
            'image' => "user_upload/news_image.jpg",
            'text'  => "detailed about the news"
        ];

        $news = $user->news()->create($newsContent);

        $news->delete();

        $this->notSeeInDatabase('news', array_merge($newsContent, ['user_id' => $user->id]));


        $user->delete();

    }

}
