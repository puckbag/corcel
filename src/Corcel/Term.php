<?php 

/**
 * Corcel\Comment
 * 
 * @author Junior Grossi <me@juniorgrossi.com>
 */

namespace Corcel;

class Term extends Eloquent
{
    protected $table = 'wp_terms';
    protected $primaryKey = 'term_id';

    protected function _posts()
    {
        return Post::select('wp_posts.*')
            ->join('wp_term_relationships','wp_term_relationships.object_id','=','wp_posts.ID')
            ->join('wp_term_taxonomy','wp_term_taxonomy.term_taxonomy_id','=','wp_term_relationships.term_taxonomy_id')
            ->where('wp_term_taxonomy.term_id',$this->term_id);
    }

    /**
     * Get TermTaxonomy relationship
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxonomy()
    {
        return $this->belongsTo('Corcel\TermTaxonomy','term_id','term_id');
    }

    /**
     * Get posts under a term
     *
     * @return Corcel\Post
     * 
     **/
    public function posts()
    {
        return $this->_posts();
    }

    /**
     * Magic method to return the meta data like the post original fields
     * 
     * @param string $key
     * @return string
     */
    public function __get($key)
    {
        switch ($key)
        {
            case 'posts':
                return $this->$key()->get();
        }
        
        return parent::__get($key);
    }

}
