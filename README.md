1.composer install
<br>
2.composer run dev
<br>
3 ubah di vendor>laravel>ui>auth-backend->AuthenticatesUsers :

    public function username()
    {
        return 'email'; //ganti ke return 'nik';
    }
    
4. php artisan migrate
<br>
5. php artisan db:seed

admin nik 123
<br>
password 123456
