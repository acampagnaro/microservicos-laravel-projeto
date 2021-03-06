<?php

namespace Tests\Unit\Models;

use App\Model\Traits\UploadFiles;
use App\Model\Video;
use App\Model\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoTest extends TestCase
{
    use DatabaseMigrations;

    private $video;

    public static function setUpBeforeClass(): void
    {
        // parent::setUpBeforeClass(); // TODO: Change the autogenerated stub
    }

    public function setUp(): void
    {
        $this->video = new Video();
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    public static function tearDownAfterClass() :void
    {
        parent::tearDownAfterClass(); // TODO: Change the autogenerated stub
    }

    public function testIfUseTraits()
    {
        $traits = [
            SoftDeletes::class,
            Uuid::class,
            UploadFiles::class

        ];
        $VideoTraits = array_keys(class_uses(Video::class));
        $this->assertEquals($traits, $VideoTraits);
    }

    public function testFillableAttribute()
    {
        $fillable = [  'title',
            'description',
            'year_launched',
            'opened',
            'rating',
            'duration',
            'video_file',
            'thumb_file',
            'banner_file',
            'trailer_file'
        ];
        $this->assertEquals($fillable, $this->video->getFillable());
    }



    public function testCasts()
    {
        $casts = [ 'id' => 'string',
            'year_launched' => 'integer',
            'opened' => 'boolean',
            'duration' => 'integer'];
        $this->assertEquals($casts, $this->video->getCasts());
    }

    public function testDatesAttribute()
    {
        $datesAttribute = ['deleted_at', 'created_at', 'updated_at'];

        $this->assertEqualsCanonicalizing($datesAttribute, $this->video->getDates());

    }


}
