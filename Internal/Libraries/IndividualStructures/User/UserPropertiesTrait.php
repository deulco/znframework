<?php namespace ZN\IndividualStructures;

trait UserPropertiesTrait
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Auto Login
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  mixed $autoLogin
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function autoLogin($autoLogin = true) : InternalUser
    {
        $this->parameters['autoLogin'] = $autoLogin;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Return Link
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $returnLink
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function returnLink(String $returnLink) : InternalUser
    {
        $this->parameters['returnLink'] = $returnLink;
        
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Old Password
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $oldPassword
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function oldPassword(String $oldPassword) : InternalUser
    {
        $this->parameters['oldPassword'] = $oldPassword;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // New Password
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $Password
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function newPassword(String $newPassword) : InternalUser
    {
        $this->parameters['newPassword'] = $newPassword;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Password Again
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $passwordAgain
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function passwordAgain(String $passwordAgain) : InternalUser
    {
        $this->parameters['passwordAgain'] = $passwordAgain;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Password Again
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $passwordAgain
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function column(String $column, $value) : InternalUser
    {
        $this->parameters['column'][$column] = $value;
        
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Username
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $username
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function username(String $username) : InternalUser
    {
        $this->parameters['username'] = $username;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Password
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $password
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function password(String $password) : InternalUser
    {
        $this->parameters['password'] = $password;
        
        return $this;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Remember
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  bool $remember
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function remember(Bool $remember = true) : InternalUser
    {
        $this->parameters['remember'] = $remember;
        
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Username
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $username
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function email(String $email) : InternalUser
    {
        $this->parameters['email'] = $email;
        
        return $this;
    }
}