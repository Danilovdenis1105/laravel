<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Str;

class BlogPostObserver
{

    /**
     * Handle the BlogPost "creating" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost): void
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHtml($blogPost);
        $this->setUser($blogPost);
    }

    /**
     * @param BlogPost $blogPost
     * @return void
     */
    protected function setHtml(BlogPost $blogPost): void
    {
        if ($blogPost->isDirty('content_raw')) {
            // TODO: generate markdown->html
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    /**
     * @param BlogPost $blogPost
     * @return void
     */
    protected function setUser(BlogPost $blogPost): void
    {
        $blogPost->user_id = auth()->id ?? BlogPost::UNKNOWN_USER;
    }

    /**
     * Handle the BlogPost "created" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "updating" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function updating(BlogPost $blogPost): void
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
    }

    /**
     * @param BlogPost $blogPost
     * @return void
     */
    protected function setPublishedAt(BlogPost $blogPost): void
    {
        if (empty($blogPost->published_at) && $blogPost['is_published']) {
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * @param BlogPost $blogPost
     * @return void
     */
    protected function setSlug(BlogPost $blogPost): void
    {
        if (empty($blogPost->slug)) {
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }

    /**
     * Handle the BlogPost "updated" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "deleted" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "restored" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "force deleted" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
