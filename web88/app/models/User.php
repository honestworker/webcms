<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	public static $unguarded = true;
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function login($data)
	{
	
	$email = trim(htmlspecialchars( $data['email'] ));
	
	try
		{
			$user = User::where('email', '=', $email)->firstOrFail();
			
		}
		catch(Exception $e)
		{
			return false;
		}

//	if(!$user->active)
//		return false;

	//	if ( Auth::attempt([ 'email' => $email, 'password' => $data['password'] ], true ))
		if (password_verify($data['password'], $user->password))	// Laravel 5 Auth: manually verify psw ...
		{
			Auth::login($user);										// Laravel 5 Auth: ... and manually login user
			return Auth::user();
		}
		else
		{
			return false;
		}
	}
    
	public static function addPhoto($data)
    {
        try
        {
			$image = '';
			if($data['photo']){
			$destinationPath = base_path() . "/admin/images/profile/";
            $name = Input::file('photo')->getClientOriginalName();
		    Input::file('photo')->move($destinationPath, $destinationPath . $name);
			$image = "images/profile/" . $name;
            $user = User::find(Auth::user()->id);
			$user->photo = $image;
			$user->save();
			}
        }
        catch (Exception $e)
        {
            return false;
        }
        return $user;
    }
	
    public static function getUser($id)
    {
        try
		{
			$user = User::where('id', '=', $id)->firstOrFail();
		}
		catch(Exception $e)
		{
			return $e;
		}
		
		return $user;
    }
    
	/*
	public static function register($data)
	{
		try
		{
					$user = User::create([
					'email' => $data['email'],
					'first_name' => Clean::getClearing($data['first_name']),
					'last_name' => Clean::getClearing($data['last_name']),
					'password' => Hash::make($data['password']),
					'active' => 0
				]);
		}
		catch (Exception $e)
		{
			return $e;
		}
		return $user;
	}
    */
	public static function changePassword($data)
	{
		try
        {
            $user = User::find(Auth::user()->id);
			$user->password = Hash::make($data['password']);
			$user->pass = $data['password'];
			$user->save();
        }
        catch (Exception $e)
        {
            return $e;
        }
        return $user;
	}
	
    
	    public function roles()
    {
        return $this->belongsToMany('Role');
    }
	
	//Роль пользователя
	    public static function roleUser($id)
    {
		$id = (int)$id;
        $user = DB::table('role_user')->where('user_id', '=', $id)->first();
		if ($user){
			switch( $user->role_id ){
				case '1' : $role = 'Админ'; break;
				case '2' : $role = 'Менеджер'; break;
				case '3' : $role = 'Модератор'; break;
			}
		}	
		else{
			$role = 'Пользователь';
		}
		
		return $role;
			
    }
	
       public function isAdmin()
    {
        $admin_role = Role::whereRole('admin')->first();
        return $this->roles->contains($admin_role->id);
    }

    public function isManager()
    {
        $manager_role = Role::whereRole('manager')->first();
        return $this->roles->contains($manager_role->id) || $this->isAdmin();
    }

    public function isModerator()
    {
        $admin_role = Role::whereRole('admin')->first();
        return $this->roles->contains($admin_role->id) || $this->isAdmin();
    }

    public function isRegular()
    {
        $roles = array_filter($this->roles->toArray());
        return empty($roles);
    }

}
