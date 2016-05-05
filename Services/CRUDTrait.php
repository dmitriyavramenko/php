<?php
namespace App\Http\Traits;
trait CRUDTrait
{
    
    /**
     * Find All
     * 
     * @param int $id
     * @return Model
     */
    public function findAll($user)
    {
        return $this->model
                ->where('user_id',$user->id)
                ->orderBy('id','DESC')
                ->get();
    }
 
    /**
     * Find by id
     * 
     * @param int $id
     * @return Model
     */
    public function findByPk($id, $user)
    {
        return $this->model
                ->where('user_id',$user->id)
                ->whereId($id)
                ->first();
    }

    /**
     * Insert data into table
     * 
     * @param array $data
     * @return Model
     */
    public function create( array $data )
    {
        return $this->model->create($data);
    }

    /**
     * Update by id
     * 
     * @param int $id
     * @param array $data
     * @return Boolean
     */
    public function update( $id, array $data, $user )
    {
        return $this->model
                ->where('user_id',$user->id)
                ->whereId($id)
                ->update($data);
    }

    /**
     * Delete by id
     * 
     * @param int $id
     * @return Boolean
     */
    public function delete($id, $user)
    {
        return $this->model
                ->where('user_id',$user->id)
                ->whereId($id)
                ->delete();
    }
}