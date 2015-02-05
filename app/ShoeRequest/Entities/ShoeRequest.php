<?php namespace TGL\ShoeRequest\Entities;

use Illuminate\Database\Eloquent\Model;

class ShoeRequest extends Model
{
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
    public function member()
    {
        return $this->belongsTo('TGL\Members\Entities\Member');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('TGL\ShoeRequest\Entities\Status');
    }
}