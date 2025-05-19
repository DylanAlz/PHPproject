<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleSection extends Model
{
    protected $table = 'role_permissions';
    protected $primaryKey = ['role_id', 'section_id'];
    public $incrementing = false;
    public $dates = ['created_at', 'updated_at'];

    /**
     * Set the keys for a save update query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    protected function setKeysForSaveQuery($query)
    {
        $keys = $query->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $keyName) {
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }
        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @param mixed
     */
    protected function getKeyForSaveQuery($keyName = null){
        if(is_null($keyName)) {
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}
