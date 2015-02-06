<?php namespace TGL\ShoeRequest\Entities;

use Illuminate\Database\Eloquent\Model;

class ShoeRequest extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'size',
        'img',
        'message'
    ];

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

    public static function place($brand, $model, $size, $img, $message)
    {
        $shoeRequest = new static(compact('brand', 'model', 'size', 'img', 'message'));
        return $shoeRequest;
    }




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