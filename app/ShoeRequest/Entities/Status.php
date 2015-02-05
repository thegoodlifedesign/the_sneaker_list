<?php namespace TGL\ShoeRequest\Entities;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';

    /**********************************/
    /*
     * MISCELLANEOUS METHODS
     */
    /**********************************/






    /**********************************/
    /*
     * COMMANDS METHODS
     */
    /**********************************/






    /**********************************/
    /*
     * RELATIONSHIP METHODS
     */
    /**********************************/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shoeRequest()
    {
        return $this->hasMany('TGL\ShoeRequests\Entities\ShoeRequest');
    }
}